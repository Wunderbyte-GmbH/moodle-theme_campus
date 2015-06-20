Introduction
============
Campus theme with a light feel through colour and font selection.

![image1](pix/screenshot.png "Campus Screenshot")

About
=====
 * copyright  &copy; 2014-onwards G J Barnard in respect to modifications of the Clean theme.
 * copyright  &copy; 2014-onwards Work undertaken for David Bogner of Edulabs.org.
 * author     G J Barnard - http://about.me/gjbarnard and http://moodle.org/user/profile.php?id=442195
 * author     Based on code originally written by Mary Evans, Bas Brands, Stuart Lamour and David Scotson.
 * license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later

Required version of Moodle
==========================
This version works with Moodle version 2014111000.00 release 2.8 (Build: 20141110) and above within the 2.8 branch until the
next release.

Please ensure that your hardware and software complies with 'Requirements' in 'Installing Moodle' on
'docs.moodle.org/28/en/Installing_Moodle'.

Installation
============
 1. Ensure you have the version of Moodle as stated above in 'Required version of Moodle'.  This is essential as the
    theme relies on underlying core code that is out of my control.
 2. Login as an administrator and put Moodle in 'Maintenance Mode' so that there are no users using it bar you as the administrator.
 3. Copy the extracted 'campus' folder to the '/theme/' folder.
 4. Go to 'Site administration' -> 'Notifications' and follow standard the 'plugin' update notification.
 5. Select as the theme for the site.
 6. Put Moodle out of Maintenance Mode.

Upgrading
=========
 1. Ensure you have the version of Moodle as stated above in 'Required version of Moodle'.  This is essential as the
    theme relies on underlying core code that is out of my control.
 2. Login as an administrator and put Moodle in 'Maintenance Mode' so that there are no users using it bar you as the administrator.
 3. Make a backup of your old 'campus' folder in '/theme/' and then delete the folder.
 4. Copy the replacement extracted 'campus' folder to the '/theme/' folder.
 5. Go to 'Site administration' -> 'Notifications' and follow standard the 'plugin' update notification.
 6. If automatic 'Purge all caches' appears not to work by lack of display etc. then perform a manual 'Purge all caches'
   under 'Home -> Site administration -> Development -> Purge all caches'.
 7. Put Moodle out of Maintenance Mode.

Uninstallation
==============
 1. Put Moodle in 'Maintenance Mode' so that there are no users using it bar you as the administrator.
 2. Change the theme to another theme of your choice.
 3. In '/theme/' remove the folder 'campus'.
 4. Put Moodle out of Maintenance Mode.

Version Information
===================
20th June 2015 - Version 2.8.1.9.
  1. Fix colour of breadcrumb arrows - task #683.

18th June 2015 - Version 2.8.1.8.
  1. Improve $CFG->themedir mechanism - task #684.
  2. Fix LESS -> CSS PHP compilation when installed in themedir - task #684.

10th June 2015 - Version 2.8.1.7.
  1. Fix 'Drag a link in site admin block and then move mouse over the links make icons move' - task #678.

 5th May 2015 - Version 2.8.1.6.
  1. Change icon colour to standard moodle grey - task #653.
  2. Implement better fix for coursename icon from Shoelace, keep an eye on MDL-50004.

30th April 2015 - Version 2.8.1.5.
  1. Fix link colour setting lang text - task #645.

29th April 2015 - Version 2.8.1.4.
  1. Increase max. number of slides to 6 - task #652.

28th April 2015 - Version 2.8.1.3.
  1. Added link colour setting - task #645.
  2. Fix carousel control icon so does not have a flattened circle.
  3. Add link to slides in slideshow - task #646.
  4. Make full screen button appear even when screen size is smaller than total width in the theme settings - #task 647.

15th April 2015 - Version 2.8.1.2.
  1. Fixed full screen mode: id="region-bs-main-and-pre" class9 remains at 74% instead of 100% - task #578.

 7th April 2015 - Version 2.8.1.1.
  1. Fixed position of new message popup - transposed from Shoelace.

 2nd April 2015 - Version 2.8.1.
  1. Stable.
  2. Fix white strip in background image.
  3. Get shoelace M2.8 fixes into campus - task #552.

26th March 2015 - Version 2.7.0.41.
  1. Adjust 'showpageheading' setting - task #540.

25th March 2015 - Version 2.7.0.40.
  1. Integrate social icons - task #546.
  2. Fix blocks have left margin when in full screen mode.

23rd March 2015 - Version 2.7.0.39.
  1. Update responsive default images - task #540.
  2. Add screenshot to pix folder - task #542.

20th March 2015 - Version 2.7.0.38.
  1. Enable WOFF2 support for FontAwesome.  If other fonts supply that format in future then it can be added.  Task #533.
  2. Tidy up config.php file for correct order of styles.
  3. Tidy up Gruntfile.js to remove old style creation mechanism.
  4. Update package.json for newer versions.
  5. Enabling full screen mode should be single column - task #534.
  6. When slideshow has blocks on side, then should have background colour of content area - task #536.
  7. Update to '6' - When slideshow has blocks on side, then should have background colour of content area darkened by 20% - task #536.
  8. Make exiting full screen mode smoother - task #538.
  9. Adjust setting "On top" for logo: Logo gets scewed when rectangular even if it has same height as background image - task #539.
 10. Clean up code - task #537.
 11. Default settings - task #540.

17th March 2015 - Version 2.7.0.37.
  1. Move category slide settings to a separate setting page - task #528.

16th February 2015 - Version 2.7.0.36.
  1. Adjust invisible block background - discovered whilst investigating task #451.
  2. Fix 'If there is no block in "aside" is it possible to switch to single column layout?' - task #451.
  3. Adjust logic for 'When I add a new top level course category, then the header images are not displayed within this category' - task #452.

15th February 2015 - Version 2.7.0.35.
  1. Adjustments to 'Forum design' - task #420.
  2. Add body font with 'Source sans pro', 'Questrial' and 'Open sans' - task #410.
  3. Remove CDN - task #410.

12th February 2015 - Version 2.7.0.34.
  1. Fixed drop down caret being white on white on front page section when editing on if navbar text is white.  Fix from Shoelace 2.8.2.1.

11th February 2015 - Version 2.7.0.33.
  1. Implement solution for core 'Fix text colour/bg colour issue' issue - task #446.

 8th February 2015 - Version 2.7.0.32.
  1. Fancy navbar <960px use same navbar style as standard - task #441.
  2. Slight fix to header background image not showing when header < pagewidthmax but > navbarCollapseWidth - task #438.

 7th February 2015 - Version 2.7.0.31.
  1. Fix click on expand icon needs two clicks - padding issue - task #438.
  2. Adjust page heading in navbar menu padding left and right - task #438.
  3. Adjust expand icon to the extreme right - task #438.
  4. Adjust affix such that it recalculates the top position of '#page-header' when the heading toggle
     collapses the header as the page is now dynamic in that dimension - task #438.
  5. Adapt code to use front page header when an module is a part of the site course - task #440.
  6. Finish 'Max width definition in theme settings' by tidying up code - task #428.
  7. Change hamburger icon bar colour to navbar text colour - task #442.
  8. Fix course category headers after task #440.
  9. Full page with header toggle - task #443.
 10. Quick fix to '.block_course_overview .content' margin whilst testing '/my' for task #443.
 11. Adjusted 'Forum design' against new design information - task #420.

 6th February 2015 - Version 2.7.0.30.
  1. Fix page heading in navbar occured in task #418 - task #437.
  2. Adjust 'Footer display' - task #430.
  3. Implement 'For views with max-width setting <100% add a "expand" functionality' - #task 438.
  4. Implement 'Forum design' - #task 420.

 5th February 2015 - Version 2.7.0.29.
  1. Slight tweak to coursename icon in front page combo list.  Bug fix from Shoelace.
  2. Style improvements from Shoelace.

 3rd February 2015 - Version 2.7.0.28.
  1. Update FontAwesome note about WOFF2 support in Moodle - see: MDL-46728 and MDL-49074.
  2. Adjust dropdown menu margin - task #427.
  3. Adjust login button on navbar padding - task #427.
  4. Footer display - task #430.
  5. Max width definition in theme settings - task #428.

31st January 2015 - Version 2.7.0.27.
  1. Added custom favicon - task #424.
  2. Added sticky navbar on scroll - task #418.

29th January 2015 - Version 2.7.0.26.
  1. Added block border options - task #417.
  2. Adjusted login block because of 'max-width: 280px;' for .block_login .content in 'bootstrapbase/less/moodle/blocks.less' - task #417.
  3. Adjusted 'Minor style optimizations' - task #421.
  4. Adjusted 'Page heading in navbar: minimize space to left side of the navbar' - task #422.
  5. Adjusted 'Change behaviour of setting: showpageheading' - task #423.

28th January 2015 - Version 2.7.0.25.
  1. Update to FontAwesome 4.3.0 - task #410.
  2. Added Ubuntu font and use of 'local' (http://www.w3.org/TR/css3-fonts/#descdef-src) where possible - task #410.
  3. Added EB Garamond, Droid Serif, Jura and Vollkorn - task #410.
  4. Added TitilliumText http://www.cufonfonts.com/de/font/437/titillium-text - task #410.
  5. Added TitilliumText Italic version from FontSquirrel - SIL Licence as stated on: http://www.fontsquirrel.com/fonts/titillium - task #410.
  6. Added Nunito and Roboto condensed - task #410.
  7. Temporarily removed WOFF2 font support - see: MDL-46728 - task #410.

26th January 2015 - Version 2.7.0.24.
  1. Fix text and heading colour settings - task #411.
  2. Theme settings mechanism for category header - task #409.
  3. Add font setting for headings - work in progress - task #410.

24th January 2015 - Version 2.7.0.23.
  1. Adjust 'navbar standard smaller than 960: make menu icon fit nicely into the navbar' - task #406.
  2. Implement 'Block header heading' - task #408.

22nd January 2015 - Version 2.7.0.22.
  1. Adjust absolute layout for course category - task #407.
  2. Adjust absolute layout logo width calculation to prevent skewing - task #407.
  3. Update setting instructions for absolute and side layouts - task #407.
  4. Adjust navbar standard smaller than 960: make menu icon fit nicely into the navbar - task #406.
  5. Implement 'Create course and module pages header' - task #361.

21st January 2015 - Version 2.7.0.21.
  1. Adjusted standard navbar to be full width and implemented compact fancy navbar as required by (variant01-smallscreen.jpg and
     variant01-smallscreen-flipped.jpg) on task #375 - task #405.
  2. Adjusted drop down user menu caret on navbar - task #404.
  3. Implement front page responsive header images - task #401.
  4. Refactoring for course category responsive header images - task #401.
  5. Implement course category responsive header images - task #401.
  6. Adjust absolute layout - task #407 - work in progress.

20th January 2015 - Version 2.7.0.20.
  1. Fixed #402 - missing bootstrap-transition.js - obtained from source: https://github.com/twbs/bootstrap/releases/tag/v2.3.2 then
     minififed with: node ./node_modules/uglify-js\bin\uglifyjs ./jquery/bootstrap-transition_2_3_2.js > ./jquery/bootstrap-transition_2_3_2_min.js
     after package.json updated to correct version from bootstrap source package.json and 'npm install'.
     Might need to consider using this sort of thing to produce a 'campus-bootstrap.js' file at the end when all known modules are in.
  2. Improve header - task #401.  Code currently commented out until complete solution established, then remove.
  3. Improve header - task #401.  Fallbacks to theme background if no frontpage logo for frontpage and the same for the course category if it and
     the front page have no logo.
  4. Add fallback images to 'pix' folder for > 960px - task #401.
  5. Remove background gradient on 'sitename' - task #403.
  6. Fix 'Position of .sitename h1' - task #403.

19th January 2015 - Version 2.7.0.19.
  1. Fix drop down menu only working from claret icon.
  2. Fix carousel autostart, known BS 2.3.2 bug - https://github.com/twbs/bootstrap/issues/7508 - so remove if update to BS3.
  3. When logged in as guest only have login button - task #400.
  4. Fix collapsed navbar not working by reverting back to known working YUI version and only using carousel component instead of
     complete set of Bootstrap jQuery.  This means a lighter footprint and also implements the JavaScript initialisatiion for the
     interval - http://getbootstrap.com/2.3.2/javascript.html#carousel - which is a different solution for '2'.
  5. Improvements to header image layout calculation - task #401.

16th January 2015 - Version 2.7.0.18.
  1. Slideshow optimizations - carousel caption - task #398.
  2. Slideshow optimizations - autoplay setting - task #398.
  3. Block header background colour - task #399.
  4. Custom login menu - task #400.
  5. Fancy navbar in 'flexlayout' ('absolutelayout' (deferred) needs refactoring to make work) - task #400.
  6. Page heading in navbar maximum - task #400.

15th January 2015 - Version 2.7.0.17.
  1. Improve course category logo fallback refactor (bug) - task #378 comment 16.
  2. Added methods to assist with determining the top level category for a course such that if no course header, then the category header could be used.
  3. Update logic of fallback for task #378 - comment 23.
  4. Sitename stying - task #393 - comment 39.

14th January 2015 - Version 2.7.0.16.
  1. Implement 'proof of concept' for frontpage and course category flexible headers - task #393.
  2. Implement course category logo fallback - task #378 comment 6 - from online meeting of 13th January 2015.
  3. Implement separate settings page for the carousel - task #394 comment 15.
  4. Implement draft / published status for the carousel - task #394 comment 18.
  5. Implement course category logo fallback to 'pix' folder - task #378 comment 13.

13th January 2015 - Version 2.7.0.15.
  1. Frontpage slider - task #394.
  2. Course category header - task #378.

12th January 2015 - Version 2.7.0.14.
  1. Update to frontpage header - task #393 comment 25.
  2. Started work on slider - task #394.

11th January 2015 - Version 2.7.0.13.
  1. Added 'breadcrumb' to list of non-text shadow components - task #390.
  2. Implement automatic header dimension resizing for 'side' option based upon automatic detection of image size.  See calculations-widths_3.ods on task #393.
  3. Slide show preparation work to establish two positions for the slider - task #394.

 9th January 2015 - Version 2.7.0.12.
  1. Use 'table' display attribute for 'Side option' so that responsive on Firefox and IE - task #375.
  2. Fix navbar menu item text colour when collapsed.
  3. Improve side height - task #393.

 8th January 2015 - Version 2.7.0.11.
  1. Frontpage header logo to link to front page - task #375.
  2. Side option for logo and background image on the frontpage - depends on 'flex' display layout: http://caniuse.com/#search=flex - so not good with less than IE11 - task #375.

 6th January 2015 - Version 2.7.0.10.
  1. Changed navbar collapse with to 960px - task #375.
  2. Implemented small navbar when < 960px - note: 'brand' tricky to show / hide and was a requirement to show when menu not open and collapsed - task #375.
  3. Cleaned settings for image background - task #375.
  4. Logo height now same as header height - task #375.  Note: When less than 960px shrinks to uploaded size such that suitable for such devices.  Currently seems impossible to be responsive as absolute positioning used to place on top of background.
  5. Page header as per http://development.edulabs.org/redmine/attachments/download/56/variant01-smallscreen.jpg and http://development.edulabs.org/redmine/attachments/download/57/variant01-smallscreen-flipped.jpg - Frontpage only has no sitename in navbar as previously requested - task #375.
  6. Header same width as #page - #task 385.
  7. Update login button as per task #375 comment: http://development.edulabs.org/redmine/issues/375#note-24 - unsure of what to do when logged in as not stated and previously user picture theme attributes described.
  8. Implement Shoelace block fixes in core_renderer.php from: https://github.com/gjb2048/moodle-theme_shoelace/commit/3d05319a4172796c4816c91af095c93caa3b66d9.
  9. Remove text shadow from navbar, block headings and buttons - task #390.
 10. Slider preparation - task #360.

30th December 2014 - Version 2.7.0.9.
  1. Update user picture in line with comments on task #375 of 30/12/14.
  2. Update 'Use front page' setting in line with comments on task #375 of 30/12/14.
  3. Responsive background image - task #375.

27th December 2014 - Version 2.7.0.8.
  1. Create frontpage header settings and implement their intent - needs review - task #375.

23rd December 2014 - Version 2.7.0.7.
  1. Update site name in navbar on front page otherwise page header - task #374.
  2. Add warning to hide local login - task #365.
  3. Remove button from subscribe, link and text still there as per supplied code - task #373.
  4. Create integer range admin setting - task #377.
  5. Update fix in 'Default value for setting alternateloginurl in settings.php not correct' - task #376.

22nd December 2014 - Version 2.7.0.6.
  1. Change "display login ling" setting - task #373.
  2. Fix 'go to bottom' functionality after removal of shadow.
  3. Site name in navbar on front page otherwise page header - task #374.
  4. Overriding Login renderer and theme setting for activation of the override - task #365.
  5. Render login link as button - task #369.
  6. Fix svg files not having 'viewbox' property for IE.
  7. Create separate top level category header (settings only) - task #360.
  8. Create course and module pages header - task #361.
  9. Create frontpage header file - task #359.

21st December 2014 - Version 2.7.0.5.
  1. Border radius changes - task #371.
  2. Region main - task #372.
  3. Remove h1 page heading - task #370.

20th December 2014 - Version 2.7.0.4.
  1. Cross patch of Shoelace 2.7.1.1 part of Essential issue #409 for future proofing.
  2. Fixed border issue on task #364.
  3. Implemented 'General settings (does not depend on variant) - login link.' of task #359.

19th December 2014 - Version 2.7.0.3
  1. Theme layout setting in 'General settings'.  Task #362 - via 'They should be available in the general settings page of the theme.' on eMail.
  2. Implemented layout settings in config.php and adapted layout files.  Task #362.
  3. Implemented separate header selection code.  Task #360.  Pending definition of separate headers and determination if 'page-header.php' is the better file to switch on.

18th December 2014 - Version 2.7.0.2
  1. Added 'Theme layout' setting for 'Theme setting, that defines number of columns for the layout' requirement.
  2. Theme layout options in 'config.php' file with TDM off proof of concept from Mutant Banjo theme.
  3. Create separate setting sections.  Task #358.
  4. Preparation category code for Task #360.

17th December 2014 - Version 2.7.0.1
  1. Initial clone of Shoelace 2.7.2.  Task #353.
  2. Removed Cabin and Varela Round fonts in favour of Source Sans Pro.  Task #354.
  3. Static top navbar.  Task #356.
  4. Initial colour settings.  Task #355.

Me
==
G J Barnard MSc. BSc(Hons)(Sndw). MBCS. CEng. CITP. PGCE.
Moodle profile: http://moodle.org/user/profile.php?id=442195
Web profile   : http://about.me/gjbarnard
