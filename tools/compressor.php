<?php


//-- define the input JS file path/name --//
$jsfile = "$_GET[codebase]";

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






//-- define names of private functions for compression --//
//nb. we can only include here functions that are always followed by parenthesise in use
//eg. "xxx([a,b])" and "function xxx([a,b])"
//and also "foo.xxx = function([a,b])" or just "xxx = function([a,b])" or "xxx : function([a,b])"
//but any another format can't be listed here, and must be compressed as a variable [next below]
//(eg. if it's by reference and without brackets, like "document.onclick = handler;")
$functions = array
(

    'def','each','build','listen','trim','sprintf',
    'addClass','console','delay','getLang','get',

    'updateControlState','remove',
    'updateControlText','updateControlDisabled',
    'updateControlMenuDisabled',
    'maybeHideSliderTooltip','pauseMedia','updateSliderStretch',
    'removeClass','hasClass','render','contains','dispatchMediaSliderEvent',

    'setMediaVolume','playMedia','setMediaTime','bufferMedia','abortMedia',
    'audioSynchronise','getTracksData','getTrackVTT','parseTrackVTT',
    'getTimeCaption','getCueHTML','addTranscriptHTML',
    'addMediaInterface','addControlButton','addControlClick','addControlMenu',
    'addSkipLinks','removeHelpDialog','addLogoBug',
    'startAutoHiding','unprimeAutoHiding','primeAutoHiding',
    'autoShowingState','doShowingState','autoHidingState',
    'addPoster','showIndicator','hideIndicator',
    'refreshSeekData',
    'adjustVolume','updateVolume',
    'loadTracksData',
    'displayCaption','addCaptionPadding','displayTranscriptMarkers','deleteTranscriptMarkers',
    'addMediaSlider','addMediaSliderEvent',
    'buildSlider','bindSliderEvents','beforeSlide','doSlide','afterSlide','applySliderValue',
    'applySliderPosition','dispatchSliderEvent','getTrackData','nullifyTimer','verifySliderKey',

    'maybeCreateButtonTooltip','addButtonTooltip','maybeRemoveButtonTooltip',
    'definitelyMoveButtonTooltip','updateVisibleButtonTooltip',
    'maybeShowSliderTooltip','showSliderTooltip','definitelyMoveSliderTooltip',

    'getSupportedType','getBaseVolume','yesCanPlay','getStampTime','getTimeStamp',
    'addStorageValue','getStorageValue',
    'getFullscreenModel','isFullscreen','enterFullscreen','leaveFullscreen',

    'empty','flatten','appendSibling','appendHTML',
    'button','getViewportPosition','constrain',
    'getStyle','swapClass','ajax','load','list','qualify',

    'cors','xrequest',
    'xphonehome',
    'find',

    'applyImageSupport','audioConstruct','haveCSS','applySliderAriaText',
    'addTranscriptExpander','addCrossModalClick',

    'getBufferData','isTimeBuffered',

    'doResponsiveEvent'

);



//-- define names of private constants, variables and properties for compression --//
//nb. be careful not to include names of built-in properties that are also
//custom variables or public property keys, things like "media" and "href
//and make sure you TEST EVERY REPLACEMENT that the script still works and produces the same output
//and make sure you haven't changed any constant values, lookup object data or regex patterns
//we use only capital letters because I think that's simpler,
//and single-letter variables are often used in original scripting, eg. "i", "j", "e" etc.
//and so you never confused between things like "A1" and "a1"
//plus lowercase f is used for function conversions, to make f1(), f36() etc.
//### TIP: lead with the most common, so they get the single-leter names ###
//### but make sure you're not falling foul of the substring gotcha ###
//### you may have to move less-common names in front of common names to fix that ###
//*** ideally this would be substring safe - but that's more than just boundary checks!
//*** and it's not even as simple as knowing if we're inside a string or regex
//*** because you might want string references to property names to be compressed
//*** especially if they're string references to things that are also reffered to
//*** by non-string references, eg. object keys, and that would have to be consisten
$variables = array
(

    'player','etc','theslider','config',
    'controlform','media','key','defs',

    //OLD LOADING//'fakepaused',

    'enabled','thetarget','agent','screentype','timecue','command',
    'rangestatus','autohiding','timer','tracks','index',
    'trackdata','audiodesk','skiplinks',
    'trigger','responsivedata','responsivewidth',
    'isaudio',

    'basekey','library','sliders','langkey',

    //OLD CONTROLLER//'controller',

    'movement','screenpermission','buttonkeys','players',
    'activesize','activerepeats','rangecount','handler',
    'midindex','screenplayer',

    //OLD LOADING//'isloading','buffertime','enough',
    'firstplaying','seeksync','timeoutcanplay','firstcanplay',
    'youtubecanplay','youtubeisplaying','youtubevolume',

    'fakevolume','keyclick','buttonkeyclick','progressevents',
    'repeating','timers','primers','iteminfo','itemkey','helpdialog',
    'slidertype','tooltipbutton','tooltipnodes',
    'transcues','transtracks','transtrack',
    'statekey','labelkey','buttonprops',
    'menudata','menudataprops','menuitems','nextmenuitem','openmenu',

    'playerwidth','playeraspect',
    'responsivedifference','responsiveevents',

    'xhome','xpost','xresponse','xstatus',
    'languages','isocode','defaultTrack','defaultTranscript',
    'ontrackchange','basevolume','currentvolume',
    'lines','voices','voicealt','voiceclass',


    //nb. this must be defined as a var because it's called using apply()
    'getVideoFallback'

);



//-- define symbols that can have their surrounding whitespace removed --//
//nb. be very careful with this, and especially consider its impact on text
//for visual output, and on regex patterns, and it's because of the most
//likely conflicts that we don't compress around "!" or "." or quote marks
//*** or is it okay to go eg. "return!foo" rather than "return !foo"?
//spaces that are required can be escaped, eg. "never\ compress\ these\ spaces"
//*** ideally this would know when it's inside a string or regex, and not compress there
$symbols = array
(
    '=','==','===','!=','!==','<','<=','>','>=','+=',
    '&&','||','{','}','?',':','+','-','*',
    '(',')','[',']',':',';',',','--','++','/','%'
);







//-- input and initial parse --//

/*** OLD ***/
//get the javascript content
//$js = file_get_contents($jsfile); */

//parse the javascript content into a variable
//which will allow it to contain PHP conditionals
//to show different code according to query data
//nb. within the JS the statements appear as JS comments, eg:
/***
                //<?php if(true) : ?>
***/
ob_start();
include($jsfile);
$js = ob_get_contents();
ob_end_clean();

//record its original file size before compressions
//in an array which leaves space to record the final size after compression
$overall_compression = array('before' => strlen($js));

//begin recording compression of extraneous information
//comments and whitespace that are not needed for functioning
//and debug sections that are not for production use
$extra_compression = array('whitespace' => 0, 'comments' => 0, 'debug' => 0);

//being recording data construct removal
//functions, variables and properties, booleans, and "this"
$data_compression = array('functions' => 0, 'vars' => 0, 'booleans' => 0, 'this' => 0);







//-- if compression is enabled --//
if($config['do-compression'])
{



    //-- remove comments --//

    //record the current file size
    $sizenow = strlen($js);

    //BEFORE doing that convert any protocols into pipes
    $js = preg_replace("/([a-z]+:)(\/\/)/", '\\1||', $js);

    //FIRST remove single-line comments
    $js = preg_replace("/\/\/.*$/m", "", $js);

    //THEN remove multi-line starred comments
    //which is second so that comments like "//***DEV" don't survive
    //this far to be treated as the start of a multi-line comment
    $js = ereg_replace("(\/\*([^*]|(\*+([^*\/])))*\*+\/)", "", $js);

    //AFTER that restore the double-slashes in protocols
    $js = preg_replace("/([a-z]+:)(\|\|)/", '\\1//', $js);

    //store the filesize difference for removed comments
    $extra_compression['comments'] += ($sizenow - strlen($js));







    //-- remove non-printed tabs and line-breaks --//

    //record the current file size
    $sizenow = strlen($js);

    //add a space after relevant statements which are followed by whitespace
    //in case they're only separated from what follows them
    //by tabs or line-breaks, the removal of which would cause a syntax error
    //nb. this will cause breakage if whitespace has not been removed
    //** what about instances of these as strings or substrings?
    //** as with symbol compression, it wouldn't matter if it knew when it was inside a string or regex
    $js = preg_replace("/(var|typeof|return|function|new|const|case)[\s]/", "\\1 ", $js);

    //remove tabs or tab-like groups of spaces
    $js = preg_replace("/([\t]|[ ]{4})/", "", $js);

    //remove or reduce line-breaks
    if($config['line-break-handling'] == 2)
    {
        $js = preg_replace("/[\r\n]/", "", $js);
    }
    elseif($config['line-break-handling'] == 1)
    {
        $js = preg_replace("/([\r\n]){2,}/", "$1", $js);
    }

    //store the filesize difference for removed whitespace
    $extra_compression['whitespace'] += ($sizenow - strlen($js));







    //-- remove unnecessary spaces between computational symbols --//

    //record the current file size
    $sizenow = strlen($js);

    //unless whitespace should be retained
    if($config['line-break-handling'] != 0)
    {
        //pre-convert any escaped spaces
        //to special symbols so they don't get converted
        while(stristr($js, '\\ '))
        {
            $js = str_replace('\\ ', '|-o-|_<-o->_|-o-|', $js);
        }

        //do the symbol spaces compression
        foreach($symbols as $i => $symbol)
        {
            while(stristr($js, ' ' . $symbol))
            {
                $js = str_replace(' ' . $symbol, $symbol, $js);
            }
            while(stristr($js, $symbol . ' '))
            {
                $js = str_replace($symbol . ' ', $symbol, $js);
            }
        }

        //convert the space symbols back to spaces
        while(stristr($js, '|-o-|_<-o->_|-o-|'))
        {
            $js = str_replace('|-o-|_<-o->_|-o-|', ' ', $js);
        }
    }

    //store the filesize difference for removed whitespace
    $extra_compression['whitespace'] += ($sizenow - strlen($js));








    //-- remove debug sections --//
    if($config['remove-debug'])
    {

        //record the current file size
        $sizenow = strlen($js);

        //explode the code string by debug condition declarations
        //** will this completely break if there are nested debug sections?
        //** not that there knowingly will be, but maybe by mistake
        $js = preg_split("/(?:else\s+)?if\(config\[\'#debug\'\](?:[<>][=]?[\-]?[0-9]+)?\)/", $js);

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
        foreach($js as $i => $section)
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
                $js[$i] = preg_replace_callback("/[\{\}]/", "set_depth", $section);

                //so then we split that string by its marker, save the second-half
                //back to the array, effectively discarding the first-half
                //entirely which contains all the code in the debug section
                $js[$i] = explode(']DEBUG]>', $js[$i]);
                $js[$i] = $js[$i][1];
            }
        }

        //finally join the array back into a single string
        //now with all the debug sections removed :-)
        $js = implode('', $js);

        //if line-breaking handling is "reduce", do it again
        //to reduce any double-breaks left behind by debug removal
        if($config['line-break-handling'] == 1)
        {
            $js = preg_replace("/([\r\n]){2,}/", "$1", $js);
        }

        //store the filesize difference for removed debug sections
        $extra_compression['debug'] += ($sizenow - strlen($js));
    }







    //-- reduce self-reference  --//

    //record the current file size
    $sizenow = strlen($js);

    //convert $this to $
    $js = str_replace('$this', '$', $js);

    //store the filesize difference for compressed functions
    $data_compression['this'] += ($sizenow - strlen($js));





    //-- reduce functions --//

    //record the current file size
    $sizenow = strlen($js);

    //do the function name compression and record the results
    //and recording the number of matches of each, for fine-tuning
    //so that we can give the single-number names to the most common functions
    $fn_compression = array();
    foreach($functions as $i => $name)
    {
        $fn_compression[] = array(
            'before' => $name,
            'after' => 'f' . $i,
            'matches' => preg_match_all("/\b($name\(|(?:$name)[\=\:](?:function\())/", $js, $matches)
            );

        //*** this should work even if symbol compression has not occurred
        //*** whereas here it assumes no whitespace between symbols
        //$js = str_replace($name . '(', 'f' . $i . '(', $js);
        //$js = str_replace($name . '=function(', 'f' . $i . '=function(', $js);
        //$js = str_replace($name . ':function(', 'f' . $i . ':function(', $js);
        $js = preg_replace("/\b($name\()/", "f$i(", $js);
        $js = preg_replace("/\b($name=function\()/", "f$i=function(", $js);
        $js = preg_replace("/\b($name:function\()/", "f$i:function(", $js);
    }

    //store the filesize difference for compressed functions
    $data_compression['functions'] += ($sizenow - strlen($js));





    //-- reduce variables and properties --//

    //record the current file size
    $sizenow = strlen($js);

    //define an array of letters for varname replacement
    $letters = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');

    //do the var name compression and record the results
    //preserving underscore prefixes in the replacement if the name has them
    //and recording the number of matches of each, for fine-tuning
    //so that we can give the single-letter names to the most common vars
    $i = 0;
    $digit = -1;
    $var_compression = array();
    foreach($variables as $name)
    {
        if($digit == -1) { $replacement = $letters[$i]; }
        else { $replacement = $letters[$i] . $digit; }

        if(substr($name, 0, 2) == '__') { $replacement = '__' . $replacement; }
        elseif(substr($name, 0, 1) == '_') { $replacement = '_' . $replacement; }

        $var_compression[] = array(
            'before' => $name,
            'after' => $replacement,
            'matches' => preg_match_all("/\b($name)\b/", $js, $matches)
            );

        //$js = str_replace($name, $replacement, $js);
        //use preg with boundaries to make it substring safe
        $js = preg_replace("/\b($name)\b/", $replacement, $js);

        $i ++;

        if($i == count($letters)) { $digit ++; $i = 0; }
    }

    //store the filesize difference for compressed functions
    $data_compression['vars'] += ($sizenow - strlen($js));



}
//-- endif compression is enabled --//







//-- final output --//

//record the final file size after compression
$overall_compression['after'] = strlen($js);

//send a javascript mime-type header
//(which will inconsequentially fail on the results analysis page)
@header("Content-Type:text/javascript");

//finally output the compressed JS code
echo $js;


?>
