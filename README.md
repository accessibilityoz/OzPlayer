# OzPlayer

## Introduction

This is a very early release. The product had been proprietary for many years,
but while we're no longer selling it there are some folks still using it who'd
like to be able to make fixes, so we're releasing under the MIT license.

What this means is that the code hasn't been updated for a few years and is
in need of clean-up and updates. The build system is ancient, undocumented,
and written in PHP.

Improvements would be happily accepted, or you're welcome to fork.

Following is the original README.md:

## Directory Structure

* `build` contains the **latest build versions** of all files used by OzPlayer.

   The free and subscription scripts can be found within the `build/ozplayer-core` sub-directory, and these are the versions that should be uploaded to fastly.net.

   The contents of this directory (minus the free and subscription scripts) is zipped to create the distributable.

* `changelogs` contains changelogs for every version
* `dist` contains distributable zip-files for every version
* `docs` contains help and support documentation for the **latest version**
* `media` contains media files for demos and testing (video, audio, posters, captions, transcript, and xad data)
* `ozplayer-core` contains source scripts and core stylesheets for the **latest version**
* `ozplayer-lang` contains source translation files for the **latest version**
* `ozplayer-skin` contains source images and skin stylesheets for the **latest version**
* `tools` contains build tools

## Top-Level Files

* `responsive-audio.php` is a test page for the responsive audio-only player
* `responsive.php` is a test page for the responsive video player
* `test-audio.php` is a test page for the standard audio-only player
* `test.js` is a test configuration script
* `test.php` is a test page for the standard video player
* `transcript-cue.png` is the transcript cue marker image for the **latest version**
* `transcript.css` is the source version of the transcript sylesheet for the **latest version**
