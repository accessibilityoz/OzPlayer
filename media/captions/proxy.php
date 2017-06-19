<?php

//make a synchronous http request of a specified type, and return a response array
//containg the body (or null for HEAD requests), plus the headers in key/value pairs
function request($method, $uri, $postdata = null, $nocache = false, $agent = null, $reefer = true, $timeout = 15)
{
    //if the nocache flag is true then add a timstamp to the query string
    //effectively creating a unique URI so we never get a cached response
    if($nocache === true)
    {
        $uri .= (strpos($uri, '?') !== false ? '&' : '?') . 'utc=' . str_replace('.', '', microtime(true));
    }

    //parse the request URI into a location array, adding a "port" member for convenience
    //*** what if the URI already has a port number in it?
    $location = parse_url($uri);
    $location['port'] = 80;

    //convert the method to the required uppercase
    //then nullify any postdata if it isn't POST
    if(($method = strtoupper($method)) !== 'POST')
    {
        $postdata = null;
    }


    //define an array for storing the response data
    //=> integer status code eg. 200
    //=> string full status eg "HTTP/1.0 200 OK"
    //=> array of headers in key=>value pairs
    //=> response body (or null for a HEAD request)
    $response = array(
        'code'        => 0,
        'status'     => null,
        'headers'     => array(),
        'body'         => null
        );


    //now open a socket at the specified port with the specified connection timeout
    if($fp = fsockopen($location['host'], $location['port'], $exnum, $exmsg, $timeout))
    {
        //specify a blocking stream and set the stream timeout
        stream_set_blocking($fp, true);
        stream_set_timeout($fp, $timeout);

        //start saving the stream meta-data so we can detect a timeout
        $stream = stream_get_meta_data($fp);


        //now send the request headers
        fputs
        (
            $fp,
            "$method $uri HTTP/1.0\r\n"                                                                           //use HTTP 1.0 so we don't get a chunked response
            . "Host: $location[host]\r\n"                                                                         //always have to specify the host
            . (!is_null($postdata) ? "Content-Type: application/x-www-form-urlencoded\r\n" : "")                  //if we have POST data we must send a content-type
            . (!is_null($postdata) ? ("Content-Length: " . strlen($postdata) . "\r\n") : "")                      //if we have POST data we must send a content-length
            . "Accept: *; q=0.5, text/*\r\n"                                                                      //prefer text formats but allow anything
            . "Accept-Encoding: identity\r\n"                                                                     //we can only deal with a non-encoded response
            . "Connection: close\r\n"                                                                             //else it won't close until the socket times out!
            . "User-Agent: " . $agent . "\r\n"                                                                    //it's only polite to identify yourself
            . ($reefer ? ("Referer: http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . "\r\n") : "")    //send referer if specified, using REQUST_URI so we get the visible page address not this file name
            . "X-LOL: KTHX\r\n"                                                                                   //:-D
            . "\r\n"                                                                                              //a double line-break signifies the end of the headers
        );

        //then send the postdata if we have any
        //(have already confirmed that the method is POST)
        if(!is_null($postdata))
        {
            fputs($fp, $postdata);
        }


        //now iterate through the response text to compile the response array
        //checking as we go that the connection hasn't timed-out
        while(!feof($fp) && !$stream['timed_out'])
        {
            if($line = fgets($fp, 1024))
            {
                //if we haven't got the status message, store this line as that message
                //we know that's what it is because it's always the very first line
                //then extract the status code and save it separately as an integer
                if($response['status'] === null)
                {
                    $response['status'] = trim($line);
                    $response['code'] = preg_split("/[ \t]+/", $response['status']);
                    $response['code'] = (int)$response['code'][1];
                }

                //else if we haven't yet started compiling the response body
                elseif($response['body'] === null)
                {
                    //if this line is empty then it must the division between the headers and body
                    //so set response->body to an empty string, ready to compile it
                    if($line == "\r\n")
                    {
                        $response['body'] = '';
                    }

                    //otherwise this data must be headers, so split it into a
                    //key/value pair, normalising the key to lowercase jic of
                    //response variations, then and add that to response->headers
                    //giving us members like "date" => "Thu, 18 May 2006 15:17:06 GMT"
                    else
                    {
                        $data = explode(': ', trim($line));
                        $response['headers'][strtolower($data[0])] = $data[1];
                    }
                }

                //else add this line to response->body including any whitespace
                else
                {
                    $response['body'] .= $line;
                }
            }

            //re-get the stream meta-data
            $stream = stream_get_meta_data($fp);
        }


        //close the socket
        fclose($fp);

        //if the stream timed-out, set the response code and status
        //for a connection timeout error, then return the response
        if($stream['timed_out'])
        {
            $response['code'] = 504;
            $response['status'] = 'HTTP/1.0 504 Gateway Timeout';
            return $response;
        }

        //[else] if this was a HEAD request, nullify the response body
        //nb. we needed it during compilation, to differentiate the
        //headers from the body for other types of request, but for
        //HEAD I think it's better that it's null than empty string
        if($method === 'HEAD')
        {
            $response['body'] = null;
        }


        //[else] return the response array
        return $response;
    }

    //or if we failed to open a socket, set the response code
    //and status for a bad gateway error, then return the response
    //*** can we differentiate non-existent host from unreachable host from other errors?
    else
    {
        $response['code'] = 502;
        $response['status'] = 'HTTP/1.0 502 Bad Gateway';
        return $response;
    }
}





//*** this is totally vulnerable to XSS attacks and proxy abuse
//*** so we'd have to lock it down; this is just a proof of concept
if(!empty($_GET['src']))
{
    $response = request('GET', rawurldecode($_GET['src']), null, false, 'OzPlayer/1.0', false);
    if($response['code'] == 200)
    {
        header("Content-Type: text/plain");
        header("Cache-Control: private");
        echo $response['body'];
    }
}

?>
