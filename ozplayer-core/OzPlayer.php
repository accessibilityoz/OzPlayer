<?php
/*******************************************************************************
 Copyright (c) 2013-7 AccessibilityOz        http://www.accessibilityoz.com.au/
 ------------------------------------------------------------------------------
 OzPlayer [3.1] => player core
 ------------------------------------------------------------------------------
*******************************************************************************/
class OzPlayer
{

    //-- private properties --//

    //configuration options
    private static $config = array
    (
        //cue id prefix for additional transcript data
        'transcript-cue-id'     => 'T-'
    );

    //programatic language
    private static $lang = array
    (
        //fatal error messages
        'transcript-error'      => 'Transcript is not available [%status].',

        //script console warnings for fatal error messages
        'transcript-warning'    => 'OzPlayer Warning - PHP transcript is not available [%status].',

        //end of transcript message
        'transcript-end'        => 'END OF TRANSCRIPT.',
    );







    //-- public methods --//

    //compile and output the transcript, from VTT or SRT data by file path
    public static function get_transcript($captions = null, $transcript = null)
    {
        //if the captions array is empty or undefined,
        //output transcript error 412 (precondition failed) and we're done
        if(empty($captions))
        {
            echo(self::get_error('412'));
            return;
        }

        //[else] convert the captions data to an array of lang and vtt path
        //casting and trimming both values, but without further processing
        //nb. if the path is wrong that will fail when trying to load it
        //but for the language code it's up to users to specify correct values
        $captions = array
        (
            'lang'    => trim((string)array_shift(array_keys($captions))),
            'vtt'     => trim((string)array_shift(array_values($captions)))
        );

        //now check that the captions path exists, or if that fails
        //then output transcript error 404 (not found) and we're done
        //nb. we can't really check the file name because it could be anything
        //it won't necessarily be a neat discreet file ending in ".vtt" or ".srt"
        //but we don't need to prevent the inclusion of privileged system files etc.
        //because this isn't user data, it's defined by the site owner
        if(!file_exists($captions['vtt']))
        {
            echo(self::get_error('404'));
            return;
        }

        //now try to get the text specified by the captions path, or if it's empty
        //then output transcript error 415 (unsupported media type) and we're done
        //nb. if we didn't do this check then the lack of cues would ultimately
        //give rise to the same error, so we may as well save that overhead
        if(!($captions['vtt'] = file_get_contents($captions['vtt'])))
        {
            echo(self::get_error('415'));
            return;
        }

        //[else] if the transcript data is defined and not empty
        if(!empty($transcript))
        {
            //convert the data to an array of lang and vtt path
            //casting and trimming both values, but without further processing
            $transcript = array
            (
                'lang'    => trim((string)array_shift(array_keys($transcript))),
                'vtt'     => trim((string)array_shift(array_values($transcript)))
            );

            //then try to get the text specified by that path, or if that fails
            //or it's empty, reset transcript to null, but don't show an error
            //so that the captions will still compile with or without the extra data
            //nb. use error trapping so we don't need a separate file_exists check
            //nb. we can't show an error for this without polluting the transcript
            if(!($transcript['vtt'] = @file_get_contents($transcript['vtt'])))
            {
                $transcript = null;
            }
        }

        //now pass the captions data to the VTT parsing method,
        //which will return an array of associative arrays of cue data
        //but if the array is empty then there were no valid cues
        //which is only likely to happen if the file is empty, or only contains notes
        //(though it will also happen if the text isn't VTT data at all)
        //so output transcript error 415 (unsupported media type) and we're done
        //nb. pass null for the cue id prefix so it defines a plain cue
        //and specify "captions" as the cue kind, which affects the markup
        //and also specify the language code for later use in the lang attribute
        if(!($captions = self::parse_vtt($captions['vtt'], null, 'captions', $captions['lang'])))
        {
            echo(self::get_error('415'));
            return;
        }

        //[else] if we have additional transcript data, do the same thing
        //but in this case if it's empty just silently set it back to null
        //nb. pass the config cue id prefix so it's added to the start of
        //the cue IDs, in order to make them unique from the caption cue IDs
        //which might both just be numbers if neither of them specified other IDs
        //and specify "transcript" as the cue kind, which affects the markup
        //and also specify the language code for later use in the lang attribute
        //nb. we can't show an error for this without polluting the transcript
        if($transcript)
        {
            if(!($transcript = self::parse_vtt($transcript['vtt'], self::$config['transcript-cue-id'], 'transcript', $transcript['lang'])))
            {
                $transcript = null;
            }
        }


        //*** DEV TMP
        //echo '<xmp style="background:#cfc;">';
        //var_dump($captions);
        //echo '</xmp>';
        //echo '<xmp style="background:#dfb;">';
        //var_dump($transcript);
        //echo '</xmp>';
        //return;


        //if we [still] have additional transcript data, merge its cues
        //into the caption cues array, then sort the whole thing by its timestamps
        //and then we can nullify the transcript array for tidyness and garbage collection
        if($transcript)
        {
            $captions = array_merge($captions, $transcript);

            $timestamps = array();
            foreach($captions as $cue)
            {
                $timestamps[] = $cue['timestamp'];
            }
            array_multisort($timestamps, $captions);

            $transcript = null;
        }

        //and finally, iterate through the cues to compile and output the transcript
        //nb. include a line-break after each cue and another at the start
        //so that the generated source is easier to identify and read
        echo "\n";
        foreach($captions as $cue)
        {
            echo self::get_cue_html($cue) . "\n";
        }

        //then add the end of transcript message, with a final pair of line-breaks
        echo '<p>' . self::$lang['transcript-end'] . '</p>' . "\n\n";
    }








    //-- private methods (vtt processing) --//

    //parse the data from a VTT or SRT file into a cues array
    private static function parse_vtt($data, $idx, $kind, $lang)
    {
        //define an empty cues array
        $cues = array();

        //trim the data, normalize line-breaks to unix,
        //then split by empty lines and iterate through the resulting array
        foreach(preg_split('/^[\s]*$/m', trim(preg_replace('/(\r[\n\f]?)/', "\n", $data))) as $vtt)
        {
            //if the line starts with a file signature or a note,
            //just ignore it and continue to the next line
            //nb. we don't verify that the file signature is present
            //otherwise we wouldn't be able to support SRT files
            if(preg_match('/^\s*(WEBVTT|NOTE)/', $vtt))
            {
                continue;
            }

            //[else] create a new sub-array for this cue
            $cue = array();

            //then trim and split the cue by individual lines
            //nb. the split creates an array where each line-break
            //in the original data is now an empty array member
            //(which happens because we split by ^ instead of [\n\r])
            //so I'm using a generic filter function to trim every value
            //and then remove any pre-existing or subsequent empty members
            $lines = self::array_string_clean(preg_split('/\s*^\s*/m', trim($vtt)));

            //and if the resulting array is empty just continue to the next cue
            //nb. this can happen if the vtt file contains large chunks of whitespace
            if(empty($lines))
            {
                continue;
            }

            //*** DEV TMP
            //echo '<xmp style="background:#fec;">';
            //var_dump($lines);
            //echo '</xmp>';

            //if the first line doesn't contain the "-->" timing delimiter
            //then it must be the cue ID, so trim and extract the first
            //set of non-space characters, and define that for the cue id
            //then shift it off the lines array to get it out of the way
            if(strpos($lines[0], '-->') === false)
            {
                $cue['id'] = preg_replace('/^([\S]+).*/', '\1', trim(array_shift($lines)));
            }

            //then if [what's now] the first line doesn't contain the timing delimiter
            //or if we don't even have any more lines (eg. the file isn't captions data)
            //then this cue has been mis-defined, so just continue to the next one
            //nb. we can't show an error for this without polluting the transcript
            if(empty($lines) || strpos($lines[0], '-->') === false)
            {
                continue;
            }

            //[else] if we don't have cue id then create one from its index + 1
            //nb. using 1-based numbering because that's more user friendly
            //but it still has to be a string so that all ids are the same data type
            if(!isset($cue['id']))
            {
                $cue['id'] = (string)(count($cues) + 1);
            }

            //then if the cue id prefix is specified, add it at the start of the id
            //nb. this is so we can differentiate otherwise-identical generated ids
            if(!empty($idx))
            {
                $cue['id'] = "$idx$cue[id]";
            }

            //then specify the cue kind, either "caption" or "transcript"
            //according to the input argument, which affects the output markup
            $cue['kind'] = $kind;

            //also specify the language code, for later use in the lang attribute
            $cue['lang'] = $lang;

            //now shift that first line to get it out of the way again
            //and extract the individual start and end timestamps from it
            //but if the parser was fooled by an invalid cue which nevertheless
            //contained the timing delimiter, then we won't get the regex match
            //we're expecting, so in that case just continue to the next cue
            //nb. we can't show an error for this without polluting the transcript
            if(!preg_match(
                '/((?:[\d]+[\:\.\,]?){3,4})(?:\s+\-\->\s+)((?:[\d]+[\:\.\,]?){3,4})/',
                array_shift($lines),
                $timestamps
                ))
            {
                continue;
            }

            //[else] we don't actually need to save all the timing information here
            //we needed to verify that the information is there and valid, so that
            //this transcript omits the same invalid cues as the javsacript one
            //but we might need the start time so we can use it to sort the
            //merged captions and transcript cues chronologically, if we have both
            //and for that the raw timestamp is enough, we don't need to parse it
            $cue['timestamp'] = $timestamps[1];

            //then re-join the remaining lines (with a unix line-break for internal consistency)
            //trim the result, and if it's not empty then save it to the cue text
            //then parse any links to add (or replace) target="_blank"
            if($lines = trim(implode("\n", $lines)))
            {
                $cue['text'] = $lines;

                if(preg_match('/<a/i', $cue['text']))
                {
                    //** should we allow for target attributes which have no quotes, or single quotes?
                    $cue['text'] = preg_replace('/(<a)/i', '\1 target="_blank"', preg_replace('/target=\"[^\"]+\"/i', '', $cue['text']));
                }
            }

            //but if it is empty, there's no point creating a cue for it at all
            //since we'd have nothing to display, so just continue to the next cue
            //nb. we can't show an error for this without polluting the transcript
            else
            {
                continue;
            }

            //finally add this cue sub-array to the main cues array
            $cues[] = $cue;

            //*** DEV TMP
            //echo '<xmp style="background:#dfd;">';
            //var_dump($cue);
            //echo '</xmp>';
        }

        //return the final cues array
        return $cues;
    }







    //-- private methods (text and markup processing) --//

    //convert the text from a single cue into the HTML for a single transcript entry
    private static function get_cue_html($cue)
    {
        //begin compiling an HTML string, using blockquote
        //for a "captions" kind cue, or a plain div for anything else
        //specifying the cue id in a "data-cue" attribute
        //and specifying the cue lang in a "lang" attribute
        //nb. we can't just use "id" because the cue id might be
        //purely numeric, but HTML IDs can't start with a number
        $html = '<'
                . ($cue['kind'] == 'captions' ? 'blockquote' : 'div')
                . ' lang="' . $cue['lang']
                . '" data-cue="' . $cue['id']
                . '">';

        //now split the cue text by its uniform line-breaks and iterate through the resulting array
        //nb. usually this will only be a single member, but it can be two or more
        foreach(preg_split('/\n/', $cue['text']) as $i => $line)
        {
            //parse this line to extract any voice tags from the text
            preg_match('/^(?:<v(?:\s+([^>]+))?>)?(.*)$/m', $line, $parts);

            //trim and remove any closing </v> tags from the text content
            //nb. this is an over-simplification as it doesn't allow for lines
            //where the voice is only part of the line, e.g. "<v>foo</v> bar"
            $parts[2] = preg_replace('/<\/v>/', '', trim($parts[2]));

            //if the trimmed voice tag is not empty, parse the text content of any
            //leading dash, since dashes are commonly used to indicate different
            //speakers in a cue, but we don't need them if we have a a voice citation
            if(($parts[1] = trim($parts[1])) != '')
            {
                $parts[2] = preg_replace('/^[-]\s*/', '', $parts[2]);
            }

            //then compile the line by defining a <p>, then a <q> pair for "captions" kind
            //cues which includes a [data-voice] attribute on the <p> if we have a voice,
            //and also including a leading speaker citation if the speaker argument is true
            //ie. so we'll get either <p data-voice="foo"><q> or just <p><q>
            //or if speaker is true then we'll get <p data-voice="foo">{SPEAKER}<q>
            //nb. we need two elements here so we can have a wrapping block
            //to put each caption cue line on its own line, but also an inline element
            //so it can have a background color which will only apply to the line boxes
            //nnb. but the transcript doesn't need that, it's just for dialog semantics
            $line = '<p' . (!empty($parts[1]) ? (' data-voice="' . $parts[1] . '"') : '') . '>'
                    . (!empty($parts[1]) ? ("<cite>$parts[1]</cite>: ") : '')
                    . ($cue['kind'] == 'captions' ? '<q>' : '')
                    . $parts[2]
                    . ($cue['kind'] == 'captions' ? '</q>' : '')
                    . '</p>';

            //convert any <c.foo> tags in the line to <span class="foo">
            $line = preg_replace('/<\/c>/', '</span>', preg_replace('/<c\.([^>]+)>/', '<span class="\\1">', $line));

            //then add the processed line to the overall HTML string
            $html .= $line;
        }

        //finally add the closing tag, and return the HTML string
        return $html . '</' . ($cue['kind'] == 'captions' ? 'blockquote' : 'div')  . '>';
    }


    //compile a transcript error message with a specified status code
    //including a scripted console warning to provide a JS notification
    //since the scripted transcript would overwrite the PHP warning output
    //(including this script, but not until after the warning has been shown)
    //nb. the markup isn't in config because users can't be allowed to change it
    private static function get_error($status)
    {
        return "\n"
             . '<p><strong><em>'
             . str_replace('%status', $status, self::$lang['transcript-error'])
             . '</em></strong></p>'
             . "\n"
             . '<script type="text/javascript">try { console.warn(\''
             . str_replace('%status', $status, self::$lang['transcript-warning'])
             . '\'); }catch(ex){}</script>'
             . "\n\n";
    }







    //-- private methods (general utilities) --//

    //trim every member of an array and remove any [now] empty strings
    private static function array_string_clean($data)
    {
        for($i = 0; $i < count($data); $i ++)
        {
            if(($data[$i] = trim($data[$i])) == '')
            {
                array_splice($data, $i, 1);
                $i --;
            }
        }
        return $data;
    }


}
?>
