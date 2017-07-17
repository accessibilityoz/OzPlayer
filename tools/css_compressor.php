<?php


//-- define the input JS file path/name --//
$cssfile = "$_GET[codebase]";

//-- set some safe config options --//
$config = array
(
    "do-compression"        => true,        //enable compression (master option)
    "remove-debug"            => true,        //+ remove debug sections
    "line-break-handling"    => 2            //+ line-break handling [2=remove, 1=reduce, 0=retain]
);

//-- override config with GET value --//
foreach($config as $key => $value)
{
    if(isset($_GET[$key]))
    {
        $config[$key] = (int)$_GET[$key];
    }
}






//-- input and initial parse --//

//get the CSS content
$css = file_get_contents($cssfile);

//record its original file size before compressions
//in an array which leaves space to record the final size after compression
$overall_compression = array('before' => strlen($css));

//begin recording compression of extraneous information
//comments and whitespace that are not needed for functioning
//and debug sections that are not for production use
$extra_compression = array('whitespace' => 0, 'comments' => 0, 'debug' => 0);







//-- if compression is enabled --//
if($config['do-compression'])
{



    //-- remove comments --//

    //record the current file size
    $sizenow = strlen($css);

    //remove multi-line starred comments
    //which is second so that comments like "//***DEV" don't survive
    //this far to be treated as the start of a multi-line comment
    $css = ereg_replace("(\/\*([^*]|(\*+([^*\/])))*\*+\/)", "", $css);

    //store the filesize difference for removed comments
    $extra_compression['comments'] += ($sizenow - strlen($css));







    //-- remove non-printed tabs and line-breaks --//

    //record the current file size
    $sizenow = strlen($css);

    //add a space after relevant statements which are followed by whitespace
    //in case they're only separated from what follows them
    //by tabs or line-breaks, the removal of which would cause a syntax error
    $css = preg_replace("/(@media)[\s]/", "\\1 ", $css);

    //remove tabs
    $css = preg_replace("/([\t]|[ ]{4})/", "", $css);

    //remove or reduce line-breaks
    if($config['line-break-handling'] == 2)
    {
        $css = preg_replace("/[\r\n]/", "", $css);
    }
    elseif($config['line-break-handling'] == 1)
    {
        $css = preg_replace("/([\r\n]){2,}/", "$1", $css);
    }

    //store the filesize difference for removed whitespace
    $extra_compression['whitespace'] += ($sizenow - strlen($css));








    //-- remove debug sections --//
    if($config['remove-debug'])
    {

        //record the current file size
        $sizenow = strlen($css);

        //explode the code string by debug condition declarations
        //** will this completely break if there are nested debug sections?
        //** not that there knowingly will be, but maybe by mistake
        $css = preg_split("/(?:else\s+)?if\(config\[\'#debug\'\]\)/", $css);

        //this will give us an array of chunks, each of which begins with the opening-brace
        //of a debug condition, and then contains everything up to the next debug condition
        //so we have to identify the balanced contents of the debug section, for which
        //pure regex isn't enough, so we're going to count the opening and closing braces
        //and use the counter to identify when we reach the end of the debug section
        //then mark that with a delimeter, which we can then split by to remove it
        $depth;
        $found;

        //this is the callback for preg_replace_callback
        //it receives either an opening or closing brace character (at match[0])
        //and counts them to identify the boundaries of the debug section
        //in all cases we return the character back, then we add the closing
        //delimiter of a section marker when we find the end boundary
        function set_depth($matches)
        {
            global $depth, $found;

            $rv = $matches[0];
            if(!$found)
            {
                if($matches[0] == '{')
                {
                    $depth++;
                }
                else
                {
                    if(--$depth == 0)
                    {
                        $found = true;
                        $rv .= ']DEBUG]>';
                    }
                }
            }
            return $rv;
        }

        //so then iterate through the exploded JS string, and pass each chunk
        //to the regex callback function, except for the very first
        //(which is all the code before the first debug section, and we
        //don't want to parse that because it may be mis-identified
        //as a part or whole debug section itself (depending on its content))
        foreach($css as $i => $section)
        {
            if($i > 0)
            {
                //reset depth and found
                $depth = 0;
                $found = false;

                //pass the section through preg_replace_callback
                //and the result of that proceess will ultimately
                //produce a string containing a closing section marker
                //immediately after the debug section's closing brace
                $css[$i] = preg_replace_callback("/[\{\}]/", "set_depth", $section);

                //so then we split that string by its marker, save the second-half
                //back to the array, effectively discarding the first-half
                //entirely which contains all the code in the debug section
                $css[$i] = explode(']DEBUG]>', $css[$i]);
                $css[$i] = $css[$i][1];
            }
        }

        //finally join the array back into a single string
        //now with all the debug sections removed :-)
        $css = implode('', $css);

        //if line-breaking handling is "reduce", do it again
        //to reduce any double-breaks left behind by debug removal
        if($config['line-break-handling'] == 1)
        {
            $css = preg_replace("/([\r\n]){2,}/", "$1", $css);
        }

        //store the filesize difference for removed debug sections
        $extra_compression['debug'] += ($sizenow - strlen($css));
    }







}
//-- endif compression is enabled --//







//-- final output --//

//record the final file size after compression
$overall_compression['after'] = strlen($css);

//send a css mime-type header
@header("Content-Type:text/css");

//finally output the compressed CSS code
echo $css;


?>
