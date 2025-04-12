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
(function(){var lang={
//----------------------------------------------------------------------------//


    //button labels and tooltips
    //n.b. the % tokens represent dynamic text:
    //%1 = the label attribute defined on the captions language's track element
    //%2 = the number of seconds' seeking controlled by rewind/forward buttons
    "button-playpause-off"      : "Play"
    ,"button-playpause-on"      : "Pause"
    ,"button-mute-off"          : "Mute"
    ,"button-mute-on"           : "Unmute"
    ,"button-cc-off"            : "Captions are off"
    ,"button-cc-on"             : "Captions are on"
    ,"button-cc-lang"           : "Captions = %1"
    ,"button-cc-loading"        : "Loading captions ..."
    ,"button-cc-nolang"         : "%1 failed to load"
    ,"button-cc-error"          : "Captions are not available"
    ,"button-ad-off"            : "Audio Descriptions are off"
    ,"button-ad-on"             : "Audio Descriptions are on"
    ,'button-ad-loading'        : "Loading audio descriptions ..."
    ,'button-ad-error'          : "Audio Descriptions are not available"
    ,"button-fullscreen-off"    : "Fullscreen"
    ,"button-fullscreen-on"     : "Exit Fullscreen"
    ,"button-rewind-off"        : "Back %2 seconds"
    ,"button-forward-off"       : "Forward %2 seconds"
    ,"button-pin-off"           : "Pin the controls"
    ,"button-pin-on"            : "Unpin the controls"

    //button fallback text (e.g. when images are disabled)
    //n.b. the % tokens represent dynamic text:
    //%1 = the src attribute defined on the captions language's track element
    //%2 = the number of seconds' seeking controlled by rewind/forward buttons
    ,"text-playpause-off"       : "Play"
    ,"text-playpause-on"        : "Pause"
    ,"text-mute-off"            : "Mute"
    ,"text-mute-on"             : "Unmute"
    ,"text-cc-off"              : "CC (off)"
    ,"text-cc-on"               : "CC (on)"
    ,"text-cc-lang"             : "CC (%1)"
    ,"text-cc-loading"          : "CC (...)"
    ,"text-tr-off"              : "TR (off)"
    ,"text-tr-on"               : "TR (on)"
    ,"text-tr-lang"             : "TR (%1)"
    ,"text-tr-loading"          : "TR (...)"
    ,"text-ad-off"              : "AD (off)"
    ,"text-ad-on"               : "AD (on)"
    ,"text-fullscreen-off"      : "Full"
    ,"text-fullscreen-on"       : "Exit"
    ,"text-rewind-off"          : "-%2"
    ,"text-forward-off"         : "+%2"
    ,"text-pin-off"             : "Pin"
    ,"text-pin-on"              : "Unpin"

    //menu labels
    ,"menu-cc-off"              : "Off"

    //slider tooltips
    //n.b. the % tokens represent dynamic values:
    //%1 = the seek slider time, or the volume slider volume
    ,"slider-seek"              : "Time = %1"
    ,"slider-volume"            : "Volume = %1"

    //skip and help link text
    ,"skip-link-video"          : "Skip video"
    ,"skip-link-transcript"     : "Skip to transcript"

    //video messages
    ,"indicator-loading"        : "Buffering ..."
    ,"indicator-timeout"        : "Media failed to load."

    //transcript messages
    //n.b. the % tokens represent dynamic text:
    //%1 = the label attribute defined on the captions language's track element
    ,"transcript-off"           : "Transcript is off"
    ,"transcript-lang"          : "Transcript = %1"
    ,"transcript-loading"       : "Loading transcript ..."
    ,"transcript-nolang"        : "%1 failed to load."
    ,"transcript-error"         : "Transcript is not available."
    ,"transcript-end"           : "End of transcript."

    //transcript active-cue label and glyph
    ,"transcript-cue-label"     : "Current line"
    ,"transcript-cue-glyph"     : "\u2192"

    //transcript expander twisty glyphs
    ,"expander-open"            : "\u25bc"
    ,"expander-closed"          : "\u25ba"


//----------------------------------------------------------------------------//
};for(var key in lang){if(lang.hasOwnProperty(key)){OzPlayer.define("lang."+key,lang[key]);}}})();
