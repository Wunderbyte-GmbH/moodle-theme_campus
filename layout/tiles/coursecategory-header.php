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

global $CFG, $OUTPUT;
$currentcategory = $OUTPUT->get_current_category();

// Image files.
$coursecategorylogo = $PAGE->theme->setting_file_url('coursecategorylogo'.$currentcategory, 'coursecategorylogo'.$currentcategory);
$coursecategorybackgroundimage = $PAGE->theme->setting_file_url('coursecategorybackgroundimage'.$currentcategory, 'coursecategorybackgroundimage'.$currentcategory);

// Fallback to front page logo if no course category logo.
if (!$coursecategorylogo) {
    $coursecategorylogo = $PAGE->theme->setting_file_url('frontpagelogo', 'frontpagelogo');
    // TODO: Should this happen?  i.e. that if no logo then the background of the front page should be used instead as it matches.
    //$coursecategorybackgroundimage = $PAGE->theme->setting_file_url('frontpagebackgroundimage', 'frontpagebackgroundimage');
}
// Fallback to theme logo if no frontpage logo.
if (!$coursecategorylogo) {
    // Note: Please remeber to set the image dimensions in 'theme_campus_extra_less()' of lib.php.
    if ($logodetails = theme_campus_get_theme_logo()) {
        $coursecategorylogo = $OUTPUT->pix_url($logodetails['name'], 'theme');  // $coursecategorylogo can still be false if 'pix_url' fails for some unknown reason.
    }
}

// Layout.
$coursecategorylayout = 'coursecategorylayout'.$currentcategory;
$coursecategorylayout = (!empty($PAGE->theme->settings->$coursecategorylayout)) ? $PAGE->theme->settings->$coursecategorylayout : 'absolutelayout';
$ccflexlayout = ($coursecategorylayout == 'flexlayout');
if ($ccflexlayout) {
    $ccsettingkey = 'coursecategorylogoposition'.$currentcategory;
    $cclogoextrapos = (!empty($PAGE->theme->settings->$ccsettingkey)) ? $PAGE->theme->settings->$ccsettingkey : 1;
} else {
    $cclogoextrapos = 1; // Absolute layout has markup in the same order regardless of position of logo.
}
if ((!$ccflexlayout) && (!$coursecategorylogo)) {
    $ccextra = ' sitename';
} else {
    $ccextra = '';
}

echo '<div class="coursecategoryheader '.$coursecategorylayout.' category'.$currentcategory.'">';
if ($ccflexlayout) {
    echo '<div class="flexlayoutcontainer">';
}

global $CFG;
if ($cclogoextrapos == 1) {
    echo '<div class="logotitle'.$ccextra.'">';
    if ($coursecategorylogo) {
        if ($ccflexlayout) {
            echo '<a href="'.$CFG->wwwroot.'"><img src="'.$coursecategorylogo.'"></a>';
        } else {
            echo '<a href="'.$CFG->wwwroot.'"><img src="'.$coursecategorylogo.'" class="logoheight img-responsive"></a>';
        }
    } else {
        echo '<a href="'.$CFG->wwwroot.'"><h1>'.$SITE->shortname.'</h1></a>';
    }
    echo '</div>';
}
if ($coursecategorybackgroundimage) {
    if ($ccflexlayout) {
        echo '<div class="backgroundcontainer">';
        echo '<img src="'.$coursecategorybackgroundimage.'">';
        echo '</div>';
    } else {
        echo '<img src="'.$coursecategorybackgroundimage.'" class="backgroundimage img-responsive">';
    }
}
if ($cclogoextrapos == 2) {
    echo '<div class="logotitle">';
    if ($coursecategorylogo) {
        if ($ccflexlayout) {
            echo '<a href="'.$CFG->wwwroot.'"><img src="'.$coursecategorylogo.'"></a>';
        } else {
            echo '<a href="'.$CFG->wwwroot.'"><img src="'.$coursecategorylogo.'" class="logoheight img-responsive"></a>';
        }
    } else {
        echo '<a href="'.$CFG->wwwroot.'"><h1>'.$SITE->shortname.'</h1></a>';
    }
    echo '</div>';
}
$showpageheading = (!isset($PAGE->theme->settings->showpageheading)) ? true : $PAGE->theme->settings->showpageheading;
if (($showpageheading) && ($coursecategorylogo)) {
    echo '<div class="sitename"><a href="'.$CFG->wwwroot.'"><h1>'.$SITE->shortname.'</h1></a></div>';
}
if ($ccflexlayout) {
    echo '</div>';
}
echo '</div>';

require_once(dirname(__FILE__).'/navbar.php');

// Carousel pre-loading.
$currentcoursecategory = $OUTPUT->get_current_category();
$coursecategorycarouselstatus = 'coursecategorycarouselstatus'.$currentcoursecategory;
$coursecategorycarouselstatus = (!empty($PAGE->theme->settings->$coursecategorycarouselstatus)) ? $PAGE->theme->settings->$coursecategorycarouselstatus : 1;  // 1 is 'Draft'.
if ($coursecategorycarouselstatus == 2) { // Only if published.
    $numberofslides = 'numberofslidesforcategory'.$currentcoursecategory;
    $numberofslides = (!empty($PAGE->theme->settings->$numberofslides)) ? $PAGE->theme->settings->$numberofslides : 0;
    $settingprefix = 'coursecategory'.$OUTPUT->get_current_category().'_'; // Cross ref to theme_campus_pluginfile() image serving in lib.php.
}