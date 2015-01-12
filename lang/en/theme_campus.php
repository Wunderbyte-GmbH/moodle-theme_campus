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

// Navbar.
$string['gotobottom'] = 'Go to the bottom of the page';

// Anti-gravity.
$string['antigravity'] = 'Back to top';

// Settings.
// General settings.
$string['genericsettings'] = 'General';
$string['generalheadingsub'] = 'General settings';
$string['generalheadingdesc'] = 'Configure the general settings for the theme here.';

$string['alternateloginurl'] = 'Alternative login URL.';
$string['alternateloginurldesc'] = 'Alternative login URL.';

$string['hidelocallogin'] = 'Hide local login';
$string['hidelocallogindesc'] = 'Hide the local login on login page.  NOTE: Only enable this if all users are remote.';

$string['showlogininfoheader'] = 'Display header login link';
$string['showlogininfoheaderdesc'] = 'Display the login link in the header.';

$string['showlogininfofooter'] = 'Display footer login link';
$string['showlogininfofooterdesc'] = 'Display the login link in the footer.';

$string['cdnfonts'] = 'Content delivery network fonts';
$string['cdnfontsdesc'] = 'Use content delivery network fonts.';

$string['sliderposition'] = 'Slider position';
$string['sliderpositiondesc'] = 'Position of the slider on the page.';
$string['sliderpositionheader'] = 'Underneath the navbar';
$string['sliderpositionpage'] = 'With the page content';

$string['customcss'] = 'Custom CSS';
$string['customcssdesc'] = 'Whatever CSS rules you add to this textarea will be reflected in every page, making for easier customization of this theme.';

// Look and feel settings.
$string['landfsettings'] = 'Look and feel';
$string['landfheadingsub'] = 'Look and feel settings';
$string['landfheadingdesc'] = 'Configure the look and feel settings for the theme here.';

$string['themelayout'] = 'Theme layout';
$string['themelayoutdesc'] = 'Set the theme layout.  Choose from one of: three columns, three column front page and blocks left two columns elsewhere, three column front page and blocks right two columns elsewhere, blocks left two columns and blocks right two columns';
$string['themelayoutthreecolumns'] = 'Three columns';
$string['themelayoutthreecolumnsfplefttwo'] = 'Three column front page and two columns with blocks left elsewhere';
$string['themelayoutthreecolumnsfprighttwo'] = 'Three column front page and two columns with blocks right elsewhere';
$string['themelayoutlefttwocolumns'] = 'Two columns with blocks on the left';
$string['themelayoutrighttwocolumns'] = 'Two columns with blocks on the right';

$string['textcolour'] = 'Text colour';
$string['textcolourdesc'] = 'Set the text colour.';

$string['headingcolour'] = 'Heading colour';
$string['headingcolourdesc'] = 'Set the heading colour.';

$string['navbartextcolour'] = 'Navbar text colour';
$string['navbartextcolourdesc'] = 'Set the navigation bar text colour.';

$string['blockheadingcolour'] = 'Block heading colour';
$string['blockheadingcolourdesc'] = 'Set the block heading colour.';

$string['blockbackgroundcolour'] = 'Block background colour';
$string['blockbackgroundcolourdesc'] = 'Set the block background colour.';

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
$string['carouselsettings']= 'Carousel';
$string['carouselsettings_desc']= 'Carousel settings.';

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

// Header.
$string['headersettings'] = 'Header';
$string['headerheadingsub'] = 'Header settings';
$string['headerheadingdesc'] = 'Configure the header settings for the theme here.';

$string['showpageheading'] = 'Display page heading';
$string['showpageheadingdesc'] = 'Display the page heading.';

$string['invert'] = 'Invert navbar';
$string['invertdesc'] = 'Swaps text and background for the navbar at the top of the page between black and white.';

// Frontpage header.
$string['frontpagesettings']= 'Front page';
$string['frontpagesettings_desc']= 'Front page settings.';

$string['usefrontpageheader'] = 'Use frontpage header for all pages';
$string['usefrontpageheaderdesc'] = 'Use the front page header on all pages.';

$string['frontpagelayout'] = 'Layout';
$string['frontpagelayoutdesc'] = 'Logo on top or to the side as set by the logo position.';
$string['frontpagelayoutontop']= 'On top';
$string['frontpagelayoutonside']= 'Side';

$string['frontpagelogo'] = 'Logo';
$string['frontpagelogodesc'] = 'Please upload your custom logo here for the header.';

$string['frontpagelogoposition'] = 'Logo position';
$string['frontpagelogopositiondesc'] = 'Set the logo position.';

$string['frontpagebackgroundimage'] = 'Background image';
$string['frontpagebackgroundimagedesc'] = 'Please upload your custom background image here for the header.';

$string['frontpagebackgroundposition'] = 'Background position';
$string['frontpagebackgroundpositiondesc'] = 'Set the background position.';

// Course category header.
$string['coursecategorysettings']= 'Course category';
$string['coursecategorysettings_desc']= 'Course category settings.';

$string['coursecategoryheading']= 'Course category: {$a->categoryname}';
$string['coursecategoryheading_desc']= 'Course category settings.';

$string['coursecategorybgcolour']= 'Background colour';
$string['coursecategorybgcolourdesc']= 'Course category {$a->categoryname} background colour.';

// Image positions.
$string['imageleft']= 'Left';
$string['imageright']= 'Right';

// Footer.
$string['footersettings'] = 'Footer';
$string['footerheadingsub'] = 'Footer settings';
$string['footerheadingdesc'] = 'Configure the footer settings for the theme here.';

$string['numfooterblocks'] = 'Maximum number of blocks per row in the footer';
$string['numfooterblocksdesc'] = 'The maximum blocks per row in the footer';

$string['one'] = 'One';
$string['two'] = 'Two';
$string['three'] = 'Three';
$string['four'] = 'Four';

$string['footnote'] = 'Footnote';
$string['footnotedesc'] = 'Whatever you add to this textarea will be displayed in the footer throughout your Moodle site.';

// admin_setting_configinteger.
$string['asconfigintlower'] = '{$a->value} is less than the lower range limit of {$a->lower}';
$string['asconfigintupper'] = '{$a->value} is greater than the upper range limit of {$a->upper}';
