Version Information
===================
 8th May 2017 - Version 3.2.1.1
  1. Fix side-post blocks underneath content area on three column Frontpage when no side-pre blocks.

13th April 2017 - Version 3.2.1.0
  1. Add Roberto as a body font.
  2. Fix assignment view layout.
  3. Fix 'Course name appears in navbar when set to appear only in page content' - #8.

17th January 2017 - Version 3.2.0.3
  1. Fix change in font file length.

11th January 2017 - Version 3.2.0.2
  1. Removed redundant CSS file in font folder.
  2. Fix 'block_adminblock' margin.

 4th January 2017 - Version 3.2.0.2
  1. Add 'Switch role to' functionality.
  2. Update to FontAwesome 4.7.0.

14th December 2016 - Version 3.2.0.1
  1. Moodle 3.2 beta version.
  2. For jQuery 3 needed to escape all '#'s and '"'s in the JS - ref: https://api.jquery.com/category/selectors/.
  3. Note: Having a single hash '#' for the URL for ARIA on the 'dropdown-toggle' link breaks jQuery like so:

Uncaught Error: Syntax error, unrecognized expression: #
    at Function.ga.error (jquery-3.1.0.min.js:1)
    at ga.tokenize (jquery-3.1.0.min.js:1)
    at ga.select (jquery-3.1.0.min.js:1)
    at Function.ga [as find] (jquery-3.1.0.min.js:1)
    at r.fn.init.find (jquery-3.1.0.min.js:1)
    at r.fn.init (jquery-3.1.0.min.js:1)
    at r (jquery-3.1.0.min.js:1)
    at c (first.js:232)
    at HTMLAnchorElement.toggle (first.js:232)
    at HTMLDocument.dispatch (jquery-3.1.0.min.js:1)

Set to the page URL.  This needs ARIA checking.  But... the call stack indicates issues with Bootstrap 2.3.2 code, so I suspect that
the decision to update to jQuery 3 was not so good in relation to supporting BS2.3.2 - need to investigate if bigger issue here.

12th November 2016 - Version 3.1.1.12
  1. Fix content colour - ref: https://moodle.org/mod/forum/discuss.php?d=341543#p1381206.

18th October 2016 - Version 3.1.1.11
  1. Quiz: Make the "Submit quiz" button sticky to always be visible - z-index of 4 - task #916.

17th October 2016 - Version 3.1.1.10
  1. Quiz: Make the "Submit quiz" button sticky to always be visible - task #916.
  2. Fix missing 'html' object in the secure layout.
  3. In the quiz, the navigation block is on the right side despite theme setting: 2 column, blocks on the left - task #917.
  4. Table word wrap. Issue: #5 - task #918.

 6th September 2016 - Version 3.1.1.9
  1. Dropdown User menu - task #891.

10th August 2016 - Version 3.1.1.8
  1. Fix icons.

10th August 2016 - Version 3.1.1.7
  1. Fix icon colour setting default.

10th August 2016 - Version 3.1.1.6
  1. Fix anti gravity colour.
  2. Fix icon colour setting default.

 8th August 2016 - Version 3.1.1.5
  1. MDL-53152.

 4th August 2016 - Version 3.1.1.4
  1. MDL-39661.

28th July 2016 - Version 3.1.1.3
  1. Forumpost font colour - task #862.

25th July 2016 - Version 3.1.1.2
  1. Setting coursepagepageheadinglocation/frontpagepageheadinglocation is not always applied correctly - task #863.
  2. Userpicture in navbar: style improvements - task #861.
  3. Color of block icons - task #859.

23rd July 2016 - Version 3.1.1.1
  1. Hamburger button looks ugly in many cases - task #860.

12th July 2016 - Version 3.1.1.0
  1. First stable version for M3.1.

 7th July 2016 - Version 3.1.0.2
  1. Change to Bootstrapbase Bootstrap JavaScript.

27th June 2016 - Version 3.1.0.1
  1. Initial M3.1 version.
  2. Implement new search UI on navbar.
  3. Update icons.
  4. Cope with course navigation block.  Code from Essential.
  5. Gradebook floating headers styling.
  6. Check Collapsed Topics styles.

19th April 2016 - Version 3.0.0.6
  1. Fix outputrenderer issue - task #811.

11th April 2016 - Version 3.0.0.5
  1. Accessibility error: Scrolldown-Button in Navbar gives error "empty link" - task #804.
  2. When logo display is set to "right" side and for a single category it is set to "left" side, then all categories have the logo on the left side - task #810.

16th March 2016 - Version 3.0.0.4
  1. Responsive behaviour of the header on small devices - task #807.
  2. If not fixed in core fix greyed out accessibility issue - task #808.
  3. Fix admin settings issue - task #809.

 1st March 2016 - Version 3.0.0.3
  1. Dropdown for Profile settings in collapsed menu does not work - apply MDL-51819 - task #785.
  2. Accessibility error: Scrolldown-Button in Navbar gives error "empty link" - task #804.

27th February 2016 - Version 3.0.0.2
  1. The page heading on category pages always appears in the navbar - task #802.
  2. Forum thread headings should take the value of "medium border radius" for the corner radius - task #803.

 5th February 2016 - Version 3.0.0.1
  1. Bump version for Moodle 3.0 version.

13th January 2016 - Version 2.9.1.22
  1. Main content area overlaps on some pages with block area on right side - task #784.

 5th January 2016 - Version 2.9.1.21
  1. Responsive font size for h1 in header - update - task #778.
  2. Remove body padding left and right - task #783.

 2nd January 2016 - Version 2.9.1.20
  1. In FireFox the mouse is shown as "input" sign while hovering over fullscreen toggle - task #777.
  2. Responsive font size for h1 in header - task #778.
  3. Front-page padding of course summary - task #780.

  1st January 2016 - Version 2.9.1.19
  1. Width of ressource "label" is different from width of "site summary" on frontpage - task #775.

29th December 2015 - Version 2.9.1.18
  1. Implement "Display page heading" in a different way - task #776.

28th December 2015 - Version 2.9.1.17
  1. Fix broken navbar toggle.
  2. Create 'Changes.md' in line with: https://docs.moodle.org/dev/Plugin_files#CHANGES.

23rd December 2015 - Version 2.9.1.16
  1. Doubled hamburger icon with fancy navbar and small screen sizes - task #774.

 7th December 2015 - Version 2.9.1.15
  1. Redundant title tags - task #769.

 2nd December 2015 - Version 2.9.1.14
  1. Revert button slideshow navigation - task #766.
  2. No href on fullscreen 'a' tag - task #766.

 1st December 2015 - Version 2.9.1.13
  1. Pointer cursor - task #765.
  2. Button slideshow navigation - task #766.

30th November 2015 - Version 2.9.1.12
  1. Implement 'Use title attribute in order to explain what is happening, when clicking on the toggleheader link' - task #766.
  2. Implement 'Navigation issue from accessibility checker' - task #765.

28th November 2015 - Version 2.9.1.11
  1. Reimplement 'H1 heading settings' - task #759.
  2. Start to 'Fix HTML issues not covered by previous tickets but detected by the W3C validator' - task #757.
  3. Implement 'Accessibility issues, that concern campus but not clean' - tassk #761.

27th November 2015 - Version 2.9.1.10
  1. Finish implementing 'Breadcrumb modification: add setting for different breadcrumb display' - task #748.
  2. Implement 'Alt tags for header images missing' - task #752.

24th November 2015 - Version 2.9.1.9
  1. Partially implement 'Breadcrumb modification: add setting for different breadcrumb display' - task #748.

23rd November 2015 - Version 2.9.1.8
  1. Implement 'Page heading on frontpage display like on other pages' - task #749.
  2. Implement 'H1 heading settings' - task #759.

19th November 2015 - Version 2.9.1.7
  1. Redo 'Page heading on category pages display site name instead of category name' - task #747.

18th November 2015 - Version 2.9.1.6
  1. Implement 'Page heading on category pages display site name instead of category name' - task #747.

14th November 2015 - Version 2.9.1.5.
  1. Fix 'Settings block does not appear in the side bar when specific block settings are used' - task #725.
  2. Fix 'Anchor links have a positioning problem' - task #743.

16th September 2015 - Version 2.9.1.4.
  1. Fix assignment grading issue - task #724.

26th August 2015 - Version 2.9.1.3.
  1. Forum header not responsive (height problem) - task #723.

31st July 2015 - Version 2.9.1.2.
  1. Refix 'Drag a link in site admin block and then move mouse over the links make icons move' - task #678.

28th July 2015 - Version 2.9.1.1.
  1. Fix 'Customized category header not showing for grading view' - https://github.com/dasistwas/moodle-theme_campus/issues/2 / task #701.

20th July 2015 - Version 2.9.1.
  1. First stable version for Moodle 2.9.

20th July 2015 - Version 2.9.0.12.
  1. Fix 'Bewertungsansicht für Teilnehmer sehr zerfleddert' - task #686.

13th July 2015 - Version 2.9.0.11.
  1. Fix collapsed navbar as reported here: https://moodle.org/mod/forum/discuss.php?d=316686.

24th June 2015 - Version 2.9.0.10.
  1. Class autoloading for core_renderer.php - task #556.

23rd June 2015 - Version 2.9.0.9.
  1. Convert all jQuery to use AMD - task #556.
  2. Update icons - task #556.

20th June 2015 - Version 2.9.0.8.
  1. Fix colour of breadcrumb arrows - task #683.

18th June 2015 - Version 2.9.0.7.
  1. Improve $CFG->themedir mechanism - task #684.
  2. Fix LESS -> CSS PHP compilation when installed in themedir - task #684.

10th June 2015 - Version 2.9.0.6.
  1. Fix 'Drag a link in site admin block and then move mouse over the links make icons move' - task #678.

5th May 2015 - Version 2.9.0.5.
  1. Change icon colour to standard moodle grey - task #653.
  2. Implement better fix for coursename icon from Shoelace, keep an eye on MDL-50004.

30th April 2015 - Version 2.9.0.4.
  1. Fix link colour setting lang text - task #645.

29th April 2015 - Version 2.9.0.3.
  1. Increase max. number of slides to 6 - task #652.

28th April 2015 - Version 2.9.0.2.
  1. Added link colour setting - task #645.
  2. Fix carousel control icon so does not have a flattened circle.
  3. Add link to slides in slideshow - task #646.
  4. Make full screen button appear even when screen size is smaller than total width in the theme settings - #task 647.

15th April 2015 - Version 2.9.0.1.
  1. Moodle 2.9 development version - task #556.
  2. Fixed full screen mode: id="region-bs-main-and-pre" class9 remains at 74% instead of 100% - task #578.

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
