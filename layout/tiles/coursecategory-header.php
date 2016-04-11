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

global $OUTPUT;

$currentcategory = $OUTPUT->get_current_top_level_catetgory();

// Image files.
$cchavecustomsetting = 'coursecategoryhavecustomheader'.$currentcategory;
if (!empty($PAGE->theme->settings->$cchavecustomsetting)) {
    $hdlogo = $PAGE->theme->setting_file_url('coursecategorylogo'.$currentcategory, 'coursecategorylogo'.$currentcategory);
    $hdbackgroundimage = $PAGE->theme->setting_file_url('coursecategorybackgroundimage'.$currentcategory, 'coursecategorybackgroundimage'.$currentcategory);
    $hdresponsivelogo = $PAGE->theme->setting_file_url('coursecategoryresponsivelogo'.$currentcategory, 'coursecategoryresponsivelogo'.$currentcategory);
    $hdresponsivebackgroundimage = $PAGE->theme->setting_file_url('coursecategoryresponsivebackgroundimage'.$currentcategory, 'coursecategoryresponsivebackgroundimage'.$currentcategory);
} else {
    $hdlogo = false;
    $hdbackgroundimage = false;
    $hdresponsivelogo = false;
    $hdresponsivebackgroundimage = false;
}

// Fallback to front page logo if no course category logo.
$frontpagesettings = false;
$themesettings = false;
$hdfancynavbar = false;
if ((!$hdlogo) || (!$hdbackgroundimage)) {
    $hdlogo = $PAGE->theme->setting_file_url('frontpagelogo', 'frontpagelogo');

    if ($hdlogo) {
        // Use Frontpage settings.
        $hdbackgroundimage = $PAGE->theme->setting_file_url('frontpagebackgroundimage', 'frontpagebackgroundimage');
        $hdresponsivelogo = $PAGE->theme->setting_file_url('frontpageresponsivelogo', 'frontpageresponsivelogo');
        $hdresponsivebackgroundimage = $PAGE->theme->setting_file_url('frontpageresponsivebackgroundimage', 'frontpageresponsivebackgroundimage');
        $hdlayout = (!empty($PAGE->theme->settings->frontpagelayout)) ? $PAGE->theme->settings->frontpagelayout : 'absolutelayout';
        $hdbackgroundextrapos = (!empty($PAGE->theme->settings->frontpagelogoposition)) ? $PAGE->theme->settings->frontpagelogoposition : 1; // 1 is left and 2 is right.
        $frontpagesettings = true;
    }
}

// Fall back to theme logo and background if no frontpage logo or background and technically if the course category logo or background do not exist too.
if ((!$hdlogo) || (!$hdbackgroundimage)) {
    // Note: Please remeber to set the image dimensions in 'theme_campus_extra_less()' of lib.php.
    if ($logodetails = theme_campus_get_theme_logo()) {
        $hdlogo = $OUTPUT->pix_url($logodetails['name'], 'theme');  // $hdlogo can still be false if 'pix_url' fails for some unknown reason.
    }
    if ($backgrounddetails = theme_campus_get_theme_background()) {
        $hdbackgroundimage = $OUTPUT->pix_url($backgrounddetails['name'], 'theme');  // $hdbackgroundimage can still be false if 'pix_url' fails for some unknown reason.
    }
    // Use theme responsive versions.
    if ($logoresponsivedetails = theme_campus_get_theme_responsive_logo()) {
        $hdresponsivelogo = $OUTPUT->pix_url($logoresponsivedetails['name'], 'theme');  // $hdresponsivelogo can still be false if 'pix_url' fails for some unknown reason.
    }
    if ($backgroundresponsivedetails = theme_campus_get_theme_responsive_background()) {
        $hdresponsivebackgroundimage = $OUTPUT->pix_url($backgroundresponsivedetails['name'], 'theme');  // $hdresponsivebackgroundimage can still be false if 'pix_url' fails for some unknown reason.
    }
    // Fallback to frontpage settings as they are in 'front-pageheader.php' for the theme images.
    $hdlayout = (!empty($PAGE->theme->settings->frontpagelayout)) ? $PAGE->theme->settings->frontpagelayout : 'absolutelayout';
    $hdbackgroundextrapos = (!empty($PAGE->theme->settings->frontpagelogoposition)) ? $PAGE->theme->settings->frontpagelogoposition : 1; // 1 is left and 2 is right.
    $hdlogoextrapos = $hdbackgroundextrapos;

    $themesettings = true;
    $frontpagesettings = true;
}

// Layout only if not using front page or theme fallback.
if ((!$frontpagesettings) && (!$themesettings)) {
    $hdlayout = 'coursecategorylayout'.$currentcategory;
    $hdlayout = (!empty($PAGE->theme->settings->$hdlayout)) ? $PAGE->theme->settings->$hdlayout : 'absolutelayout';
    $ccsettingkey = 'coursecategorylogoposition'.$currentcategory;
    $hdbackgroundextrapos = (!empty($PAGE->theme->settings->$ccsettingkey)) ? $PAGE->theme->settings->$ccsettingkey : 1;
}
// End of fall back section.

$hdflexlayout = ($hdlayout == 'flexlayout');
if ($hdflexlayout) {
    $hdlogoextrapos = $hdbackgroundextrapos;
    $navbartype = (!empty($PAGE->theme->settings->navbartype)) ? $PAGE->theme->settings->navbartype : 1; // 1 is 'Standard'.
    if ($navbartype == 2) { // 2 is 'Fancy'.
        $hdfancynavbar = true;
        $hdlayout .= ' fancynavbar';
    }
} else {
    $hdlogoextrapos = 2; // Absolute layout has to have the logo after the background for the negative margin to work to place the logo on top of the background.
    // Fancy navbar will not work because background is 100% and thus would go underneath the logo.
}

if ($hdbackgroundextrapos == 1) { // Background is an inversion of logo position.  This has to reflect the true value and not that of $hdlogoextrapos because its adjusted for absolute layout.
    $hdbackgroundextra = 'right';
} else {
    $hdbackgroundextra = 'left';
}

if ($frontpagesettings) {
    $hdtype = 'frontpageheader '.$hdlayout;
} else {
    $hdtype = 'coursecategoryheader '.$hdlayout.' category'.$currentcategory;
}

$pageheadinglocationheaderarea = (empty($PAGE->theme->settings->coursepagepageheadinglocation)) ? false : $PAGE->theme->settings->coursepagepageheadinglocation;
require_once(dirname(__FILE__).'/header-tile.php');

if (!$OUTPUT->is_course_page()) {
    // Carousel pre-loading.
    $currentcoursecategory = $currentcategory;
    $coursecategorycarouselstatus = 'coursecategorycarouselstatus'.$currentcoursecategory;
    $coursecategorycarouselstatus = (!empty($PAGE->theme->settings->$coursecategorycarouselstatus)) ? $PAGE->theme->settings->$coursecategorycarouselstatus : 1;  // 1 is 'Draft'.
    if ($coursecategorycarouselstatus == 2) { // Only if published.
        $numberofslides = 'numberofslidesforcategory'.$currentcoursecategory;
        $numberofslides = (!empty($PAGE->theme->settings->$numberofslides)) ? $PAGE->theme->settings->$numberofslides : 0;
        $settingprefix = 'coursecategory'.$currentcoursecategory.'_'; // Cross ref to theme_campus_pluginfile() image serving in lib.php.
    }
}