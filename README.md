# OzPlayer

## Directory Structure

* `build` contains the **latest build versions** of all files used by OzPlayer.

   The free and subscription scripts can be found within the `build/ozplayer-core` sub-directory, and these are the versions that should be uploaded to fastly.net.

   The contents of this directory (minus the free and subscription scripts) is zipped to create the distributable.

* `changelogs` contains changelogs for every version
* `dist` contains distributable zip-files for every version
* `docs` contains help and support documentation for the **latest version**
* `media` contains media files for demos and testing (video, audio, posters, captions and transcript data)
* `ozplayer-core` contains source scripts and core stylesheets for the **latest version**
* `ozplayer-lang` contains source translation files for the **latest version**
* `ozplayer-skin` contains source images and skin stylesheets for the **latest version**

## Top-Level Files

* `responsive-audio.php` is a test page for the responsive audio-only player
* `responsive.php` is a test page for the standard audio-only player
* `responsive-test.php` is a test page for the responsive video player
* `test.js` is a test configuration script
* `test.php` is a test page for the standard video player
* `transcript-cue.png` is the transcript cue marker image
* `transcript.css` is the source version of the transcript sylesheet
