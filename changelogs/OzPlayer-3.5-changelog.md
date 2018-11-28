# OzPlayer 3.5 Changelog

## New Features

* Added support for Extended Audio Descriptions.

  Extended Audio Descriptions can be used for videos where there isn't enough silence to add sufficiently detailed audio descriptions. It works by pausing the video while each description is played, and is controlled by a VTT meta-data file which defines the cue timings.

* Added two new seek buttons, to go back or forward by 15 seconds. These should improve usability in situations where the seek slider is difficult for users to interact with, for example when using gesture-based interaction with mobile screenreaders.

* The volume controls are now present at all player sizes, rather than being hidden for small-screen players.

* The controls have been split into two rows, one with the seek slider and new seek buttons, and the other with all the other controls. This provides more space for a wider seek slider, and is what makes it possible to continue showing the volume controls for small-screen players.

## Bug Fixes

* Fixed an issue in all browsers, whereby errors in player data attributes would prevent other data attributes from being parsed. This could result in situations where, for example, an error in the data-transcript attribute would cause the responsive behaviour to fail.

## Updated Files

* `"ozplayer-core/ozplayer.free.js"`
* `"ozplayer-core/ozplayer.min.css"`
* `"ozplayer-core/ozplayer.min.js"`
* `"ozplayer-core/ozplayer.subs.debug.js"`
* `"ozplayer-core/ozplayer.subs.js"`
* `"ozplayer-skin/buttons-black.png"`
* `"ozplayer-skin/buttons-black-large.png"`
* `"ozplayer-skin/buttons-black-large@2x.png"`
* `"ozplayer-skin/buttons-white.png"`
* `"ozplayer-skin/buttons-white-large.png"`
* `"ozplayer-skin/buttons-white-large@2x.png"`
* `"ozplayer-lang/en.js"`
* `"ozplayer-skin/highlights-blue.css"`
* `"ozplayer-skin/highlights-green.css"`
* `"ozplayer-skin/highlights-orange.css"`
* `"ozplayer-skin/highlights-pink.css"`
* `"ozplayer-skin/highlights-purple.css"`
* `"ozplayer-skin/highlights-red.css"`
* `"ozplayer-skin/highlights-yellow.css"`

## Updated language

* added `"button-rewind-off"`
* added `"button-forward-off"`
* added `"text-rewind-off"`
* added `"text-forward-off"`


