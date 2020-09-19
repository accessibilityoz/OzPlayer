/*******************************************************************************
 Copyright (c) 2013-7 AccessibilityOz        http://www.accessibilityoz.com.au/
 ------------------------------------------------------------------------------
 OzPlayer [3.0] => configuration script
 ------------------------------------------------------------------------------
*******************************************************************************/
(function()
{

    //*** DEV TMP (don't initialise)
    //return;

    //*** DEV TMP (initialse onload)
    //window.onload = function(){

    //*** DEV TMP (pause before initialising)
    //window.setTimeout(function(){



    //FIRST => optionally enable dev settings
    //nb. it may be helpful to have these true during development
    //then comment them or set to false when the site is published
    //(or just delete them, since both are false by default)
    OzPlayer.define("alert-on-error",       true);
    OzPlayer.define("captions-nocache",     true);



    //SECOND => optionally re-define universal config
    //nb. these examples are not required, they're just examples
    //(and all the sample values are the same as their defaults)
    OzPlayer.define("default-volume",       0.7);                    //video and audio default volume (float from 0 to 1)
    OzPlayer.define("default-width",        400);                    //default width if <video width> is not defined (pixels gte 400)
    OzPlayer.define("default-height",       225);                    //default height if <video height> is not defined (pixels gte 225)
    OzPlayer.define("auto-hiding-delay",    4);                      //auto-hiding delay for stack controls and skip links (float seconds, or zero to disable auto-hiding)
    OzPlayer.define("user-persistence",     "ozplayer-userdata");    //user data persistence key (or empty-string to disable persistence)
    OzPlayer.define("allow-fullscreen",     true);                   //add a fullscreen button (where supported by the browser)
    OzPlayer.define("seek-duration",        15);                     //seek duration (seconds) when using the forward and rewind buttons


    //THIRD => initialise all player instances
    /***
    OzPlayer.init();
    ***/


    //THIRD => initialise a video player, passing the player ID
    //and optionally also passing an object of player callbacks
    //nb. this function is a constructor and must use the "new" keyboard
    //nb. the entire object is optional, as is each individual callback
    //nb. you should initialse players as soon as possible after the markup
    //ie. don't wait for window.onload or DOMContentLoaded or whatever
    //new OzPlayer.Video("demo",
    new OzPlayer.Audio("demo",
    {
        "onsuccess"        : function()                //callback after successful initialisation
        {
            var str = 'ONSUCCESS\n\n';for(var i in this) { str += 'this['+i+'] = "' + (typeof(this[i]) == 'function' ? 'function(){ ... }' : this[i]) + '"\n'; }
            try { console.warn(str); } catch(ex){ alert(str); }

            //* MAYBE SOME OR ALL OF THESE WOULD BE USEFUL (also in the scope of this)
            //* nb. also create an "src" property of the instance
            //* and a "currentTime" property, but probably only if one
            //* of these is defined, else we can save on maintaining it
            //this.onplay = function()
            //{
            //};
            //this.onpause = function()
            //{
            //};
            //this.onended = function()
            //{
            //};
            //this.oncaptionchange = function()
            //{
            //};
            //this.ontimeupdate = function()
            //{
            //};
        },
        "onfail"        : function()                //callback after failure to initialise
        {
            var str = 'ONFAIL\n\n';for(var i in this) { str += 'this['+i+'] = "' + (typeof(this[i]) == 'function' ? 'function(){ ... }' : this[i]) + '"\n'; }
            try { console.error(str); } catch(ex){ alert(str); }
        },
        "onerror"        : function()                //callback after video loading error
        {
            var str = 'ONERROR\n\n';for(var i in this) { str += 'this['+i+'] = "' + (typeof(this[i]) == 'function' ? 'function(){ ... }' : this[i]) + '"\n'; }
            try { console.error(str); } catch(ex){ alert(str); }
        }
    });





    /*** DEV ADDITIONAL INSTANCES ***//***
    new OzPlayer.Video("demo2",
    {
        //"onsuccess"        : function(){var str = 'ONSUCCESS\n\n';for(var i in this) { str += 'this['+i+'] = "' + (typeof(this[i]) == 'function' ? 'function(){ ... }' : this[i]) + '"\n'; }try { console.warn(str); } catch(ex){}},
        //"onfail"        : function(){var str = 'ONFAIL\n\n';for(var i in this) { str += 'this['+i+'] = "' + (typeof(this[i]) == 'function' ? 'function(){ ... }' : this[i]) + '"\n'; }try { console.error(str); } catch(ex){}},
        //"onerror"        : function(){var str = 'ONERROR\n\n';for(var i in this) { str += 'this['+i+'] = "' + (typeof(this[i]) == 'function' ? 'function(){ ... }' : this[i]) + '"\n'; }try { console.error(str); } catch(ex){}}
    });
    new OzPlayer.Video("demo3",
    {
        //"onsuccess"        : function(){var str = 'ONSUCCESS\n\n';for(var i in this) { str += 'this['+i+'] = "' + (typeof(this[i]) == 'function' ? 'function(){ ... }' : this[i]) + '"\n'; }try { console.warn(str); } catch(ex){}},
        //"onfail"        : function(){var str = 'ONFAIL\n\n';for(var i in this) { str += 'this['+i+'] = "' + (typeof(this[i]) == 'function' ? 'function(){ ... }' : this[i]) + '"\n'; }try { console.error(str); } catch(ex){}},
        //"onerror"        : function(){var str = 'ONERROR\n\n';for(var i in this) { str += 'this['+i+'] = "' + (typeof(this[i]) == 'function' ? 'function(){ ... }' : this[i]) + '"\n'; }try { console.error(str); } catch(ex){}}
    });
    OzPlayer.Video("demo4",
    {
        "onsuccess"        : function(){var str = 'ONSUCCESS\n\n';for(var i in this) { str += 'this['+i+'] = "' + (typeof(this[i]) == 'function' ? 'function(){ ... }' : this[i]) + '"\n'; }try { console.warn(str); } catch(ex){}},
        "onfail"        : function(){var str = 'ONFAIL\n\n';for(var i in this) { str += 'this['+i+'] = "' + (typeof(this[i]) == 'function' ? 'function(){ ... }' : this[i]) + '"\n'; }try { console.error(str); } catch(ex){}},
        "onerror"        : function(){var str = 'ONERROR\n\n';for(var i in this) { str += 'this['+i+'] = "' + (typeof(this[i]) == 'function' ? 'function(){ ... }' : this[i]) + '"\n'; }try { console.error(str); } catch(ex){}}
    });
    ***/


    //*** DEV TMP
    //var str = '';
    //for(var i in OzPlayer) { str += 'OzPlayer['+i+'] = ' + (typeof(OzPlayer[i]) == 'function' ? 'function() { ... }' : OzPlayer[i]) + '\n'; }
    //alert(str);
    //try { console.log(str); } catch(ex){}




    //FOURTH => optionally define event listener(s)
    /***
    OzPlayer.addListener("play", function(event)
    {
        console.warn('addListener("play", fn)');
        console.dir(event);
    });
    ***/
    OzPlayer.addListener(function(event)
    {
        console.warn('addListener("' + event.type + '")');
        console.dir(event);
    });



    //*** DEV TMP (initialse onload)
    //};

    //*** DEV TMP (pause before initialising)
    //}, 500);

})();

