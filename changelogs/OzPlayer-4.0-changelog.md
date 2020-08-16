# OzPlayer 4.0 Changelog

## New Features

* Upgraded the MediaElement library to Version 4.2.16.

* Upgrading MediaElement adds built-in support for two additional video formats: HLS (HTTP Live Streaming) and MPEG-DASH (Dynamic Adaptive Streaming over HTTP). **Please note that MPEG-DASH is not supported in iOS**.

* Added optional support for Vimeo videos. (This requires an additional script, which is included in the build.)

* Added support for the `playsinline` attribute, which allows videos to be played inline on the iPhone (iOS 10 or later), rather than entering full-screen mode automatically. Please note that this feature cannot be supported for YouTube videos.

## Bug Fixes

* Fixed an issue with detecting Windows High Contrast mode in recent versions of Firefox, which made it show image buttons rather than plain text, and rendered the sliders completely invisible.

* Fixed an issue with full-screen mode in recent versions of Firefox, where it was failing to resize the video.

* Fixed an issue on the iPhone, where embedded captions in YouTube videos were not shown, if track captions were also defined and set to override the embedded captions. Track captions cannot be shown for YouTube videos on the iPhone, so this fix allows for iPhone users to see the embedded captions, while most users see the track captions.

## Other Changes

* Updated the styling of captions so that the whole caption area has a dark background, rather than the background being applied to individual lines. This is intended to improve readability for users with cognitive disabilities, by making the caption area visually simpler and stronger, and therefore easier to concentrate on the text.

* Added a medium font-size to the caption sizing variants. (So the font-size will 14px, 16px, or 18px, depending on the video width, or 40px in full-screen mode.)

* Increased the minimum player size to 300 x 169 (from 240 x 135) to reduce the possibility of multi-line captions flowing outside the player's container. (To the best of our knowledge, there aren't any supported mobile devices with a screen width of less than 320, so the minimum caters for that while still providing some layout flexibility.)

* Initialisation errors due to unsupported media types will now trigger the fallback content to display, rather than showing an error state or empty player, because this is potentially more useful for users. (Please ensure that suitable fallback content is defined. Such failures are very unlikely, but they can happen if the user's browser lacks all necessary media support, e.g. if the only media source is MPEG-DASH, but the user's browser doesn't support that **and** doesn't support the replacement shim.)

* Confirmed support for the new Chromium Edge browser, for Windows and Mac.

* Removed support for Internet Explorer 8, 9 and 10, and for iOS 6 and 7, which are no longer supported in MediaElement. (All apart from IE8 still have basic MP4 support using their native player, but they won't have any accessibility features, nor support any other formats.)

* Removed support for Windows Phone, which is no longer maintained or supported by Microsoft. (This also retains basic MP4 support using its native player.)

* Streamlined the core stylesheet by removing legacy vendor-specific properties which are no longer needed.

## Added files

* `"ozplayer-core/mediaelement-flash-video-hls.swf"`
* `"ozplayer-core/mediaelement-flash-video-mdash.swf"`
* `"ozplayer-core/mediaelement-flash-video.swf"`
* `"ozplayer-core/vimeo.min.js"`

## Removed files

* `"ozplayer-core/flashmediaelement.swf"`

## Updated files

* `"ozplayer-core/mediaelement.min.js"`
* `"ozplayer-core/ozplayer.free.js"`
* `"ozplayer-core/ozplayer.min.css"`
* `"ozplayer-core/ozplayer.min.js"`
* `"ozplayer-core/ozplayer.subs.js"`
* `"ozplayer-core/ozplayer.subs.debug.js"`
