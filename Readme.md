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
20th December 2014 - Version 2.7.0.4.
  1. Cross patch of Shoelace 2.7.1.1 part of Essential issue #409 for future proofing.

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
