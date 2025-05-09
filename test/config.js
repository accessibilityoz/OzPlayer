/*!
 * OzPlayer
 * https://github.com/accessibilityoz/OzPlayer
 *
 * Wrapper around MediaElement.js to provide additional accessibility features.
 *
 * Copyright 2013-, AccessibilityOz (https://www.accessibilityoz.com/)
 * License: MIT
 *
 */
(function()
{


    //enable development settings
    //n.b. it may be helpful to have these true during development
    //then comment them or set to false when the site is published
    //(or just delete them, since both are false by default)
    //OzPlayer.define("alert-on-error",   true);
    //OzPlayer.define("captions-nocache", true);



    //initialise a video player, passing the player ID
    //n.b. you should initialise players as soon as possible after the markup
    //i.e. don't wait for window.onload or DOMContentLoaded or suchlike
    new OzPlayer.Video("demo");


})();
