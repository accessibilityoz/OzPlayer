# OzPlayer 3.2 Changelog

## New Features

* added a new `"data-responsive-mode"` attribute to control the resize behaviour when using OzPlayer within a responsive container. This new control provides the flexibility to take either a mobile-first or desktop-first approach to responsive design, as fits your needs.

  This attribute controls how the default `VIDEO` `"width"` (or `AUDIO` `"data-width"` for the audio-only player) constrains the resizable width of the player. If this attribute  is set to `"initial"` then the player can freely resize to be larger or smaller than the initial width, to match the width of its responsive container. If it's set to `"min"` then the initial width is also min-width, and the player cannot resize any smaller than that. Or if it's set to `"max"` then the initial width is also max-width, and the player cannot resize any larger; the `"max"` setting also emulates the resizing behaviour used in earlier versions of OzPlayer, and can therefore be used to provide backward compatibility.

  The default and recommended setting is `"initial"`; the minimum and maximum width of the player can then be controlled using CSS `min-width` and `max-width` on the responsive container element.

* added a new `.important` flag for the WebVTT `V` element.

  Voice names are usually only displayed in the transcript and are not shown in the captions. But when this flag is used as a `V` element class, it denotes that the voice name should also be shown in the caption, e.g. to clarify who's speaking when a caption contains multiple speakers or when the speaker is off-screen.

* added support for multiple classes on WebVTT `C` and `V` elements

## Bug Fixes

* fixed an issue in JAWS whereby using the forms quick key "f" while the video is playing would move between the player controls in an apparently random order, rather than sequentially.

* fixed an issue in screenreaders whereby the transcript expander would not announce that it's collapsible nor announce its current state on initial focus, but would only announce changes in state after activating it.

* fixed an occasional issue with Chrome showing an uncessary loading indicator when playback starts.

* fixed a bug in desktop browsers when using preload `"auto"`, whereby moving the seek slider before first playback would not apparently seek through the video, because the poster was still visible.

## Other Changes

* the alternate caption colour (yellow text) is now determined by changes in voice tag, rather than line breaks.

* the video transcript expander is now announced as a button by screenreaders, and present in its quick forms collections.

* added clearer hover/focus indication for the ozplayer logo (where visible).

* the transcript expander icon is now hidden from most screenreaders (rather than being announced as "black down pointing arrow").

* inverted the language and `aria-pressed` state of the mute button, so that it's more logically consistent with the button's function: `"Mute"` is now off/false (when the audio is not muted) and `"Unmute"` is on/true (when the audio is muted).

## Updated Files

* `ozplayer-core/ozplayer.free.js`
* `ozplayer-core/ozplayer.min.css`
* `ozplayer-core/ozplayer.min.js`
* `ozplayer-core/ozplayer.subs.debug.js`
* `ozplayer-core/ozplayer.subs.js`
* `ozplayer-lang/en.js`
* `ozplayer-skin/highlights-blue.css`
* `ozplayer-skin/highlights-green.css`
* `ozplayer-skin/highlights-orange.css`
* `ozplayer-skin/highlights-pink.css`
* `ozplayer-skin/highlights-purple.css`
* `ozplayer-skin/highlights-red.css`
* `ozplayer-skin/highlights-yellow.css`

## Updated language

* `"button-mute-off"`
* `"button-mute-on"`
* `"text-mute-off"`
* `"text-mute-on"`


