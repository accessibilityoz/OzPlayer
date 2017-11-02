# OzPlayer 3.3 Changelog

## New Features

* Added support for Audio Descriptions for Android 4 or later.

* Added the volume controls (slider and mute button) for Android 4 or later.

## Bug Fixes

* Fixed an issue with JAWS whereby the native player controls would sometimes be announced even after they'd been removed.

* Fixed an issue with JAWS whereby the Play button and Time slider would sometimes fail to be announced.

* Fixed an issue with live captions in Android Talkback whereby each caption would be announced twice.

* Fixed an issue with iOS Safari, whereby the transcript wouldn't collapse when tapping the trigger element, and this sometimes also caused the browser to freeze.

## Other Changes

* Removed the "Media Controls" legend before the player controls form, to reduce verbosity in JAWS, which would otherwise announce the legend before every control when navigating using quick keys.

* Removed `BLOCKQUOTE` markup from the captions and transcript to reduce verbosity in screenreaders.

## Updated Files

* `"ozplayer-core/ozplayer.free.js"`
* `"ozplayer-core/ozplayer.min.css"`
* `"ozplayer-core/ozplayer.min.js"`
* `"ozplayer-core/ozplayer.subs.debug.js"`
* `"ozplayer-core/ozplayer.subs.js"`
* `"ozplayer-core/OzPlayer.php"`
* `"ozplayer-lang/en.js"`
* `"transcript.css"`

## Updated language

* removed `"controls-legend"`


