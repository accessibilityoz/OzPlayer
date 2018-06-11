<!doctype html>
<html lang="en" id="shit-and-stuff">
<head>

    <meta charset="utf-8" />

    <title>OzPlayer (video<?php if(isset($_GET['video'])) { echo ': ' . $_GET['video']; } ?>)</title>



    <!-- *** DEV (viewport settings) *** -->
    <!--
     <meta name="viewport" content="width=device-width" />
    -->



    <!-- *** DEV TEST SCRIPTING *** -->
    <script type="text/javascript" src="../_dev/console.table.js"></script>
    <script type="text/javascript">
    (function()
    {

        //*** DEV (global event handler, now critical for debugging in iOS)
        window.onerror = function(){ if(!(arguments[0] instanceof ProgressEvent)) {
            //alert(arguments[0] + '\n\nfile = '+(arguments[1] || '').replace(/([^\/]+[\/]+)/g, '') + '\nline = ' + arguments[2]);
            console.error(arguments);
            } };

    })();
    </script>



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
            display:table !important;
            width:1% !important;
            margin:0 auto !important;
        }



        /* hide underlining in caption links *//*
        .ozplayer .oz-captions a,
        .ozplayer .oz-captions a:visited
        {
            text-decoration:none !important;
        } */



        /*** DEV TMP (testing priority with other page css) ***//*
        #posts p
        {
            font-family:fantasy;
        }
        #posts p q
        {
            quotes: "\201c" "\201d";
        }
        #posts p q::before
        {
            content:open-quote;
            font-size:3em;
        }
        #posts p q::after
        {
            content:close-quote;
            font-size:3em;
        }
        #posts li a, #posts li a:visited
        {
            color:yellow;
            background:navy;
            font-family:monospace;
            line-height:3;
            font-size:11px;
        }
        #posts button
        {
            border:1px solid cyan;
            color:limegreen;
            font-family:serif;
        }
        #posts em
        {
            background:white;
            color:crimson;
            font-family:cursive;
        }
        #container span > span
        {
            margin:5px;
        }
        #demo.ozplayer .oz-poster
        {
            width:300px;
            height:150px;
        }
        #demo form
        {
            width:250px;
            height:150px;
            border:5px double crimson;
        }
        #demo form *
        {
            border:3px solid cyan;
            margin:10px;
            padding:10px;
        }
        #demo form fieldset
        {
            background:#fff;
            border:3px inset green;
        }
        #posts label
        {
            width:15em;
            padding:1em;
            border-bottom:3px double orange;
        }
        #demo *
        {
            visibility:hidden;
            line-height:50px;
        } */


        /* sample cue, voice and class styles *//*
        #demo-transcript
        {
            height:30em;
        }
        #demo-transcript [data-cue="9"] *
        {
            color:#909 !important;
        }
        #demo-transcript [data-voice="Lionel"] *
        {
            font-family:serif !important;
        }
        #demo-transcript [data-cue="9"] mark
        {
            background-color:#fec !important;
        }
        #demo-transcript [data-cue="9"] mark *
        {
            color:#f60 !important;
        }
        #demo-transcript p.job
        {
            text-decoration:overline;
        }
        #demo-transcript p[data-voice-alt="true"] q
        {
            background:cyan;
        }
        #demo-transcript span.brain
        {
            font-variant:small-caps;
        }
        #demo-transcript span.surgeon
        {
            color:crimson;
        }
        #demo-transcript span.surgery
        {
            color:green;
        }
        #demo-transcript span.accountant
        {
            color:blue;
        }
        #demo-transcript span.charity
        {
            color:darkorange;
        }
        #demo-transcript span.rocket
        {
            text-transform:uppercase;
            font-family:cursive;
            color:darkcyan;
        }
        #demo-transcript span[lang]
        {
            font-family:"american typewriter", courier, monospace;
        } */




        /* sample caption styling *//*
        .ozplayer .oz-captions p.job
        {
            text-decoration:line-through !important;
        }
        .ozplayer .oz-captions p .uppercase
        {
            text-transform:uppercase !important;
        }
        .ozplayer .oz-captions p .monospace
        {
            font-family:monospace !important;
        } */




        /* sample caption voice colours *//*
        #demo .oz-captions [data-voice="Hostess"] *
        {
            color:#ff0 !important;
        }
        #demo .oz-captions [data-voice="Lionel"] *
        {
            color:#fff !important;
        }
        #demo .oz-captions [data-voice="Female Guest"] *
        {
            color:#3f3 !important;
        }
        #demo .oz-captions [data-voice="Male Guest"] *
        {
            color:#f6f !important;
        }
        #demo .oz-captions [data-voice="Jeff"] *
        {
            color:#0ff !important;
        } */




        /*** EXPERIMENTAL demo transcript => alternate layout
             nb. this still affects opera in fullscreen mode ***//***
        @media screen and (min-width:1200px)
        {
            figure
            {
                position:relative;

                display:block;
                width:100%;
            }
            #demo
            {
                position:absolute;
                left:0;
                top:0;

                display:table;
            }
            #demo-transcript
            {
                position:absolute !important;
                right:0;
                top:0;

                margin:0 0 0 650px;

                -moz-box-sizing:border-box;
                -ms-box-sizing:border-box;
                -webkit-box-sizing:border-box;
                box-sizing:border-box;

                height:100%;
            }
        }
        ***/



        /*** DEV TMP ***//*
        .focusbox
        {
            width:3em;
            line-height:1em;
            padding:1em 0;
            min-height:1em;
            margin:0 5px 5px 0;
            border:5px solid green;
            background:lightgreen;
            display:inline-block;
            text-align:center;
            vertical-align:middle;
        }
        .focusbox:focus
        {
            border-color:darkorange;
        }
        #propboxes .focusbox
        {
            border-color:crimson;
            background:pink;
        }
        #propboxes .focusbox:focus
        {
            border-color:hotpink;
        }
        #attrboxes .focusbox
        {
            border-color:navy;
            background:lightblue;
        }
        #attrboxes .focusbox:focus
        {
            border-color:darkviolet;
        } */






        /*** DEV LOG (figure reset) ***//* */
        figure
        {
            display:inline-block !important;
            width:auto !important;
            margin:0 !important;
        }

        /*** DEV LOG (smaller transcript) ***//* */
        .ozplayer-expander
        {
            width:484px !important;
        }
        .ozplayer-transcript
        {
            width:440px !important;
        }

        /*** DEV LOG (log styles) ***//* */
        .log
        {
            overflow:auto;
            position:absolute;
            right:15px;
            z-index:1000;
            margin:15px 0 0 0;
            padding:10px;
            border:2px solid #999;
            background:#ddd;
            color:#444;
            font:normal normal normal 10px/12px monaco,  "lucida console", "courier new", monospace;
            white-space:nowrap;
        }
        #videolog.log
        {
            top:0%;
        }
        #audiolog.log
        {
            top:49%;
        }
        .log
        {
            outline:none;
        }
        .log b
        {
            font-weight:normal;
            color:#f00;
        }
        .log b b
        {
            color:#fff;
            background:#f55;
        }
        .log i
        {
            font-style:normal;
            color:#f90;
        }
        .log u
        {
            text-decoration:none;
            color:#0a0;
        }
        .log s
        {
            text-decoration:none;
            opacity:0.5;
            filter:alpha(opacity=50);
        }
        .log dfn
        {
            font-style:normal;
            color:#990;
        }
        .log ins
        {
            text-decoration:none;
            color:#b0b;
        }
        .log del
        {
            text-decoration:none;
            color:#c9e;
        }
        .log tt
        {
            font:inherit;
            color:#7aa;
        }
        .log mark
        {
            font:inherit;
            background:transparent;
            color:#66c;
        }
        .log tt strong,
        .log del strong
        {
            color:#0a0;
        }
        .log tt small,
        .log del small
        {
            font:inherit;
            font-weight:bold;
            color:#f00;
        }

        /*** DEV LOG (log filters) ***//* */
        .log + form
        {
            position:absolute;
            right:17px;
            z-index:2000;
            margin:17px 0 0 0;
            font:normal normal normal 10px/12px monaco,  "lucida console", "courier new", monospace;
            color:#555;
        }
        .log + form label
        {
            padding-right:5px;
        }
        #videolog.log + form
        {
            top:0%;
        }
        #audiolog.log + form
        {
            top:49%;
        }



        /*** DEV TMP (expand the transcript) ***//*
        .ozplayer-transcript
        {
            height: auto !important;
        } */

    </style>

    <!-- *** DEV (html5 figure shim) *** -->
    <script type="text/javascript">
    (function()
    {
        for(var tags = ['figure','figcaption'], i = 0; i < tags.length; i ++)
        {
            document.createElement(tags[i]);
        }
    })();
    </script>



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


    <!-- *** DEV VERY TMP ON/OFF STATE STYLES --><!--
    <style>
    .oz-controls .oz-field button.oz-on
    {
        box-shadow:inset 0 0 0 2px limegreen !important;
    }
    .oz-controls .oz-field button.oz-off
    {
        box-shadow:inset 0 0 0 2px red !important;
    }
    .oz-controls .oz-field button[aria-pressed="true"]
    {
        outline:2px dashed limegreen !important;
    }
    .oz-controls .oz-field button[aria-pressed="false"]
    {
        outline:2px dashed red !important;
    }
    </style>
    -->


    <!-- *** DEV TMP TEST STYLES FOR WHEN CSS IS NOT APPLIED -->
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


    <!-- *** DEV WORDPRESS CONTAINERS *** -->
    <!--
    <div id="container">
    <div id="container2">
    <div id="container3">
    <div id="content">
    <div id="posts">
    -->
    <!-- *** / DEV WORDPRESS CONTAINERS *** -->





    <!-- *** DEV TEST MARKUP *** -->
    <!--
    <form style="display:table;width:640px;margin:0 auto 0 auto;" action="javascript:void(null)"><input value="before" /><input type="submit" id="before" /></form>
    <div id="focusboxes" style="display:table;width:640px;margin:20px auto 0 auto;">
        <span class="focusbox" tabindex="0">F-B-1</span>
        <span class="focusbox" tabindex="0">F-B-2</span>
        <span class="focusbox" tabindex="0">F-B-3</span>
        <span class="focusbox" tabindex="0">F-B-4</span>
        <span class="focusbox" tabindex="0">F-B-5</span>
        <span class="focusbox" tabindex="0">F-B-6</span>
    </div>
    <div style="display:table;width:640px;margin:0 auto 20px auto;">
        <h2>Whatever's before the video and transcript</h2>
        <p>
            Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Nunc neque. In hac habitasse
            platea dictumst. Pellentesque ultrices. Donec nunc metus, aliquam sit amet, aliquam in,
            luctus ac, odio. Aenean orci velit, elementum ac, egestas pellentesque, facilisis non,
            turpis. Quisque dolor. Vestibulum in massa in lectus hendrerit condimentum. Duis suscipit,
            lectus varius fermentum fermentum, est lectus facilisis metus, ac ornare risus ipsum at
            sem. Nulla ut eros vel enim tempor sagittis. Ut sit amet lacus. Etiam sapien ante,
            sodales at, volutpat nec, pretium ut, augue. Mauris justo pede, volutpat at, pharetra at,
            sollicitudin sit amet, neque. Vestibulum tortor. Morbi nisi.
        </p>
    </div>
    -->
    <!--
    <figcaption>This is a Video</figcaption>
    -->
    <!-- *** / DEV TEST MARKUP *** -->




    <!-- *** DEV EXAMPLE MARKUP *** -->
    <figure id="demo-figure">
    <!--
    <figcaption>This is a Video</figcaption>
    -->
    <!-- *** / DEV EXAMPLE MARKUP *** -->



    <!-- player markup -->
    <div
        id="demo" class="ozplayer"
        data-transcript="demo-transcript"
        data-controls="row"
        >
        <!--
        data-controls="stack"
        data-responsive="demo-figure"
        -->
        <!--
            preload="auto"
            width="400" height="225"
            width="240" height="135"
            width="640" height="360"
        -->
        <video
            preload="none"
            width="480" height="270"
            controls="controls"

<?php if(isset($_GET['video']) && $_GET['video'] == 'brain') : ?>
            poster="./media/posters/BrainSurgerySketch.jpg"
<?php elseif(isset($_GET['video']) && ($_GET['video'] == 'xad-counting' || $_GET['video'] == 'xad-youtube')) : ?>
            poster="./media/posters/xad-counting.png"
<?php elseif(isset($_GET['video']) && $_GET['video'] == 'test') : ?>
            poster="./media/posters/blank-black.jpg"
<?php elseif(isset($_GET['video'])) : ?>
            poster="./media/posters/ozplayer.png"
<?php else : ?>
            poster="./media/posters/HorribleHistories.jpg"
<?php endif; ?>
            >

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

            -->


<?php if(isset($_GET['video']) && $_GET['video'] == 'youtube') : ?>

            <source src="//www.youtube.com/watch?v=EzbETcExSwE" type="video/x-youtube" />

            <!--
            <source src="https://youtu.be/tTYaum_YmRs" type="video/x-youtube" />
            -->

            <track src="./media/captions/en/ozplayer.vtt" kind="captions" srclang="en" default="default" />
            <track src="./media/transcripts/en/ozplayer-transcript.vtt" kind="metadata" data-kind="transcript" srclang="en" />

<?php elseif(isset($_GET['video']) && $_GET['video'] == 'youtube-captions') : ?>

            <!--(has proper captions)
            -->
            <source src="//www.youtube.com/watch?v=Z7x4ZS7ZZWc" type="video/x-youtube" data-captions="true" />

            <!--(has auto-generated captions)
            <source src="//www.youtube.com/watch?v=hn1VxaMEjRU" type="video/x-youtube" />
            -->

            <!--(has no captions)
            <source src="//www.youtube.com/watch?v=VgX6JFoV0TM" type="video/x-youtube" />
            -->

            <!--(local proper captions)
            <track src="./media/captions/en/obama.vtt" kind="captions" srclang="en" default="default" />
            -->

<?php elseif(isset($_GET['video']) && $_GET['video'] == 'ozplayer') : ?>

            <source src="./media/videos/ozplayer.mp4" type="video/mp4" />
            <source src="./media/videos/ozplayer.webm" type="video/webm" />

            <track src="./media/captions/en/ozplayer.vtt" kind="captions" srclang="en" default="default" />
            <track src="./media/transcripts/en/ozplayer-transcript.vtt" kind="metadata" data-kind="transcript" srclang="en" />

<?php elseif(isset($_GET['video']) && $_GET['video'] == 'cloudfront') : ?>

            <!--
            <source src="http://dhjrqu8yhdp3e.cloudfront.net/media/ozplayer.webm<?php echo('?nocache=' . microtime(true)); ?>" type="video/webm" />
            -->
            <source src="http://dhjrqu8yhdp3e.cloudfront.net/media/ozplayer.mp4<?php echo('?nocache=' . microtime(true)); ?>" type="video/mp4" />

            <track src="./media/captions/en/ozplayer.vtt" kind="captions" srclang="en" default="default" />
            <track src="./media/transcripts/en/ozplayer-transcript.vtt" kind="metadata" data-kind="transcript" srclang="en" />

<?php elseif(isset($_GET['video']) && $_GET['video'] == 'brain') : ?>

            <!--
            <source src="http://www.brothercake.com/clients/GianWild/VideoPlayer/media/videos/BrainSurgerySketch.webm<?php echo('?nocache=' . microtime(true)); ?>" type="video/webm" />
            <source src="./media/videos/BrainSurgerySketch.webm" type="video/webm" />
            <source src="./media/videos/BrainSurgerySketch.mp4" type="video/mp4" />
            -->

            <source src="http://www.brothercake.com/clients/GianWild/VideoPlayer/media/videos/BrainSurgerySketch.mp4<?php echo('?nocache=' . microtime(true)); ?>" type="video/mp4" />

            <track src="./media/captions/en/BrainSurgerySketch.vtt" kind="captions" srclang="en" default="default" />
            <track src="./media/captions/de/BrainSurgerySketch.vtt" kind="captions" srclang="de" />

<?php elseif(isset($_GET['video']) && $_GET['video'] == 'xad-counting') : ?>

            <source src="./media/videos/xad-counting.webm" type="video/webm" />
            <source src="./media/videos/xad-counting.mp4" type="video/mp4" />

            <track src="./media/captions/en/xad-counting.vtt" kind="captions" srclang="en" default="default" />

            <track src="./media/metadata/xad-counting.vtt" kind="metadata" data-kind="xad" />

<?php elseif(isset($_GET['video']) && $_GET['video'] == 'xad-youtube') : ?>

            <source src="//www.youtube.com/watch?v=JLiidg5PtkM" type="video/x-youtube" />

            <track src="./media/captions/en/xad-counting.vtt" kind="captions" srclang="en" default="default" />

            <track src="./media/metadata/xad-counting.vtt" kind="metadata" data-kind="xad" />

<?php elseif(isset($_GET['video']) && $_GET['video'] == 'test') : ?>

            <source src="http://vodpresegmented-a.akamaihd.net/VODTRANSCODINGLIBRARY/success/elephant.mp4" type="video/mp4" />

<?php else : ?>

            <!--
            -->
            <source src="./media/videos/HorribleHistories-VileVictorians.webm" type="video/webm" />
            <source src="./media/videos/HorribleHistories-VileVictorians.mp4" type="video/mp4" />

            <track src="./media/captions/de/HorribleHistories-VileVictorians.vtt" kind="captions" srclang="de" label="Deutsch" />
            <track src="./media/transcripts/de/HorribleHistories-VileVictorians.vtt" kind="metadata" data-kind="transcript" srclang="de" />
            <track src="./media/captions/en/HorribleHistories-VileVictorians.vtt" kind="captions" srclang="en" label="English" default="default" />
            <track src="./media/captions/es/HorribleHistories-VileVictorians.vtt" kind="captions" srclang="es" label="Español" data-default-transcript="default" />
            <track src="./media/captions/fr/HorribleHistories-VileVictorians.vtt" kind="captions" srclang="fr" label="Français" />
            <track src="./media/captions/pa/HorribleHistories-VileVictorians.vtt" kind="captions" srclang="pa" label="ਪਜਾਬੀ ਦ" />
            <track src="./media/captions/tlh/HorribleHistories-VileVictorians.vtt" kind="captions" srclang="tlh" label="TlhIngan" />
            <track src="./media/transcripts/en/HorribleHistories-VileVictorians.vtt" kind="metadata" data-kind="transcript" srclang="en" />
            <track src="./media/transcripts/es/HorribleHistories-VileVictorians.vtt" kind="metadata" data-kind="transcript" srclang="es" />
            <track src="./media/transcripts/fr/HorribleHistories-VileVictorians.vtt" kind="metadata" data-kind="transcript" srclang="fr" />
            <track src="./media/transcripts/pa/HorribleHistories-VileVictorians.vtt" kind="metadata" data-kind="transcript" srclang="pa" />
            <track src="./media/transcripts/tlh/HorribleHistories-VileVictorians.vtt" kind="metadata" data-kind="transcript" srclang="tlh" />
            <!--
            -->

<?php endif; ?>


            <!-- (EITHER) this format provides static fallback content when applicable -->
            <div class="ozplayer-fallback">

<?php if(!isset($_GET['video'])) : ?>

                <ul>
                    <li><a href="./media/videos/HorribleHistories-VileVictorians.mp4"><cite>Horrible Histories (Vile Victorians)</cite> (MP4)</a></li>
                    <li><a href="./media/videos/HorribleHistories-VileVictorians.webm"><cite>Horrible Histories (Vile Victorians)</cite> (WebM)</a></li>
                    <li><a href="./media/captions/en/HorribleHistories-VileVictorians.vtt"><cite>Horrible Histories (Vile Victorians)</cite> (English Captions)</a></li>
                </ul>

<?php else : ?>

                <ul>
                    <li><a href="./media/videos/ozplayer.mp4"><cite>About OzPlayer</cite> (MP4)</a></li>
                    <li><a href="./media/videos/ozplayer.webm"><cite>About OzPlayer</cite> (WebM)</a></li>
                    <li><a href="./media/captions/en/ozplayer.vtt"><cite>About OzPlayer</cite> (English Captions)</a></li>
                </ul>

<?php endif; ?>

            </div>

            <!-- (OR) this format also provides a basic flash player when JS is unavailable
                 but note that it's a pain in the arse to maintain correctly, because the
                 "path" is NOT relative to this page, it's relative to flashmediaelement.swf
                 (ie. it's always the same on every page, but different from all other paths) -->
            <!--
            <object width="480" height="270" data="./ozplayer-core/flashmediaelement.swf" type="application/x-shockwave-flash">
                    <param name="movie" value="./ozplayer-core/flashmediaelement.swf" />
                    <param name="flashvars" value="file=.././media/videos/HorribleHistories-VileVictorians.mp4&amp;controls=true" />

                    <div class="ozplayer-fallback">
                        <ul>
                            <li><a href="./media/videos/HorribleHistories-VileVictorians.mp4">Download <q>Horrible Histories (Vile Victorians)</q> (MP4)</a></li>
                            <li><a href="./media/videos/HorribleHistories-VileVictorians.webm">Download <q>Horrible Histories (Vile Victorians)</q> (WebM)</a></li>
                            <li><a href="./media/captions/en/HorribleHistories-VileVictorians.vtt">Download <q>Horrible Histories (Vile Victorians)</q> (English Captions)</a></li>
                        </ul>
                    </div>
            </object>
            -->

        </video>

        <!--
        <audio data-on="test.php?audio=on" data-off="test.php?audio=off">
        <audio data-default="default" preload="none" data-on="test.php?audio=on" data-off="test.php?audio=off">
        <audio preload="none">
        -->
        <audio data-default="default" preload="none">

<?php if(isset($_GET['video']) && ($_GET['video'] == 'youtube' || $_GET['video'] == 'ozplayer')) : ?>

            <source src="./media/descriptions/ozplayer.mp3" type="audio/mp3" />
            <source src="./media/descriptions/ozplayer.ogg" type="audio/ogg" />

<?php elseif(isset($_GET['video']) && $_GET['video'] == 'youtube-captions') : ?>

<?php elseif(isset($_GET['video']) && $_GET['video'] == 'cloudfront') : ?>

            <source src="http://dhjrqu8yhdp3e.cloudfront.net/media/ozplayer.mp3<?php echo('?nocache=' . microtime(true)); ?>" type="audio/mp3" />
            <source src="http://dhjrqu8yhdp3e.cloudfront.net/media/ozplayer.ogg<?php echo('?nocache=' . microtime(true)); ?>" type="audio/ogg" />

<?php elseif(isset($_GET['video']) && $_GET['video'] == 'brain') : ?>

            <!--
            <source src="./media/descriptions/BrainSurgerySketch-PS.mp3" type="audio/mp3" />
            <source src="./media/descriptions/BrainSurgerySketch-PS.ogg" type="audio/ogg" />
            -->

            <source src="http://www.brothercake.com/clients/GianWild/VideoPlayer/media/descriptions/BrainSurgerySketch-PS.mp3<?php echo('?nocache=' . microtime(true)); ?>" type="audio/mp3" />
            <source src="http://www.brothercake.com/clients/GianWild/VideoPlayer/media/descriptions/BrainSurgerySketch-PS.ogg<?php echo('?nocache=' . microtime(true)); ?>" type="audio/ogg" />

<?php elseif(isset($_GET['video']) && ($_GET['video'] == 'xad-counting' || $_GET['video'] == 'xad-youtube')) : ?>

            <source src="./media/descriptions/xad-counting.mp3" type="audio/mp3" />
            <source src="./media/descriptions/xad-counting.ogg" type="audio/ogg" />

<?php elseif(isset($_GET['video']) && $_GET['video'] == 'test') : ?>

<?php else : ?>

            <source src="./media/descriptions/HorribleHistories-VileVictorians.mp3" type="audio/mp3" />
            <source src="./media/descriptions/HorribleHistories-VileVictorians.ogg" type="audio/ogg" />

<?php endif; ?>

        </audio>

    </div>



    <!-- *** DEV INFO DUMP *** -->
    <!--
    <pre contentEditable="true" id="info" style="display:block;width:620px;height:22.5em;resize:both;font-family:monaco,courier,monospace;font-size:10px;line-height:1.5em;padding:10px;text-align:left;overflow-y:auto;border:2px dashed gray;border-radius:2px;background:#ddd;color:#666;"></pre>
    -->
    <!-- *** / DEV INFO DUMP *** -->



    <!-- optional transcript expander -->
    <details class="ozplayer-expander" open="open">

        <!-- transcript expander trigger (required first-child if expander is present) -->
        <summary>Video Transcript</summary>



        <!-- optional player transcript container -->
        <div id="demo-transcript" class="ozplayer-transcript">
        <?php

            //import the OzPlayer class
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



    <!-- *** DEV WORDPRESS CONTAINERS *** -->
    <!--
    </div>
    </div>
    </div>
    </div>
    </div>
    -->
    <!-- *** / DEV WORDPRESS CONTAINERS *** -->



    <!-- *** DEV ADDITIONAL INSTANCES *** -->
    <!--
    <div style="margin-top:20px !important;margin-bottom:20px !important;text-align:center !important;">
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
    </div>
    -->
    <!-- *** / DEV ADDITIONAL INSTANCES *** -->



    <!-- *** DEV TEST MARKUP *** -->
    <!--
    <div id="focusboxes" style="display:table;width:640px;margin:0 auto;">
        <span class="focusbox"></span>
        <span class="focusbox" tabindex="">""</span>
        <span class="focusbox" tabindex="-1">"-1"</span>
        <span class="focusbox" tabindex="0">"0"</span>
        <span class="focusbox" tabindex="1">"1"</span>
        <span class="focusbox" tabindex="200">"200"</span>
    </div>
    <div style="display:table;width:640px;margin:20px auto 0 auto;">
        <h2>Whatever's after the video and transcript</h2>
        <p>
            Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Nunc neque. In hac habitasse
            platea dictumst. Pellentesque ultrices. Donec nunc metus, aliquam sit amet, aliquam in,
            luctus ac, odio. Aenean orci velit, elementum ac, egestas pellentesque, facilisis non,
            turpis. Quisque dolor. Vestibulum in massa in lectus hendrerit condimentum. Duis suscipit,
            lectus varius fermentum fermentum, est lectus facilisis metus, ac ornare risus ipsum at
            sem. Nulla ut eros vel enim tempor sagittis. Ut sit amet lacus. Etiam sapien ante,
            sodales at, volutpat nec, pretium ut, augue. Mauris justo pede, volutpat at, pharetra at,
            sollicitudin sit amet, neque. Vestibulum tortor. Morbi nisi.
        </p>
    </div>
    <div id="focusboxes" style="display:table;width:640px;margin:0 auto 20px auto;">
        <span class="focusbox" tabindex="0">F-A-1</span>
        <span class="focusbox" tabindex="0">F-A-2</span>
        <span class="focusbox" tabindex="0">F-A-3</span>
        <span class="focusbox" tabindex="0">F-A-4</span>
        <span class="focusbox" tabindex="0">F-A-5</span>
        <span class="focusbox" tabindex="0">F-A-6</span>
    </div>
    <form style="display:table;width:640px;margin:0 auto 0 auto;" action="javascript:void(null)"><input value="after" /><input type="submit" id="after" /></form>
    -->
    <!-- *** / DEV TEST MARKUP *** -->



    <!-- *** DEV TEST MARKUP *** -->
    <!--
    <div id="propboxes">
        <span class="focusbox"></span>
        <span class="focusbox"></span>
        <span class="focusbox"></span>
        <span class="focusbox"></span>
        <span class="focusbox"></span>
        <span class="focusbox"></span>
    </div>
    <div id="attrboxes">
        <span class="focusbox"></span>
        <span class="focusbox"></span>
        <span class="focusbox"></span>
        <span class="focusbox"></span>
        <span class="focusbox"></span>
        <span class="focusbox"></span>
    </div>
    -->
    <!-- *** / DEV TEST MARKUP *** -->



    <!-- *** DEV TEST QUALIFY URIS *** -->
    <script type="text/javascript">
    (function()
    {

        //*** DEV TMP (convert video, audio[, and track] paths to remote files)
        //nb. the src isn't qualified in IE so we have to do that manually
        /***
        function qualify(href)
        {
            var here = document.location.href;var parts = here.replace('//', '/').split('/');var loc = {'protocol' : parts[0],'host' : parts[1]};parts.splice(0, 2);loc.pathname = '/' + parts.join('/');var uri = loc.protocol + '//' + loc.host;if(/^(\.\/)([^\/]?)/.test(href)){href = href.replace(/^(\.\/)([^\/]?)/, '$2');}if(/^([a-z]+)\:\/\//.test(href)){uri = href;}else if(href.substr(0, 1) == '/'){uri += href;}else if(/^((\.\.\/)+)([^\/].*$)/.test(href)){var lastpath = href.match(/^((\.\.\/)+)([^\/].*$)/);lastpath = lastpath[lastpath.length - 1];var references = href.split('../').length - 1;var parts = loc.pathname.split('/');parts = parts.splice(0, parts.length - 1);for(var i=0; i<references; i++){parts = parts.splice(0, parts.length - 1);}var path = '';for(i=0; i<parts.length; i++){if(parts[i] != ''){path += '/' + parts[i];}}path += '/';path += lastpath;uri += path;}else{path = '';parts = loc.pathname.split('/');parts = parts.splice(0, parts.length - 1);for(var i=0; i<parts.length; i++){if(parts[i] != ''){path += '/' + parts[i];}}path += '/';uri += path + href;}return uri;
        }
        function remote(src)
        {
            return qualify(src)
                    .replace(/(localhost|cakebook(\.local)?|192\.168\.1\.3|192\.168\.1\.64)/, 'www.brothercake.com')
                    .replace('OzPlayer/media/', 'media/')
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
            //    tracks[i].src = './media/captions/proxy.php?src=' + remote(tracks[i].src);
            //}
        ***/


    })();
    </script>
    <!-- *** / DEV TEST QUALIFY URIS *** -->



    <!-- *** / DEV LOG *** --><!-- -->
    <pre id="videolog" class="log" contenteditable="true" spellcheck="false"></pre>
    <pre id="audiolog" class="log" contenteditable="true" spellcheck="false"></pre>
    <script type="text/javascript">
    (function()
    {
        var videolog = document.getElementById('videolog');
        var audiolog = document.getElementById('audiolog');
        try
        {
            var figure = document.getElementsByTagName('figure')[0];
            window.setLogSizes = function()
            {
                audiolog.style.width = videolog.style.width = document.documentElement.clientWidth - figure.offsetWidth - 62 + 'px';
                audiolog.style.height = videolog.style.height = (document.documentElement.clientHeight * 0.42) + 'px';
            }
            setLogSizes();
            window.setTimeout(function(){ window.setLogSizes(); }, 1000);
            window.onresize = window.setLogSizes;
        }
        //nb. this avoids errors in IE6 when testing exclusion
        catch(ex)
        {
            videolog.parentNode.removeChild(videolog);
            audiolog.parentNode.removeChild(audiolog);
        }
    })();
    </script>
    <!-- *** DEV LOG *** -->



    <!-- *** DEV TEST SCRIPTING *** -->
    <script type="text/javascript">
    (function()
    {


        /*** DEV TMP (add a query-flag incrementing reset button for handheld devices) ***//*
        if(/^(ip(ad|hone)|android|linux arm)/i.test(navigator.platform) || (/windows phone/i.test(navigator.userAgent)))
        {
            var prefix = 'F';

            var button = document.createElement('button');
            button.type = 'button';
            if(location.search && location.search.indexOf(prefix + '=') >= 0)
            {
                var flag = location.search.split(prefix + '=')[1].split('&')[0];
                button.onclick = function()
                {
                    document.location.href = document.location.href.replace(prefix + '=' + flag, prefix + '=' + (parseInt(flag, 10) + 1))
                };
            }
            else
            {
                var flag = 0;
                button.onclick = function()
                {
                    document.location.href = document.location.href.split('?')[0] + '?' + prefix + '=' + (parseInt(flag, 10) + 1);
                };
            }
            button.innerHTML = prefix.toUpperCase() + (parseInt(flag, 10) + 1);
            document.body.appendChild(button);
            var props =
            {
                position    : 'absolute',
                right        : '15px',
                top            : '15px',
                padding        : '15px',
                fontSize    : '30px'
            };
            for(var i in props)
            {
                button.style[i] = props[i];
            }
        } */



        //*** DEV TMP (apply tabindex to script focusboxes)
        //var tabindexes = [null, "", -1, 0, 1, 200];
        //var propboxes = document.getElementById('propboxes').getElementsByTagName('span');
        //var attrboxes = document.getElementById('attrboxes').getElementsByTagName('span');
        //for(var i = 0; i < tabindexes.length; i ++)
        //{
        //    //if(tabindexes[i] !== null)
        //    {
        //        propboxes[i].innerHTML = tabindexes[i];
        //        propboxes[i].tabIndex = tabindexes[i];
        //
        //        attrboxes[i].innerHTML = '"'+tabindexes[i]+'"';
        //        attrboxes[i].setAttribute('tabindex', tabindexes[i]);
        //    }
        //}



        //*** DEV TMP (disable all stylesheets and element styles)
        //for(var sheets = document.styleSheets, i = 0; i < sheets.length; i ++) { sheets[i].disabled = true; }
        //for(var nodes = document.getElementsByTagName('*'), i = 0; i < nodes.length; i ++) { nodes[i].removeAttribute('style'); }



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
                /***
                lighthref = lighthref.replace('-pink', '-green');
                ***/

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
                    //lighthref = lighthref.replace('-pink', '-red');
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
