<!doctype html>
<html lang="en" id="shit-and-stuff">
<head>

    <meta charset="utf-8" />

    <title>OzPlayer (audio)</title>



    <!-- viewport settings -->
    <meta name="viewport" content="width=device-width" />



    <!-- *** DEV TMP (handle aggressive caching in mobile safari) *** -->
    <script type="text/javascript">
    /**
    if(window.localStorage)
    {
        var key = encodeURIComponent(document.location.pathname);
        if(!window.localStorage[key]) { window.localStorage[key] = 1; }
        if(document.location.href.indexOf('?nocache=') < 0) { document.location.href = document.location.href + '?nocache=' + window.localStorage[key]; }
        else if(document.location.href.indexOf('?nocache=' + window.localStorage[key]) < 0) { document.location.href = document.location.href.replace(/nocache=([\d]+)/g, 'nocache=' + window.localStorage[key]); }
        else { window.localStorage[key] = parseInt(window.localStorage[key], 10) + 1; }
    }
    **/
    </script>

    <!-- *** DEV TMP (basic html5 shim) *** -->
    <script type="text/javascript">
    (function()
    {
        for(var tags = ['figure','figcaption','video'], i = 0; i < tags.length; i ++)
        {
            document.createElement(tags[i]);
        }
    })();
    </script>



    <!-- (general canvas settings, not required for player) -->
    <style type="text/css">

        /* canvas font and color reset */
        html, body
        {
            margin:0;
            padding:0;

            font:normal normal normal 100%/1.4 verdana,sans-serif;

            background:#fff;
            color:#000;
        }
        body
        {
            padding:15px;

            padding-bottom:1000px;
        }

        /* structural labels */
        h2.structural-label
        {
            position:absolute;
            left:-1000em;
        }

        /*** DEV (wrapping figure styles) ***//* */
        figure
        {
            display:table;
            width:1%;
            margin:0 auto;
        }

        /*** container top margin to create demo space for tooltips ***/
        figure
        {
            margin-top:1em;
        }

        /*** DEV (fallback <audio> width when viewing without JS) ***/
        #demo audio
        {
            width:480px;
        }

        /*** DEV (override transcript styles) ***/
        #demo + .ozplayer-expander
        {
            width:484px;
        }
        #demo-transcript.ozplayer-transcript
        {
            width:440px;
        }

        /*** DEV TMP TEST STYLES ***//***
        #demo
        {
            border: 5px solid #f9f !important;
            width:640px !important;
            height:360px !important;
        }
        ***/



    </style>



    <!-- MediaElement library (this must be in the head) -->
    <script src="./ozplayer-core/mediaelement.js" type="text/javascript"></script>

    <!-- required player + required highlights
         (these must go in order: player, highlights) -->
    <link rel="stylesheet" href="./ozplayer-core/ozplayer.css<?php echo('?nocache=' . microtime(true)); ?>" media="all" type="text/css" />
    <!--
    <link rel="stylesheet" href="./tools/css_compressor.php?codebase=../ozplayer-core/ozplayer.css<?php echo('&amp;nocache=' . microtime(true)); ?>" media="all" type="text/css" />
    -->
    <link rel="stylesheet" href="./ozplayer-skin/highlights-pink.css<?php echo('?nocache=' . microtime(true)); ?>" media="all" type="text/css" />

    <!-- (sample transcript styles) -->
    <link rel="stylesheet" href="transcript.css<?php echo('?nocache=' . microtime(true)); ?>" media="all" type="text/css" />
    <!--
    -->



    <!-- *** DEV WORDPRESS STYLESHEET *** -->
    <!--
    <link rel="stylesheet" href="../_dev/accessibility-oz-wp-style.css" media="screen, projection" />
    -->
    <!-- *** / DEV WORDPRESS STYLESHEET *** -->


    <!-- *** DEV VERY TMP TEST STYLES FOR WHEN CSS IS NOT APPLIED -->
    <!--
    <style>
    .oz-controls .oz-menuitem[aria-disabled="true"]
    {
        color:#999;
    }
    .oz-controls .oz-menuitem[aria-hidden="true"]
    {
        background:#caa;
    }
    .oz-controls .oz-menuitem input
    {
        outline: 2px solid limegreen;
    }
    .oz-controls .oz-menuitem input[disabled]
    {
        outline: 2px solid red;
    }
    .oz-controls .oz-menu[aria-hidden="false"]
    {
        border: 2px solid limegreen;
    }
    .oz-controls .oz-menu[aria-hidden="true"]
    {
        border: 2px solid red;
    }
    </style>
    -->

</head>
<body id="www-brothercake-com">




    <!-- *** DEV EXAMPLE MARKUP *** -->
    <figure id="demo-figure">
    <!-- *** / DEV EXAMPLE MARKUP *** -->

    <!-- player markup -->
    <div
        id="demo" class="ozplayer"
        data-transcript="demo-transcript"
        >
        <audio
            data-width="480"
            preload="none"
            controls="controls"
            >

            <source src="./media/descriptions/BrainSurgerySketch.mp3" type="audio/mp3" />
            <source src="./media/descriptions/BrainSurgerySketch.ogg" type="audio/ogg" />
            <!--
            <source src="http://www.brothercake.com/clients/GianWild/VideoPlayer/media/descriptions/BrainSurgerySketch.mp3<?php echo('?nocache=' . microtime(true)); ?>" type="audio/mp3" />
            <source src="http://www.brothercake.com/clients/GianWild/VideoPlayer/media/descriptions/BrainSurgerySketch.ogg<?php echo('?nocache=' . microtime(true)); ?>" type="audio/ogg" />
            -->

            <track src="./media/captions/en/BrainSurgerySketch.vtt" kind="captions" srclang="en" label="English" />
            <track src="./media/captions/de/BrainSurgerySketch.vtt" kind="captions" srclang="de" label="Deutsch" />
            <track src="./media/captions/fr/BrainSurgerySketch.vtt" kind="captions" srclang="fr" label="Français" />

            <!--
            <track src="./media/captions/de/HorribleHistories-VileVictorians.vtt" kind="captions" srclang="de" label="Deutsche Bildunterschriften die in Deutscher sprache sind" />
            <track src="./media/captions/en/HorribleHistories-VileVictorians.vtt" kind="captions" srclang="en" label="English Captions" default="default" />
            <track src="./media/captions/es/HorribleHistories-VileVictorians.vtt" kind="captions" srclang="es" label="Subtítulos en Español" />
            <track src="./media/captions/fr/HorribleHistories-VileVictorians.vtt" kind="captions" srclang="fr" label="Légendes Françaises" />
            <track src="./media/captions/pa/HorribleHistories-VileVictorians.vtt" kind="captions" srclang="pa" label="ਪਜਾਬੀ ਦ ਸਿਰਲਖ" />
            <track src="./media/captions/tlh/HorribleHistories-VileVictorians.vtt" kind="captions" srclang="tlh" label="TlhIngan GhItlh" />
            <track src="./media/transcripts/de/HorribleHistories-VileVictorians.vtt" kind="metadata" data-kind="transcript" srclang="de" />
            <track src="./media/transcripts/en/HorribleHistories-VileVictorians.vtt" kind="metadata" data-kind="transcript" srclang="en" />
            <track src="./media/transcripts/es/HorribleHistories-VileVictorians.vtt" kind="metadata" data-kind="transcript" srclang="es" />
            <track src="./media/transcripts/fr/HorribleHistories-VileVictorians.vtt" kind="metadata" data-kind="transcript" srclang="fr" />
            <track src="./media/transcripts/pa/HorribleHistories-VileVictorians.vtt" kind="metadata" data-kind="transcript" srclang="pa" />
            <track src="./media/transcripts/tlh/HorribleHistories-VileVictorians.vtt" kind="metadata" data-kind="transcript" srclang="tlh" />
            <track src="./media/captions/de/HorribleHistories-VileVictorians.vtt" kind="captions" srclang="de-xx" label="X Deutsche Bildunterschriften die in Deutscher sprache sind" />
            <track src="./media/captions/en/HorribleHistories-VileVictorians.vtt" kind="captions" srclang="en-xx" label="X English Captions" default="default" />
            <track src="./media/captions/es/HorribleHistories-VileVictorians.vtt" kind="captions" srclang="es-xx" label="X Subtítulos en Español" />
            <track src="./media/captions/fr/HorribleHistories-VileVictorians.vtt" kind="captions" srclang="fr-xx" label="X Légendes Françaises" />
            <track src="./media/captions/pa/HorribleHistories-VileVictorians.vtt" kind="captions" srclang="pa-xx" label="X ਪਜਾਬੀ ਦ ਸਿਰਲਖ" />
            <track src="./media/captions/tlh/HorribleHistories-VileVictorians.vtt" kind="captions" srclang="tlh-xx" label="X TlhIngan GhItlh" />
            -->

            <div class="ozplayer-fallback">
                <ul>
                    <li><a href="./media/videos/ozplayer.mp4"><cite>About OzPlayer</cite> (MP4)</a></li>
                    <li><a href="./media/videos/ozplayer.webm"><cite>About OzPlayer</cite> (WebM)</a></li>
                    <li><a href="./media/captions/en/ozplayer.vtt"><cite>About OzPlayer</cite> (English Captions)</a></li>
                </ul>
            </div>

        </audio>

    </div>



    <!-- optional transcript expander -->
    <details class="ozplayer-expander" open="open">

        <!-- transcript expander trigger (required first-child if expander is present) -->
        <summary>Audio Transcript</summary>



        <!-- optional player transcript container -->
        <div id="demo-transcript" class="ozplayer-transcript">
        <?php

            //import the OzPlayer class
            /***
            require('./$devsrc/OzPlayer.php');
            require('./src/OzPlayer.php');
            ***/
            require('./ozplayer-core/OzPlayer.php');

            //define the captions data as language code => file path
            $captions = array('en' => './media/captions/en/HorribleHistories-VileVictorians.vtt');

            //optionally define the additional transcript data the same way
            $transcript = array('en' => './media/transcripts/en/HorribleHistories-VileVictorians.vtt');

            /***
            //now pass the captions and transcript data to the get_transcript method
            //which will load and parse the data and compile it into transcript markup
            OzPlayer::get_transcript($captions, $transcript);
            ***/

        ?>
        </div>
    </details>



    <!-- *** DEV EXAMPLE MARKUP *** -->
    </figure>
    <!-- *** / DEV EXAMPLE MARKUP *** -->





    <!-- *** DEV ADDITIONAL INSTANCES *** -->
    <div style="margin-top:20px !important;margin-bottom:20px !important;text-align:center !important;">
        <figure style="display:inline-table !important;margin:10px 0 0 0 !important;">
            <div id="demo5" class="ozplayer" data-transcript="demo5-transcript" data-controls="stack">
                <video width="640" height="360"
                    poster="./media/posters/BrainSurgerySketch.jpg"
                    preload="none" controls="controls">
                    <source src="./media/videos/BrainSurgerySketch.webm" type="video/webm" />
                    <source src="./media/videos/BrainSurgerySketch.mp4" type="video/mp4" />
                    <track src="./media/captions/en/BrainSurgerySketch.vtt" kind="captions" srclang="en" label="English" default="default" />
                    <track src="./media/captions/de/BrainSurgerySketch.vtt" kind="captions" srclang="de" label="Deutsch" />
                </video>
                <audio data-default="default" preload="none">
                    <source src="./media/descriptions/BrainSurgerySketch-PS.mp3" type="audio/mp3" />
                    <source src="./media/descriptions/BrainSurgerySketch-PS.ogg" type="audio/ogg" />
                </audio>
            </div>
            <div id="demo5-transcript" class="ozplayer-transcript"></div>
        </figure>
        <figure style="display:inline-table !important;margin:10px 0 0 0 !important;">
            <div id="demo4" class="ozplayer" data-transcript="demo4-transcript" data-controls="stack">
                <video width="480" height="270"
                    poster="./media/posters/ozplayer.png"
                    preload="none" controls="controls">
                    <source src="./media/videos/ozplayer.mp4" type="video/mp4" />
                    <source src="./media/videos/ozplayer.webm" type="video/webm" />
                    <track src="./media/captions/en/ozplayer.vtt" kind="captions" srclang="en" default="default" />
                    <track src="./media/transcripts/en/ozplayer-transcript.vtt" kind="metadata" data-kind="transcript" srclang="en" />
                </video>
                <audio data-default="default" preload="none">
                    <source src="./media/descriptions/ozplayer.mp3" type="audio/mp3" />
                    <source src="./media/descriptions/ozplayer.ogg" type="audio/ogg" />
                </audio>
            </div>
            <div id="demo4-transcript" class="ozplayer-transcript"></div>
        </figure>
        <!--
        <figure style="display:inline-table !important;margin:10px 0 0 0 !important;">
            <div id="demo3" class="ozplayer">
                <video width="640" height="360" preload="auto" controls="controls">
                    <source src="./media/videos/SendUsYourReckons.mp4" type="video/mp4" />
                    <source src="./media/videos/SendUsYourReckons.webm" type="video/webm" />
                </video>
            </div>
        </figure>
        <figure style="display:inline-table !important;margin:10px 0 0 0 !important;">
            <div id="demo2" class="ozplayer" data-transcript="demo2-transcript" data-controls="stack">
                <video width="240" height="135"
                    poster="./media/posters/Limmys-Show.jpg"
                    preload="none" controls="controls">
                    <source src="./media/videos/Limmys-Show-Season3-Episode1.mp4" type="video/mp4" />
                    <source src="./media/videos/Limmys-Show-Season3-Episode1.webm" type="video/webm" />
                    <track src="./media/captions/en/Limmys-Show-Season3-Episode1.srt"
                           kind="captions" srclang="en" default="default" />
                </video>
            </div>
            <div id="demo2-transcript" class="ozplayer-transcript" style="width:200px !important;font-size:0.7em !important;"></div>
        </figure>
        -->
    </div>
    <!--
    -->
    <!-- *** / DEV ADDITIONAL INSTANCES *** -->





    <!-- *** DEV TEST SCRIPTING *** -->
    <script type="text/javascript">
    (function()
    {




        /*** DEV TMP (switch highlight stylesheets by browser) ***//* */
        try
        {
            var
            lightsheet = null,
            lighthref = null;
            links = document.getElementsByTagName('link');
            for(var len = links.length, i = 0; i < len; i ++)
            {
                if((lighthref = links[i].href).indexOf('highlights-pink.css') > -1)
                {
                    lightsheet = links[i];
                    break;
                }
            }
            if(lightsheet)
            {
                if(window.opera)
                {
                    //lighthref = lighthref.replace('-pink', '-red');
                }
                else if(/firefox/i.test(navigator.userAgent))
                {
                    lighthref = lighthref.replace('-pink', '-orange');
                }
                else if(navigator.vendor == 'Google\ Inc.')
                {
                    //lighthref = lighthref.replace('-pink', '-yellow');
                    lighthref = lighthref.replace('-pink', '-blue');
                }
                else if(/(ipad|iphone)/i.test(navigator.userAgent))
                {
                    lighthref = lighthref.replace('-pink', '-yellow');
                }
                else if(navigator.vendor == 'Apple Computer,\ Inc.')
                {
                    lighthref = lighthref.replace('-pink', '-purple');
                }
                else if(/msie/i.test(navigator.userAgent))
                {
                    lighthref = lighthref.replace('-pink', '-green');
                    //lighthref = lighthref.replace('-pink', '-yellow');
                }
                lightsheet.href = lighthref;
            }
        }
        catch(ex){}




        //*** DEV TMP (convert video, audio[, and track] paths to remote files)
        //nb. the src isn't qualified in IE so we have to do that manually
        /***
        function qualify(href)
        {
            var here = document.location.href;var parts = here.replace('//', '/').split('/');var loc = {'protocol' : parts[0],'host' : parts[1]};parts.splice(0, 2);loc.pathname = '/' + parts.join('/');var uri = loc.protocol + '//' + loc.host;if(/^(\.\/)([^\/]?)/.test(href)){href = href.replace(/^(\.\/)([^\/]?)/, '$2');}if(/^([a-z]+)\:\/\//.test(href)){uri = href;}else if(href.substr(0, 1) == '/'){uri += href;}else if(/^((\.\.\/)+)([^\/].*$)/.test(href)){var lastpath = href.match(/^((\.\.\/)+)([^\/].*$)/);lastpath = lastpath[lastpath.length - 1];var references = href.split('../').length - 1;var parts = loc.pathname.split('/');parts = parts.splice(0, parts.length - 1);for(var i=0; i<references; i++){parts = parts.splice(0, parts.length - 1);}var path = '';for(i=0; i<parts.length; i++){if(parts[i] != ''){path += '/' + parts[i];}}path += '/';path += lastpath;uri += path;}else{path = '';parts = loc.pathname.split('/');parts = parts.splice(0, parts.length - 1);for(var i=0; i<parts.length; i++){if(parts[i] != ''){path += '/' + parts[i];}}path += '/';uri += path + href;}return uri;
        }
        function remote(src)
        {
            return qualify(src).replace(/(localhost|cakebook(\.local)?|192\.168\.1\.3)/, 'www.brothercake.com')
            + '?nocache=' + new Date().getTime()
            + '';
        }
        var sources = document.getElementsByTagName('source');
        for(var i = 0; i < sources.length; i ++)
        {
            //*** DEV TMP
            //if(sources[i].type.indexOf('audio') < 0) { continue; }

            if(sources[i].src)
            {
                sources[i].src = remote(sources[i].src);
            }
            //safari 5 needs this, dky
            else
            {
                sources[i].setAttribute('src', remote(sources[i].getAttribute('src')));
            }

            //*** DEV TMP
            //document.getElementById('info').innerHTML = sources[i].src + '<br >' + document.getElementById('info').innerHTML;
        }
            //var tracks = document.getElementsByTagName('track');
            //for(var i = 0; i < tracks.length; i ++)
            //{
            //	tracks[i].src = './media/captions/proxy.php?src=' + remote(tracks[i].src);
            //}
        ***/


    })();
    </script>
    <!-- *** / DEV TEST SCRIPTING *** -->







    <!-- required player + optional lang + required configuration
         (these should be at the end of the body, and must go in order: core, lang, configuration) -->
    <script src="./ozplayer-core/ozplayer.js<?php echo('?nocache=' . microtime(true)); ?>" type="text/javascript"></script>
    <!--
    <script src="./tools/compressor.php?codebase=../ozplayer-core/ozplayer.js<?php echo('&amp;nocache=' . microtime(true)); ?>" type="text/javascript"></script>
    <script src="./tools/compressor.php?fork=subs&amp;do-compression=false&amp;codebase=../ozplayer-core/ozplayer.js<?php echo('&amp;nocache=' . microtime(true)); ?>" type="text/javascript"></script>
    <script src="./tools/compressor.php?fork=free&amp;do-compression=false&amp;codebase=../ozplayer-core/ozplayer.js<?php echo('&amp;nocache=' . microtime(true)); ?>" type="text/javascript"></script>
    <script src="https://ozplayer.global.ssl.fastly.net/3.0/ozplayer-core/ozplayer.free.js" type="text/javascript"></script>
    -->
    <script src="./ozplayer-lang/en.js<?php echo('?nocache=' . microtime(true)); ?>" type="text/javascript"></script>
    <script src="test.js<?php echo('?nocache=' . microtime(true)); ?>" type="text/javascript"></script>



    <!-- *** DEV TMP TEST FOR EXPECTED DATA *** --><!--
    <script type="text/javascript">
    var str = 'AFTER "ozplayer.js":\n\n';
    for(var i in OzPlayer)
    {
        str += '['+i+'] = ' + (typeof(OzPlayer[i]) == 'function' ? 'function' : OzPlayer[i]) + '\n';
        if(typeof(OzPlayer[i]) == 'object' && !(OzPlayer[i] instanceof Array))
        {
            for(var j in OzPlayer[i])
            {
                if(typeof(OzPlayer[i][j]) == 'object' && !(OzPlayer[i][j] instanceof Array))
                {
                    str += '\t['+j+'] = ' + OzPlayer[i][j] + '\n';
                }
            }
        }
    }
    alert(str);
    </script> -->



</body>
</html>
