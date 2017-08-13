# OzPlayer 3.1 Changelog

## New Features

* Captions are now read by screenreaders when enabled.

* Buttons with an on/off state are now announced as toggles buttons by screenreaders.

* Added skin highlight colors for the transcript expander so that its focus indication is clearer.

* The AD button now has a pointer cursor when it's used for AD linking.

## Bug Fixes

* Fixed an issue with JAWS+Firefox not announcing changes to button text when pressing them.

* Fixed the ability of screenreaders to activate buttons using the Space bar.

* Fixed an issue with JAWS not reading the value of the seek slider when reaching it using virtual navigation keys.

* Fixed an issue where JAWS would describe a keystroke for moving to controlled elements which would then fail when that keystroke was used (with the message "Failed to move to controlled element").

* Fixed an issue with the volume controls not appearing in the non-responsive audio player.

## Other Changes

* Removed the ARIA role which forced screenreaders into application mode, in order to better support virtual navigation.

* Removed the global Space bar shortcut for playing and pausing the video, since this conflicted with the ability of screenreaders to activate other buttons using the Space bar.

* Removed the hack which prevented slider values from being continually announced by screenreaders when the slider has focus, since this prevented screenreaders from reading the value of the seek slider when reaching it using virtual navigation keys.

## Updated Files

* `ozplayer-core/ozplayer.free.js`
* `ozplayer-core/ozplayer.min.css`
* `ozplayer-core/ozplayer.min.js`
* `ozplayer-core/ozplayer.subs.debug.js`
* `ozplayer-core/ozplayer.subs.js`
* `ozplayer-skin/highlights-blue.css`
* `ozplayer-skin/highlights-green.css`
* `ozplayer-skin/highlights-orange.css`
* `ozplayer-skin/highlights-pink.css`
* `ozplayer-skin/highlights-purple.css`
* `ozplayer-skin/highlights-red.css`
* `ozplayer-skin/highlights-yellow.css`


