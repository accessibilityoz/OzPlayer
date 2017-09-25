<!doctype html>
<html lang="en" id="shit-and-stuff">
<head>

    <meta charset="utf-8" />

    <title>OzResponsive (video)</title>



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
        }



        /*** DEV TMP (canvas grid background) ***/
        html
        {
            background:#fff url("../_dev/grid.png") repeat 15px 15px;
        }
        body
        {
            background:transparent;
        }



        /*** DEV (example container styles) ***/
        #container
        {
            /***
            ***/
            min-width:244px;
            max-width:804px;

            margin:7px;

            box-shadow:0 0 0 5px navy;


            margin-bottom:1000px;
        }



        /*** DEV (wrapping figure styles) ***/
        figure
        {
            display:inline-block;
            /**
            **/
            display:table;
            width:1%;

            margin:0;
            /**
            margin:0 auto;
            **/

            box-shadow:0 0 0 5px crimson;
        }



        /*** DEV (auto transcript width) ***/
        .ozplayer-transcript
        {
            width:auto !important;
        }



        /*** DEV (example additional markup styles) ***/
        #container p code
        {
            font:normal normal normal 1em monaco, courier, sans-serif;
        }

        #container > div > p
        {
            padding:1em;

            background:#fff;
        }

        #container > p, #container > p > img
        {
            -moz-box-sizing:border-box;
            -ms-box-sizing:border-box;
            -webkit-box-sizing:border-box;
            box-sizing:border-box;

            max-width:100%;
        }
        #container > p
        {
            display:inline-block;
            margin:0;

            box-shadow:0 0 0 5px forestgreen;
        }
        #container > p > img
        {
            border:2px solid black;
        }





    </style>



    <!-- MediaElement library (this must be in the head) -->
    <script src="./ozplayer-core/mediaelement.js" type="text/javascript"></script>

    <!-- required player + required highlights
         (these must go in order: player, highlights) -->
    <link rel="stylesheet" href="./tools/css_compressor.php?codebase=../ozplayer-core/ozplayer.css<?php echo('&amp;nocache=' . microtime(true)); ?>" media="all" type="text/css" />
    <!--
    <link rel="stylesheet" href="./ozplayer-core/ozplayer.css<?php echo('?nocache=' . microtime(true)); ?>" media="all" type="text/css" />
    -->
    <link rel="stylesheet" href="./ozplayer-skin/highlights-pink.css<?php echo('?nocache=' . microtime(true)); ?>" media="all" type="text/css" />

    <!-- (sample transcript styles) -->
    <link rel="stylesheet" href="transcript.css<?php echo('?nocache=' . microtime(true)); ?>" media="all" type="text/css" />
    <!--
    -->

</head>
<body id="www-brothercake-com">


    <!-- *** DEV EXAMPLE CONTAINER *** -->
    <div id="container">
    <!-- *** / DEV EXAMPLE CONTAINER *** -->



    <!-- *** DEV EXAMPLE MARKUP *** -->
    <figure>
    <!-- *** / DEV EXAMPLE MARKUP *** -->



    <!-- player markup -->
    <div
        id="demo" class="ozplayer"
        data-transcript="demo-transcript"
        data-responsive="container"
        data-responsive-mode="initial"
        data-controls="stack"
        >

        <!--
            width="1280" height="720"
            width="960" height="540"
            width="800" height="450"
            width="640" height="360"
            width="480" height="270"
            width="400" height="225"
            width="320" height="180"
            width="272" height="153"
            width="240" height="135"
        -->

        <video
            width="272" height="153"
            poster="./media/posters/HorribleHistories.jpg"
            preload="none"
            controls="controls"
            >

            <source src="./media/videos/HorribleHistories-VileVictorians.mp4" type="video/mp4" />
            <source src="./media/videos/HorribleHistories-VileVictorians.webm" type="video/webm" />


            <!--
            <track src="./media/captions/de/HorribleHistories-VileVictorians.vtt" kind="captions" srclang="de" label="Deutsch" />
            <track src="./media/captions/en/HorribleHistories-VileVictorians.vtt" kind="captions" srclang="en" label="English" default="default" />
            <track src="./media/captions/es/HorribleHistories-VileVictorians.vtt" kind="captions" srclang="es" label="Español" />
            <track src="./media/captions/fr/HorribleHistories-VileVictorians.vtt" kind="captions" srclang="fr" label="Français" />
            <track src="./media/captions/pa/HorribleHistories-VileVictorians.vtt" kind="captions" srclang="pa" label="ਪਜਾਬੀ ਦ" />
            <track src="./media/captions/ke/HorribleHistories-VileVictorians.vtt" kind="captions" srclang="ke" label="TlhIngan" />
            <track src="./media/captions/de/HorribleHistories-VileVictorians.vtt" kind="captions" srclang="de-xx" label="Deutsch" />
            <track src="./media/captions/en/HorribleHistories-VileVictorians.vtt" kind="captions" srclang="en-xx" label="English" default="default" />
            <track src="./media/captions/es/HorribleHistories-VileVictorians.vtt" kind="captions" srclang="es-xx" label="Español" />
            <track src="./media/captions/fr/HorribleHistories-VileVictorians.vtt" kind="captions" srclang="fr-xx" label="Français" />
            <track src="./media/captions/pa/HorribleHistories-VileVictorians.vtt" kind="captions" srclang="pa-xx" label="ਪਜਾਬੀ ਦ" />
            <track src="./media/captions/ke/HorribleHistories-VileVictorians.vtt" kind="captions" srclang="ke-xx" label="TlhIngan" />
            -->

            <!--
            -->
            <track src="./media/captions/de/HorribleHistories-VileVictorians.vtt" kind="captions" srclang="de" label="Deutsch" />
            <track src="./media/captions/en/HorribleHistories-VileVictorians.vtt" kind="captions" srclang="en" label="English captions with a very long label" default="default" />
            <track src="./media/captions/es/HorribleHistories-VileVictorians.vtt" kind="captions" srclang="es" label="Español" />
            <track src="./media/captions/fr/HorribleHistories-VileVictorians.vtt" kind="captions" srclang="fr" label="Français" />
            <track src="./media/captions/pa/HorribleHistories-VileVictorians.vtt" kind="captions" srclang="pa" label="ਪਜਾਬੀ ਦ" />
            <track src="./media/captions/ke/HorribleHistories-VileVictorians.vtt" kind="captions" srclang="ke" label="TlhIngan" />

            <!--
            <track src="./media/captions/de/HorribleHistories-VileVictorians.vtt" kind="captions" srclang="de" label="Deutsche Bildunterschriften die in Deutscher sprache sind" />
            <track src="./media/captions/en/HorribleHistories-VileVictorians.vtt" kind="captions" srclang="en" label="English Captions" default="default" />
            <track src="./media/captions/es/HorribleHistories-VileVictorians.vtt" kind="captions" srclang="es" label="Subtítulos en Español" />
            <track src="./media/captions/fr/HorribleHistories-VileVictorians.vtt" kind="captions" srclang="fr" label="Légendes Françaises" />
            <track src="./media/captions/pa/HorribleHistories-VileVictorians.vtt" kind="captions" srclang="pa" label="ਪਜਾਬੀ ਦ ਸਿਰਲਖ" />
            <track src="./media/captions/ke/HorribleHistories-VileVictorians.vtt" kind="captions" srclang="ke" label="TlhIngan GhItlh" />
            <track src="./media/transcripts/de/HorribleHistories-VileVictorians.vtt" kind="metadata" data-kind="transcript" srclang="de" />
            <track src="./media/transcripts/en/HorribleHistories-VileVictorians.vtt" kind="metadata" data-kind="transcript" srclang="en" />
            <track src="./media/transcripts/es/HorribleHistories-VileVictorians.vtt" kind="metadata" data-kind="transcript" srclang="es" />
            <track src="./media/transcripts/fr/HorribleHistories-VileVictorians.vtt" kind="metadata" data-kind="transcript" srclang="fr" />
            <track src="./media/transcripts/pa/HorribleHistories-VileVictorians.vtt" kind="metadata" data-kind="transcript" srclang="pa" />
            <track src="./media/transcripts/ke/HorribleHistories-VileVictorians.vtt" kind="metadata" data-kind="transcript" srclang="ke" />
            <track src="./media/captions/de/HorribleHistories-VileVictorians.vtt" kind="captions" srclang="de-xx" label="X Deutsche Bildunterschriften die in Deutscher sprache sind" />
            <track src="./media/captions/en/HorribleHistories-VileVictorians.vtt" kind="captions" srclang="en-xx" label="X English Captions" default="default" />
            <track src="./media/captions/es/HorribleHistories-VileVictorians.vtt" kind="captions" srclang="es-xx" label="X Subtítulos en Español" />
            <track src="./media/captions/fr/HorribleHistories-VileVictorians.vtt" kind="captions" srclang="fr-xx" label="X Légendes Françaises" />
            <track src="./media/captions/pa/HorribleHistories-VileVictorians.vtt" kind="captions" srclang="pa-xx" label="X ਪਜਾਬੀ ਦ ਸਿਰਲਖ" />
            <track src="./media/captions/ke/HorribleHistories-VileVictorians.vtt" kind="captions" srclang="ke-xx" label="X TlhIngan GhItlh" />
            -->



            <!--
            <source src="//player.vimeo.com/video/33340864" type="video/x-vimeo" />

            <source src="https://vimeo.com/33340864" type="video/x-vimeo" />

            <source src="//www.youtube.com/watch?v=NPVlljVWqBg" type="video/x-youtube" />

            <source src="//www.youtube.com/watch?v=pkHe4YCHd8o" type="video/x-youtube" />

            <source src="http://www.youtube.com/watch?v=ty8QtaSKw_U" type="video/x-youtube" />
            <track src="./media/captions/proxy.php?src=http://tvguide.lastown.com/bbc/subtitles/hustle-series-8/episode-2.srt"
                   data-sync="3.6" kind="captions" srclang="en" default="default" />

            <source src="./media/videos/Hustle-PicassoFingerPainting.mp4" type="video/mp4" />
            <source src="./media/videos/Hustle-PicassoFingerPainting.webm" type="video/webm" />
            <track src="./media/captions/en/Hustle-PicassoFingerPainting.vtt"
                   data-sync="3.6" kind="captions" srclang="en" default="default" />

            <source src="http://player.vimeo.com/external/85624400.sd.mp4?s=4ca2f9e54923b5cb4774e7afe6764a40" type="video/mp4" />
            <track src="./media/captions/en/ozplayer.vtt" kind="captions" srclang="en" default="default" />
            <track src="./media/transcripts/en/ozplayer-transcript.vtt" kind="metadata" data-kind="transcript" srclang="en" />

            <source src="./media/videos/BrainSurgerySketch.mp4" type="video/mp4" />
            <source src="./media/videos/BrainSurgerySketch.webm" type="video/webm" />
            <track src="./media/captions/en/BrainSurgerySketch.vtt" kind="captions" srclang="en" default="default" />
            <track src="./media/captions/de/BrainSurgerySketch.vtt" kind="captions" srclang="de" />


            <source src="http://dhjrqu8yhdp3e.cloudfront.net/media/ozplayer.mp4" type="video/mp4" />
            <source src="http://dhjrqu8yhdp3e.cloudfront.net/media/ozplayer.webm" type="video/webm" />

            <source src="./media/videos/ozplayer.mp4" type="video/mp4" />
            <source src="./media/videos/ozplayer.webm" type="video/webm" />

            <source src="//www.youtube.com/watch?v=EzbETcExSwE" type="video/x-youtube" />

            <track src="./media/captions/en/ozplayer.vtt" kind="captions" srclang="en" default="default" />
            <track src="./media/transcripts/en/ozplayer-transcript.vtt" kind="metadata" data-kind="transcript" srclang="en" />
            -->



            <!-- (EITHER) this format provides static fallback content when applicable -->
            <div class="ozplayer-fallback">

                <ul>
                    <li><a href="./media/videos/HorribleHistories-VileVictorians.mp4"><cite>Horrible Histories (Vile Victorians)</cite> (MP4)</a></li>
                    <li><a href="./media/videos/HorribleHistories-VileVictorians.webm"><cite>Horrible Histories (Vile Victorians)</cite> (WebM)</a></li>
                    <li><a href="./media/captions/en/HorribleHistories-VileVictorians.vtt"><cite>Horrible Histories (Vile Victorians)</cite> (English Captions)</a></li>
                </ul>

            </div>

        </video>

        <audio data-default="default" preload="none">

            <source src="./media/descriptions/HorribleHistories-VileVictorians.mp3" type="audio/mp3" />
            <source src="./media/descriptions/HorribleHistories-VileVictorians.ogg" type="audio/ogg" />

            <!--
            <source src="./media/descriptions/BrainSurgerySketch.mp3" type="audio/mp3" />
            <source src="./media/descriptions/BrainSurgerySketch.ogg" type="audio/ogg" />

            <source src="http://dhjrqu8yhdp3e.cloudfront.net/media/ozplayer.mp3" type="audio/mp3" />
            <source src="http://dhjrqu8yhdp3e.cloudfront.net/media/ozplayer.ogg" type="audio/ogg" />

            <source src="./media/descriptions/ozplayer.mp3" type="audio/mp3" />
            <source src="./media/descriptions/ozplayer.ogg" type="audio/ogg" />
            -->

        </audio>

    </div>



    <!-- *** DEV INFO DUMP *** -->
    <!--
    <pre contentEditable="true" id="info" style="display:block;width:auto;height:22.5em;resize:both;font-family:monaco,courier,monospace;font-size:10px;line-height:1.5em;padding:10px;text-align:left;overflow-y:auto;border:2px dashed gray;border-radius:2px;background:#ddd;color:#666;"></pre>
    -->
    <!-- *** / DEV INFO DUMP *** -->



    <!-- optional player transcript container -->
    <div id="demo-transcript" class="ozplayer-transcript"></div>


    <!-- *** DEV EXAMPLE MARKUP *** -->
    </figure>
    <!-- *** / DEV EXAMPLE MARKUP *** -->



    <!-- *** DEV EXAMPLE ADDITIONAL MARKUP *** -->
    <div>
        <p>
            This is just ordinary text so you can get a sense of scale, while the
            poster below is an <code>&lt;img&gt;</code> using <code>max-width:100%</code>
        </p>
    </div>
    <p>
        <img src="./media/posters/HorribleHistories.jpg" alt="" />
    </p>
    <!-- *** / DEV EXAMPLE ADDITIONAL MARKUP *** -->



    <!-- *** DEV ADDITIONAL INSTANCES *** -->
    <!--
    <figure style="margin-top:5em;">
        <div id="demo4" class="ozplayer" data-transcript="demo4-transcript" data-responsive="container" data-controls="stack">
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
    -->
    <!-- *** / DEV ADDITIONAL INSTANCES *** -->



    <!-- *** DEV EXAMPLE CONTAINER *** -->
    </div>
    <!-- *** / DEV EXAMPLE CONTAINER *** -->






    <!-- *** DEV ADDITIONAL INSTANCES *** -->
    <!--
    <figure>
        <div id="demo3" class="ozplayer" data-responsive="container">
            <video width="800" height="450" preload="auto" controls="controls">
                <source src="./media/videos/SendUsYourReckons.mp4" type="video/mp4" />
                <source src="./media/videos/SendUsYourReckons.webm" type="video/webm" />
            </video>
        </div>
    </figure>
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
                    lighthref = lighthref.replace('-pink', '-yellow');
                    //lighthref = lighthref.replace('-pink', '-blue');
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
    <script src="./tools/compressor.php?codebase=../ozplayer-core/ozplayer.js<?php echo('&amp;nocache=' . microtime(true)); ?>" type="text/javascript"></script>
    <!--
    <script src="./ozplayer-core/ozplayer.js<?php echo('?nocache=' . microtime(true)); ?>" type="text/javascript"></script>
    <script src="./tools/compressor.php?fork=subs&amp;do-compression=false&amp;codebase=../ozplayer-core/ozplayer.js<?php echo('&amp;nocache=' . microtime(true)); ?>" type="text/javascript"></script>
    <script src="./tools/compressor.php?fork=free&amp;do-compression=false&amp;codebase=../ozplayer-core/ozplayer.js<?php echo('&amp;nocache=' . microtime(true)); ?>" type="text/javascript"></script>
    <script src="https://ozplayer.global.ssl.fastly.net/3.0/ozplayer-core/ozplayer.free.js" type="text/javascript"></script>
    -->
    <script src="./ozplayer-lang/en.js<?php echo('?nocache=' . microtime(true)); ?>" type="text/javascript"></script>
    <script src="test.js<?php echo('?nocache=' . microtime(true)); ?>" type="text/javascript"></script>



</body>
</html>
