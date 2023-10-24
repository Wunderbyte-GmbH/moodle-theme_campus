<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Campus theme with the underlying Bootstrap theme.
 *
 * @package    theme
 * @subpackage campus
 * @copyright  &copy; 2014-onwards G J Barnard in respect to modifications of the Clean theme.
 * @copyright  &copy; 2014-onwards Work undertaken for David Bogner of Edulabs.org.
 * @author     G J Barnard - {@link http://moodle.org/user/profile.php?id=442195}
 * @author     Based on code originally written by Mary Evans, Bas Brands, Stuart Lamour and David Scotson.
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
$string['choosereadme'] = '
<div class="clearfix">
<div class="well">
<h2>Campus</h2>
<p><img class="img-polaroid" src="campus/pix/screenshot.png" /></p>
</div>
<div class="well">
<h3>About</h3>
<p>Campus is a modified Moodle bootstrap theme which inherits styles and renderers from its parent theme.</p>
<h3>Parents</h3>
<p>This theme is based upon the Bootstrap theme, which was created for Moodle 2.5, with the help of:<br>
Stuart Lamour, Mark Aberdour, Paul Hibbitts, Mary Evans.</p>
<h3>Theme credits</h3>
<p>Author: G J Barnard<br>
Contact: <a href="http://moodle.org/user/profile.php?id=442195">Moodle profile</a><br>
Website: <a href="http://about.me/gjbarnard">about.me/gjbarnard</a>
</p>
<h3>Report a bug:</h3>
<p><a href="http://tracker.moodle.org">http://tracker.moodle.org</a></p>
<h3>More information</h3>
<p><a href="campus/Readme.md">How to use this theme.</a></p>
</div></div>';

$string['configtitle'] = 'Campus';

$string['pluginname'] = 'Campus';

$string['region-side-nav'] = 'Nav';
$string['region-course'] = 'Course';
$string['region-footer'] = 'Footer';
$string['region-side-nav-region'] = 'Nav region';
$string['region-course-region'] = 'Course region';
$string['region-footer-region'] = 'Footer region';

// Draft or published.
$string['draft'] = 'Draft';
$string['published'] = 'Published';

// Navbar.
$string['gotobottom'] = 'Go to the bottom of the page';
$string['navbartype'] = 'Navbar type';
$string['navbartypedesc'] = 'Choose between \'Standard\' or \'Fancy\'.  Only applicable when the layout is \'Side\', for \'On top\' the default \'Standard\' will be used.  Note: \'Fancy\' will only apply when there is a background image in the header.';
$string['standardnavbar'] = 'Standard';
$string['fancynavbar'] = 'Fancy';
$string['navbarpageheadingmax'] = 'Navbar page heading maximum.';
$string['navbarpageheadingmaxdesc'] = 'Set the navbar page heading maximum between {$a->lower} and {$a->upper} pixels.';
$string['campusnav'] = 'Additional campus navigation';

// Login custom menu.
$string['mygrades'] = 'My grades';
$string['coursegrades'] = 'Course grades';

// Login custom menu depreciated.
$string['blogpreferences'] = 'Blog preferences';
$string['badgepreferences'] = 'Badge preferences';
$string['messagepreferences'] = 'Message preferences';

// Anti-gravity.
$string['antigravity'] = 'Back to top';

// Settings.
// General settings.
$string['genericsettings'] = 'General';
$string['generalheadingdesc'] = 'Configure the general settings for the theme here.';

$string['alternateloginurl'] = 'Alternative login URL.';
$string['alternateloginurldesc'] = 'Alternative login URL.';

$string['hidelocallogin'] = 'Hide local login';
$string['hidelocallogindesc'] = 'Hide the local login on login page.  NOTE: Only enable this if all users are remote.';

$string['showlogininfoheader'] = 'Display header login link';
$string['showlogininfoheaderdesc'] = 'Display the login link in the header.';

$string['showlogininfofooter'] = 'Display footer login link';
$string['showlogininfofooterdesc'] = 'Display the login link in the footer.';

$string['favicon'] = 'Favicon';
$string['favicondesc'] = 'Upload your \'favicon\' here.';

$string['customcss'] = 'Custom CSS';
$string['customcssdesc'] = 'Whatever CSS rules you add to this textarea will be reflected in every page, making for easier customization of this theme.';

// Look and feel settings.
$string['landfsettings'] = 'Look and feel';
$string['landfheadingdesc'] = 'Configure the look and feel settings for the theme here.';

$string['pagewidthmax'] = 'Page width maximum';
$string['pagewidthmaxdesc'] = 'Set the maximum page width.';
$string['px1000'] = '1000px';
$string['px1200'] = '1200px';
$string['px1400'] = '1400px';
$string['px1680'] = '1680px';
$string['per100'] = '100%';

$string['headingfont'] = 'Headings font';
$string['headingfontdesc'] = 'Set the font for the headings.';

$string['bodyfont'] = 'Body font';
$string['bodyfontdesc'] = 'Set the font for the body.';

$string['textcolour'] = 'Text colour';
$string['textcolourdesc'] = 'Set the text colour.';

$string['linkcolour'] = 'Link text colour';
$string['linkcolourdesc'] = 'Set the link text colour.';

$string['contentcolour'] = 'Content colour';
$string['contentcolourdesc'] = 'Set the content colour.';

$string['headingcolour'] = 'Heading colour';
$string['headingcolourdesc'] = 'Set the heading colour.';

$string['navbartextcolour'] = 'Navbar text colour';
$string['navbartextcolourdesc'] = 'Set the navigation bar text colour.';

$string['navbarlinkcolour'] = 'Navbar link colour';
$string['navbarlinkcolourdesc'] = 'Set the navigation bar link colour.';

$string['navbariconcolour'] = 'Navbar icon colour';
$string['navbariconcolourdesc'] = 'The colour for the navbar FontAwesome icons.';

$string['navbarbackgroundcolour'] = 'Navbar background colour';
$string['navbarbackgroundcolourdesc'] = 'Set the navigation bar background colour.';

$string['blockheadingcolour'] = 'Block heading colour';
$string['blockheadingcolourdesc'] = 'Set the block heading colour.';

$string['blockheadingbackgroundcolour'] = 'Block heading background colour';
$string['blockheadingbackgroundcolourdesc'] = 'Set the block heading background colour.';

$string['blockbackgroundcolour'] = 'Block background colour';
$string['blockbackgroundcolourdesc'] = 'Set the block background colour.';

$string['blockborderoptions'] = 'Block borders';
$string['blockborderoptionsdesc'] = 'Border options for the blocks.';
$string['blocknoborder'] = 'No border';
$string['blockborderall'] = 'Border around the whole block';
$string['blockborderheader'] = 'Border on header only';
$string['blockbordercontent'] = 'Border on content only';
$string['blockborderthreelines'] = 'Three horizontal lines: above header, between header/content and bottom';

$string['blockbordercolour'] = 'Block border colour';
$string['blockbordercolourdesc'] = 'Set the block border colour.';

$string['blockborderthickness'] = 'Block border thickness';
$string['blockborderthicknessdesc'] = 'Border thickness of the block.';

$string['blockborderstyle'] = 'Block border style';
$string['blockborderstyledesc'] = 'Border style of the block.';
$string['blockborderstylenone'] = 'None';
$string['blockborderstylehidden'] = 'Hidden';
$string['blockborderstyledotted'] = 'Dotted';
$string['blockborderstyledashed'] = 'Dashed';
$string['blockborderstylesolid'] = 'Solid';
$string['blockborderstyledouble'] = 'Double';
$string['blockborderstylegroove'] = 'Groove';
$string['blockborderstylenridge'] = 'Ridge';
$string['blockborderstyleninset'] = 'Inset';
$string['blockborderstylenoutset'] = 'Outset';

$string['themecolour'] = 'Theme colour';
$string['themecolourdesc'] = 'Set the theme colour.';

$string['themebackgroundcolour'] = 'Theme background colour';
$string['themebackgroundcolourdesc'] = 'Set the theme background colour.';

$string['borderradiussmall'] = 'Small border radius';
$string['borderradiussmall_desc'] = 'Small border radius.';

$string['borderradiusmedium'] = 'Medium border radius';
$string['borderradiusmedium_desc'] = 'Medium border radius.';

$string['borderradiuslarge'] = 'Large border radius';
$string['borderradiuslarge_desc'] = 'Large border radius.';

$string['px00'] = '0px';
$string['px01'] = '1px';
$string['px02'] = '2px';
$string['px03'] = '3px';
$string['px04'] = '4px';
$string['px05'] = '5px';
$string['px06'] = '6px';
$string['px07'] = '7px';
$string['px08'] = '8px';
$string['px09'] = '9px';
$string['px10'] = '10px';
$string['px11'] = '11px';
$string['px12'] = '12px';
$string['px13'] = '13px';
$string['px14'] = '14px';
$string['px15'] = '15px';
$string['px16'] = '16px';
$string['px17'] = '17px';
$string['px18'] = '18px';
$string['px19'] = '19px';
$string['px20'] = '20px';
$string['px21'] = '21px';
$string['px22'] = '22px';
$string['px23'] = '23px';
$string['px24'] = '24px';
$string['px25'] = '25px';

// Carousel.
$string['carouselsettings'] = 'Carousel general';
$string['carouselsettingsdesc'] = 'Configure the general carousel settings for the theme here.';

$string['sliderposition'] = 'Slider position';
$string['sliderpositiondesc'] = 'Position of the slider on the page.';
$string['sliderpositionheader'] = 'Underneath the navbar';
$string['sliderpositionpage'] = 'With the page content';

$string['slidernextslide'] = 'Next slide';
$string['sliderpreviousslide'] = 'Previous slide';

$string['frontpagecarouselsettings'] = 'Front page carousel';
$string['frontpagecarouselsettings_desc'] = 'Front page carousel settings.';

$string['coursecategorycarouselsettings'] = 'Course category carousel';
$string['coursecategorycarouselsettings_desc'] = 'Course category carousel settings.';

$string['carouselautoplay'] = 'Autoplay';
$string['carouselautoplaydesc'] = 'If set then the slides will transition at the slide interval rate.';
$string['slideinterval'] = 'Slide interval';
$string['slideintervaldesc'] = 'Set the transition interval between {$a->lower} and {$a->upper} milliseconds.';
$string['carouseltextcolour'] = 'Slide text colour';
$string['carouseltextcolourdesc'] = 'What colour the slide caption text should be.';
$string['slidecaptioncentred'] = 'Slide caption centred';
$string['slidecaptioncentreddesc'] = 'If the slide caption should be centred.';
$string['slidebuttoncolour'] = 'Slide button colour';
$string['slidebuttoncolourdesc'] = 'What colour the slide navigation button should be.';
$string['slidebuttonhovercolour'] = 'Slide button hover colour';
$string['slidebuttonhovercolourdesc'] = 'What colour the slide navigation button hover should be.';

$string['carouselstatus'] = 'Carousel status';
$string['carouselstatus_desc'] = 'States if the carousel is visible, draft = no and published = yes.  This allows you to prepare the carousel beforehand without it being live to the users.';
$string['numberofslides'] = 'Number of slides';
$string['numberofslidesdesc'] = 'Number of slides on the slider between {$a->lower} and {$a->upper}.';
$string['slideno'] = 'Slide {$a->slide}';
$string['slidenodesc'] = 'Enter the settings for slide {$a->slide}.';
$string['slidetitle'] = 'Slide title';
$string['slidetitledesc'] = 'Enter a descriptive title for your slide';
$string['slideimage'] = 'Slide image';
$string['slideimagedesc'] = 'Image works best if it is transparent.';
$string['slidecaption'] = 'Slide caption';
$string['slidecaptiondesc'] = 'Enter the caption text to use for the slide';
$string['slidelink'] = 'Slide link';
$string['slidelinkdesc'] = 'Enter the link for the slide';
$string['slidelinktarget'] = 'Slide link target';
$string['slidelinktargetdesc'] = 'State the target for the slide';
$string['slidelinktargetself'] = 'Same window';
$string['slidelinktargetblank'] = 'New window';

// Header.
$string['headersettings'] = 'Header';
$string['headerheadingdesc'] = 'Configure the header settings for the theme here.';

$string['invert'] = 'Invert navbar';
$string['invertdesc'] = 'Swaps text and background for the navbar at the top of the page between black and white.';

$string['pageheadinglocationnavbar'] = 'Navbar';
$string['pageheadinglocationunderneathnavbar'] = 'Underneath the navbar';
$string['pageheadinglocationheaderarea'] = 'Header area';
$string['pageheadinglocationpagecontenttop'] = 'Top of page content';

$string['coursepagepageheadinglocation'] = 'Course and category page \'page heading\' location';
$string['coursepagepageheadinglocationdesc'] = 'Where to put the page heading on course and category pages.';

$string['showsysteminbreadcrumb'] = 'Show system area name in the breadcrumb';
$string['showsysteminbreadcrumbdesc'] = 'Show the system area name in the breadcrumb.';

$string['showsectioninbreadcrumb'] = 'Show section name in the breadcrumb';
$string['showsectioninbreadcrumbdesc'] = 'Show the section name in the breadcrumb when viewing an activity or resource.';

$string['headerimage'] = 'Header image representing the corporate design';
$string['headerlogo'] = 'Header logo representing the corporate design';

// Course settings.
$string['coursesettingsheadingsetting'] = 'Course settings';
$string['showsettingsincoursesetting'] = 'In course settings menu';
$string['showsettingsincoursesetting_desc'] = 'With this setting you can change the displaying of the context menus.  In Boost, there is a popup context menu right next to the cog icon.  By enabling this setting the settings will occur directly beneath the course header.  The settings are arranged in tabs, so it is easier for the user to get to the desired setting instead of scanning a long list of menu items. With this setting we also hide the settings icon on the participants page as the entries on this page are duplicated with the in-course course menu and therefore not necessary.<br/>
Please note that this change does not affect users who have switched off javascript in their browsers - they will still get the behaviour from Moodle core with a popup course context menu.';
$string['incoursesettingsswitchtorolepositionsetting'] = '"Switch role to..." location(s)';
$string['incoursesettingsswitchtorolesettingjustmenu'] = 'Just in the user menu';
$string['incoursesettingsswitchtorolesettingjustcourse'] = 'Just in the course settings';
$string['incoursesettingsswitchtorolesettingboth'] = 'In both places: in the user menu and in the course settings';
$string['incoursesettingsswitchtorolepositionsetting_desc'] = 'With this setting you can choose the place where the information to which role a user has switched is being displayed.  If set to \'Just in the user menu\' (default value), the role information will be displayed right beneath the user\'s name in the user menu (like in theme Boost).  If set to \'Just in the course settings\', this information - together with a link to switch back - will be displayed beneath the course, as this functionality is course related.  If set to \'Both in the user menu and in the course settings\' it will be shown in both places.';
$string['numcourseblocks'] = 'Maximum number of blocks per row in the course';
$string['numcourseblocksdesc'] = 'The maximum blocks per row in the course';
$string['switchroleto'] = 'Switch role to';

// Frontpage header.
$string['frontpageheadersettings'] = 'Front page';
$string['frontpageheadersettings_desc'] = 'Front page header settings.';

$string['usefrontpageheader'] = 'Use frontpage header for all pages';
$string['usefrontpageheaderdesc'] = 'Use the front page header on all pages.';

$string['frontpagelayout'] = 'Layout';
$string['frontpagelayoutdesc'] = 'Logo on top or to the side as set by the logo position.';
$string['layoutontop'] = 'On top';
$string['layoutonside'] = 'Side';

$string['frontpagelogo'] = 'Logo';
$string['frontpagelogodesc'] = 'Please upload your custom logo here for the header.  The logo and background must be the same height.  For the \'On top\' layout, the background should be have a width of {$a->pagewidthmax}px, the logo can be any width.  For the \'Side\' layout, the logo and background should have a combined width of {$a->pagewidthmax}px.';

$string['frontpageresponsivelogo'] = 'Logo for small devices';
$string['frontpageresponsivelogodesc'] = 'Please upload your custom logo here for the header on small devices.  The logo and background must be the same height.  For the \'On top\' layout, the background should be have a width of 960px, the logo can be any width.  For the \'Side\' layout, the logo and background should have a combined width of 960px.';

$string['frontpagelogoposition'] = 'Logo position';
$string['frontpagelogopositiondesc'] = 'Set the logo position.';

$string['frontpagebackgroundimage'] = 'Background image';
$string['frontpagebackgroundimagedesc'] = 'Please upload your custom background image here for the header.  The logo and background must be the same height.  For the \'On top\' layout, the background should be have a width of {$a->pagewidthmax}px, the logo can be any width.  For the \'Side\' layout, the logo and background should have a combined width of {$a->pagewidthmax}px.';

$string['frontpageresponsivebackgroundimage'] = 'Background image for small devices';
$string['frontpageresponsivebackgroundimagedesc'] = 'Please upload your custom background image here for the header on small devices.  The logo and background must be the same height.  For the \'On top\' layout, the background should be have a width of 960px, the logo can be any width.  For the \'Side\' layout, the logo and background should have a combined width of 960px.';

$string['frontpagepageheadinglocation'] = 'Frontpage page heading location';
$string['frontpagepageheadinglocationdesc'] = 'Where to put the page heading on the frontpage.';

// Course category settings on the header settings page.
$string['coursecategoryhavecustomheaderheader'] = 'Select the categories that you want to create a custom header for';
$string['coursecategoryhavecustomheaderheader_desc'] = 'After selecting the categories, edit the header in the settings page \'category headers\'.';

$string['coursecategoryhavecustomheader'] = 'Use custom header for the category \'{$a->categoryname}\'';
$string['coursecategoryhavecustomheaderdesc'] = 'Have a custom header for the category \'{$a->categoryname}\'.';

// Course category header.
$string['coursecategoryheadersettings'] = 'Category headers';
$string['coursecategoryheadersettings_desc'] = 'In order to create custom category headers, please select the categories you want to customise in "Header" settings.  Right now these categories have been selected for customisation:';

$string['coursecategoryhavecustomheadernone'] = 'No categories selected.';

$string['coursecategoryheading'] = 'Course category: {$a->categoryname}';

$string['coursecategorybgcolour'] = 'Background colour';
$string['coursecategorybgcolourdesc'] = 'Course category {$a->categoryname} background colour.';

$string['coursecategorylayout'] = 'Layout';
$string['coursecategorylayoutdesc'] = 'Logo on top or to the side as set by the logo position.';

$string['coursecategorylogo'] = 'Logo';
$string['coursecategorylogodesc'] = 'Please upload your custom logo here for the header.  The logo and background must be the same height.  For the \'On top\' layout, the background should be have a width of {$a->pagewidthmax}px, the logo can be any width.  For the \'Side\' layout, the logo and background should have a combined width of {$a->pagewidthmax}px.';

$string['coursecategoryresponsivelogo'] = 'Logo for small devices';
$string['coursecategoryresponsivelogodesc'] = 'Please upload your custom logo here for the header on small devices.  The logo and background must be the same height.  For the \'On top\' layout, the background should be have a width of 960px, the logo can be any width.  For the \'Side\' layout, the logo and background should have a combined width of 960px.';

$string['coursecategorylogoposition'] = 'Logo position';
$string['coursecategorylogopositiondesc'] = 'Set the logo position.';

$string['coursecategorybackgroundimage'] = 'Background image';
$string['coursecategorybackgroundimagedesc'] = 'Please upload your custom background image here for the header.  The logo and background must be the same height.  For the \'On top\' layout, the background should be have a width of {$a->pagewidthmax}px, the logo can be any width.  For the \'Side\' layout, the logo and background should have a combined width of {$a->pagewidthmax}px.';

$string['coursecategoryresponsivebackgroundimage'] = 'Background image on small devicess';
$string['coursecategoryresponsivebackgroundimagedesc'] = 'Please upload your custom background image here for the header on small devices.  The logo and background must be the same height.  For the \'On top\' layout, the background should be have a width of 960px, the logo can be any width.  For the \'Side\' layout, the logo and background should have a combined width of 960px.';

// Image positions.
$string['imageleft'] = 'Left';
$string['imageright'] = 'Right';

// Forum header colour.
$string['forumheadertextcolour'] = 'Forum header text colour';
$string['forumheadertextcolourdesc'] = 'Set the forum header text colour.';

// Footer.
$string['footersettings'] = 'Footer';
$string['footerheadingdesc'] = 'Configure the footer settings for the theme here.';

$string['numfooterblocks'] = 'Maximum number of blocks per row in the footer';
$string['numfooterblocksdesc'] = 'The maximum blocks per row in the footer';

$string['one'] = 'One';
$string['two'] = 'Two';
$string['three'] = 'Three';
$string['four'] = 'Four';

$string['footnote'] = 'Footnote';
$string['footnotedesc'] = 'Whatever you add to this textarea will be displayed in the footer throughout your Moodle site.';

// Social links settings.
$string['numberofsociallinks'] = 'Number of social network links';
$string['numberofsociallinks_desc'] = 'Number of social network links you want to add.';
$string['socialheading'] = 'Social networking';
$string['socialheadingsub'] = 'Gather followers with social networking';
$string['socialheadingdesc'] = "Provide direct links to your social networks.  To change the number of social networks change the 'Number of social network links' below and save the page to update.";
$string['socialnetworklink'] = 'Social network link ';
$string['socialnetworklink_desc'] = 'Social network link number ';
$string['socialnetworkicon'] = 'Social network icon ';
$string['socialnetworkicon_desc'] = 'Social network icon number ';

// This is admin_setting_configinteger.
$string['asconfigintlower'] = '{$a->value} is less than the lower range limit of {$a->lower}';
$string['asconfigintupper'] = '{$a->value} is greater than the upper range limit of {$a->upper}';

// Forum.
$string['forumsettings'] = 'Forum general';
$string['forumsettingsdesc'] = 'Configure the general forum settings for the theme here.';
$string['forumhtmlemailheader'] = 'Forum html email header';
$string['forumhtmlemailheaderdesc'] = 'Configure the forum html email header for the theme here.';
$string['forumhtmlemailfooter'] = 'Forum html email footer';
$string['forumhtmlemailfooterdesc'] = 'Configure the forum html email footer for the theme here.';
$string['forumcustomtemplate'] = 'Use a pretty template for forum mails';
$string['forumcustomtemplatedesc'] = 'Enable that in order to use a pretty template for sending forum mails. Put an image in the header section of max-width 300px. If not enabled standard formatting of forum mails will be used.';

// File store.
$string['filestoresettings'] = 'File store';
$string['filestoresettingsdesc'] = 'Configure the file store settings for the theme here.  Save changes to see am update to the number / file URL in the setting\'s description.  Note: It is essential when changing the file of a setting that the filename changes to one not used before in that setting in order to ensure that the browser gets the changed version.';
$string['numberoffiles'] = 'Number of files';
$string['numberoffilesdesc'] = 'Set the number of files here between {$a->lower} and {$a->upper}.';
$string['campusfile'] = 'File {$a}';
$string['campusnofile'] = 'No file stored.';
$string['campusfilestored'] = 'File URL: {$a}';

// Privacy.
$string['privacy:note'] = 'The Campus theme stores has settings that pertain to its configuration.  It also may inherit settings and user preferences from the parent Boost theme, please examine the \'Plugin privacy compliance registry\' for \'Boost\' for details.  For the settings, it is your responsibility to ensure that no user data is entered in any of the free text fields.  Setting a setting will result in that action being logged within the core Moodle logging system against the user whom changed it, this is outside of the themes control, please see the core logging system for privacy compliance for this.  When uploading images, you should avoid uploading images with embedded location data (EXIF GPS) included or other such personal data.  It would be possible to extract any location / personal data from the images.  Please examine the code carefully to be sure that it complies with your interpretation of your privacy laws.  I am not a lawyer and my analysis is based on my interpretation.  If you have any doubt then remove the theme forthwith.';
$string['privacy:closed'] = 'Closed';
$string['privacy:open'] = 'Open';
$string['privacy:metadata:preference:draweropenindex'] = 'The state of the course index.';
$string['privacy:request:preference:draweropenindex'] = 'The user preference "{$a->name}" has the value "{$a->value}" which represents "{$a->decoded}" for the state of the course index.';
$string['privacy:metadata:preference:draweropenblock'] = 'The state of the block drawer.';
$string['privacy:request:preference:draweropenblock'] = 'The user preference "{$a->name}" has the value "{$a->value}" which represents "{$a->decoded}" for the state of the block drawer.';
$string['privacy:metadata:preference:draweropennav'] = 'The state of the drawer menu navigation.';
$string['privacy:request:preference:draweropennav'] = 'The user preference "{$a->name}" has the value "{$a->value}" which represents "{$a->decoded}" for the state of the drawer menu navigation.';
