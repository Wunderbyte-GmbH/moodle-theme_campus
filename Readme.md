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
This version works with Moodle version 2014051200.00 release 2.7 (Build: 20140512) and above within the 2.7 branch until the
next release.

Please ensure that your hardware and software complies with 'Requirements' in 'Installing Moodle' on
'docs.moodle.org/27/en/Installing_Moodle'.

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
 6th January 2014 - Version 2.7.0.10.
  1. Changed navbar collapse with to 960px - task #375.
  2. Implemented small navbar when < 960px - note: 'brand' tricky to show / hide and was a requirement to show when menu not open and collapsed - task #375.
  3. Cleaned settings for image background - task #375.
  4. Logo height now same as header height - task #375.  Note: When less than 960px shrinks to uploaded size such that suitable for such devices.  Currently seems impossible to be responsive as absolute positioning used to place on top of background.
  5. Page header as per http://development.edulabs.org/redmine/attachments/download/56/variant01-smallscreen.jpg and http://development.edulabs.org/redmine/attachments/download/57/variant01-smallscreen-flipped.jpg - Frontpage only has no sitename in navbar as previously requested - task #375.
  6. Header same width as #page - #task 385.
  7. Update login button as per task #375 comment: http://development.edulabs.org/redmine/issues/375#note-24 - unsure of what to do when logged in as not stated and previously user picture theme attributes described.
  8. Implement Shoelace block fixes in core_renderer.php from: https://github.com/gjb2048/moodle-theme_shoelace/commit/3d05319a4172796c4816c91af095c93caa3b66d9.
  9. Remove text shadow from navbar, block headings and buttons - task #390.

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
