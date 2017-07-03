# OzPlayer 3.0 Changelog

## New Features

* Added support for audio-only playback:

  Using an `AUDIO` element rather than a `VIDEO` element will switch to audio-only mode. When playing audio only:

  * the interface will simply be a control strip.
  * posters, captions and audio descriptions are not supported.
  * transcripts are still supported and compiled from captions `TRACK` data as usual.

  The audio-only player can be initialised using the new `OzPlayer.Audio()` function, however this is simply an alias to `OzPlayer.Video()` so it's not actually necessary to use the separate function: using `OzPlayer.Video()` will initialise an audio-only player if the instance only contains audio data.

  The `OzPlayer.init()` also works for either kind of media, and will initialise mixed instances (i.e. video and audio players on the same page).

* Added supported for multi-language captions:

  When multiple `TRACK` elements are used with different languages, the player will now create a menu attached to the "CC" button, allowing users to select the language (or switch the captions off). Changes to language selection will also update the transcript.

  For the audio-only player, captions are not shown; this menu will be labelled "TR" and can be used switch the transcript language.

  If only a single language is provided, then the menu won't be shown; the "CC" button will continue to function as an on/off switch. For the audio-only player in this case, the button will no longer appear at all.

* Added support for new `TRACK` attributes to support multi-language captions

  * `[label]` defines visible text for the language selection menu.
  * `[data-default-transcript]` specifies that this track will be used for the default transcript output if multiple tracks are specified but captions are off by default.

* Added support for WebVTT `LANG` tags

## Bug Fixes

* Fixed an issue with the YouTube player where embedded captions would be displayed in addition to captions defined with `TRACK` elements.

  For YouTube videos which have `TRACK` captions defined, any embedded captions will now be removed.

  Alternatively, if `TRACK` captions are not provided, the player interface can now be used to provide user control over the embedded captions, by adding a `[data-captions]` attribute to the YouTube `SOURCE` element.

* Fixed an issue in Edge where high-contrast themes were not being detected, which meant that the video controls were not using the high-contrast styles.

* Fixed an issue in Edge whereby keyboard users were not able to Tab to the fullscreen permissions dialog when entering fullscreen for the first time.

* Fixed a couple of issues in iOS 10 on iPhone, where controls would be lost after exiting fullscreen mode (making further playback impossible), and where captions may appear over the inline video without being updated (i.e. they would be stuck on a single caption).

  These changes relate to the fact that iOS10 can now play inline videos (i.e. not in fullscreen mode).

* Fixed an issue in recent versions of Firefox whereby high-DPI images were not being applied because of a change in its supported media query syntax.

## Other Changes

* Removed mime-type checking when loading VTT and SRT files, so that server configuration is no longer required to define the types for these files.

* Keyboard clicks on the control buttons no longer repeat, since repeating is unecessary and may cause problems for people who have a motor impairment.

* Slightly lightened the color of disabled controls, to comply with minimum contrast requirements for small controls.

* Removed the global volume-key handler (up and down arrows) because it meant that these keystrokes couldn't be used in other parts of the interface, but they're more usefully supported on the slider controls and now essential for navigating the new captions language menu.

* Removed the keyboard shortcuts tooltip because it wasn't really needed.

* Some changes to the language file to support multi-language captions and audio-only, and because of the removal of the keyboard shortcuts tooltip:

  * Added:

    * `"button-cc-lang"`
    * `"button-cc-nolang"`
    * `"text-cc-lang"`
    * `"text-cc-loading"`
    * `"menu-cc-off"`
    * `"text-tr-off"`
    * `"text-tr-on"`
    * `"text-tr-lang"`
    * `"text-tr-loading"`
    * `"transcript-off"`
    * `"transcript-lang"`
    * `"transcript-nolang"`

  * Removed:

    * `"keyboard-help-text"`
    * `"skip-link-shortcuts"`

  * Changed:

    * `"controls-legend"`
    * `"indicator-loading"`
    * `"indicator-timeout"`

  These changes are backwardly compatible to the extent that the new version of the player can still be used with an older version of the language file, however any missing valus will be restored by internal defaults (which are in English) and therefore the missing new values would not be translated.

## Updated Files

* `ozplayer-core/ozplayer.free.js`
* `ozplayer-core/ozplayer.min.css`
* `ozplayer-core/ozplayer.min.js`
* `ozplayer-core/OzPlayer.php`
* `ozplayer-core/ozplayer.subs.debug.js`
* `ozplayer-core/ozplayer.subs.js`
* `ozplayer-lang/en.js`
* `ozplayer-skin/buttons-black-large.png`
* `ozplayer-skin/buttons-black-large@2x.png`
* `ozplayer-skin/buttons-black.png`
* `ozplayer-skin/buttons-white-large.png`
* `ozplayer-skin/buttons-white-large@2x.png`
* `ozplayer-skin/buttons-white.png`
* `ozplayer-skin/highlights-blue.css`
* `ozplayer-skin/highlights-green.css`
* `ozplayer-skin/highlights-orange.css`
* `ozplayer-skin/highlights-pink.css`
* `ozplayer-skin/highlights-purple.css`
* `ozplayer-skin/highlights-red.css`
* `ozplayer-skin/highlights-yellow.css`


