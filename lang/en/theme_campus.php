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
 * @author     G J Barnard - gjbarnard at gmail dot com and {@link http://moodle.org/user/profile.php?id=442195}
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

$string['region-side-post'] = 'Right';
$string['region-side-pre'] = 'Left';
$string['region-footer'] = 'Footer';

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

// Login custom menu.
$string['mygrades'] = 'My grades';
$string['coursegrades'] = 'Course grades';

// Login custom menu depreciated.
$string['blogpreferences'] = 'Blog preferences';
$string['badgepreferences'] = 'Badge preferences';
$string['messagepreferences'] = 'Message preferences';

// Anti-gravity.
$string['antigravity'] = 'Back to top';

// Fullscreen toggle.
$string['fullscreentoggle'] = 'Fullscreen toggle';
$string['fullscreentoggleicon'] = 'Fullscreen toggle icon';

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

$string['showheadertoggle'] = 'Display button for fullscreen mode';
$string['showheadertoggledesc'] = 'Display the button to hide / show the full screen.';

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

$string['themelayout'] = 'Theme layout';
$string['themelayoutdesc'] = 'Set the theme layout.  Choose from one of: three columns, three column front page and blocks left two columns elsewhere, three column front page and blocks right two columns elsewhere, blocks left two columns and blocks right two columns.';
$string['themelayoutthreecolumns'] = 'Three columns';
$string['themelayoutthreecolumnsfplefttwo'] = 'Three column front page and two columns with blocks left elsewhere';
$string['themelayoutthreecolumnsfprighttwo'] = 'Three column front page and two columns with blocks right elsewhere';
$string['themelayoutlefttwocolumns'] = 'Two columns with blocks on the left';
$string['themelayoutrighttwocolumns'] = 'Two columns with blocks on the right';

$string['textcolour'] = 'Text colour';
$string['textcolourdesc'] = 'Set the text colour.';

$string['linkcolour'] = 'Link text colour';
$string['linkcolourdesc'] = 'Set the link text colour.';

$string['contentcolour'] = 'Content colour';
$string['contentcolourdesc'] = 'Set the content colour.';

$string['iconcoloursetting'] = 'Use icon colour setting';
$string['iconcoloursetting_desc'] = 'Use the icon colour setting for the icons.  The icon colour functionality is new.  If you experience problems with it, then turn it off and run \'grunt svg\' on the Node.js command prompt.  Please see \'Gruntfile.js\' for full details.';

$string['iconcolour'] = 'Icon colour';
$string['iconcolour_desc'] = 'The colour for the icons.';

$string['headingcolour'] = 'Heading colour';
$string['headingcolourdesc'] = 'Set the heading colour.';

$string['navbartextcolour'] = 'Navbar text colour';
$string['navbartextcolourdesc'] = 'Set the navigation bar text colour.';

$string['navbarlinkcolour'] = 'Navbar link colour';
$string['navbarlinkcolourdesc'] = 'Set the navigation bar link colour.';

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

$string['wellbackgroundcolour'] = '\'Well\' background colour';
$string['wellbackgroundcolourdesc'] = 'Set the background colour for the \'wells\' which are boxes used in things like the question text and current topic boxes.  Please ensure that the colour chosen works well with the text colour.';

$string['alertinfotextcolour'] = 'Alert info text colour';
$string['alertinfotextcolourdesc'] = 'Set the text colour for the alert information box.';

$string['alertinfobackgroundcolour'] = 'Alert info background colour';
$string['alertinfobackgroundcolourdesc'] = 'Set the background colour for the alert information box.';

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

$string['stickynavbar'] = 'Sticky navbar';
$string['stickynavbardesc'] = 'Have a sticky navbar.  Note: The front page and course catetgory have separate settings.';

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

// Frontpage header.
$string['frontpageheadersettings'] = 'Front page';
$string['frontpageheadersettings_desc'] = 'Front page header settings.';

$string['usefrontpageheader'] = 'Use frontpage header for all pages';
$string['usefrontpageheaderdesc'] = 'Use the front page header on all pages.';

$string['frontpagelayout'] = 'Layout';
$string['frontpagelayoutdesc'] = 'Logo on top or to the side as set by the logo position.';
$string['layoutontop'] = 'On top';
$string['layoutonside'] = 'Side';

$string['frontpagestickynavbar'] = 'Sticky navbar';
$string['frontpagestickynavbardesc'] = 'Have a sticky navbar.  Note: This overrides the header sticky navbar setting above for other pages if \'use front page header on all pages\' is set.';

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

$string['coursecategorystickynavbar'] = 'Sticky navbar';
$string['coursecategorystickynavbardesc'] = 'Have a sticky navbar for category \'{$a->categoryname}\'.  Note: This overrides the header / front page sticky navbar setting on the \'Header\' settings page.';

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

// Forum header.
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

// admin_setting_configinteger.
$string['asconfigintlower'] = '{$a->value} is less than the lower range limit of {$a->lower}';
$string['asconfigintupper'] = '{$a->value} is greater than the upper range limit of {$a->upper}';
