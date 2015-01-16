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

// Image files.
$frontpagelogo = $PAGE->theme->setting_file_url('frontpagelogo', 'frontpagelogo');
$frontpagebackgroundimage = $PAGE->theme->setting_file_url('frontpagebackgroundimage', 'frontpagebackgroundimage');

// Layout.
$frontpagelayout = (!empty($PAGE->theme->settings->frontpagelayout)) ? $PAGE->theme->settings->frontpagelayout : 'absolutelayout';
$fpflexlayout = ($frontpagelayout == 'flexlayout');
$fpfancynavbar = false;
if ($fpflexlayout) {
    $fpcontainer = 'flexlayoutcontainer';
} else {
    $fpcontainer = 'absolutelayoutcontainer';
}

if ($fpflexlayout) {
    $fplogoextrapos = (!empty($PAGE->theme->settings->frontpagelogoposition)) ? $PAGE->theme->settings->frontpagelogoposition : 1;
    $navbartype = (!empty($PAGE->theme->settings->navbartype)) ? $PAGE->theme->settings->navbartype : 1; // 1 is 'Standard'.
    if ($navbartype == 2) { // 2 is 'Fancy'.
        $fpfancynavbar = true;
        $frontpagelayout .= ' fancynavbar';
    }
} else {
    $fplogoextrapos = 1; // Absolute layout has markup in the same order regardless of position of logo.
}
if ((!$fpflexlayout) && (!$frontpagelogo)) {
    $fpextra = ' sitename';
} else {
    $fpextra = '';
}

echo '<div class="frontpageheader '.$frontpagelayout.'">';
echo '<div class="'.$fpcontainer.'">';

global $CFG;
if ($fplogoextrapos == 1) {
    echo '<div class="logotitle'.$fpextra.'">';
    if ($frontpagelogo) {
        if ($fpflexlayout) {
            echo '<a href="'.$CFG->wwwroot.'"><img src="'.$frontpagelogo.'"></a>';
        } else {
            echo '<a href="'.$CFG->wwwroot.'"><img src="'.$frontpagelogo.'" class="logoheight img-responsive"></a>';
        }
    } else {
        echo '<a href="'.$CFG->wwwroot.'"><h1>'.$SITE->shortname.'</h1></a>';
    }
    echo '</div>';
}
echo '<div class="backgroundcontainer">'; // Need the container regardless if there is a background image or not.  This is for the 'sitename'.
if ($frontpagebackgroundimage) {
    if ($fpflexlayout) {
        echo '<img src="'.$frontpagebackgroundimage.'">';
        if ($fpfancynavbar) {
            require_once(dirname(__FILE__).'/navbar.php');
        }
    } else {
        echo '<img src="'.$frontpagebackgroundimage.'" class="backgroundimage img-responsive">';
    }
}
$showpageheading = (!isset($PAGE->theme->settings->showpageheading)) ? true : $PAGE->theme->settings->showpageheading;
if (($showpageheading) && ($frontpagelogo)) {
    echo '<div class="sitename"><a href="'.$CFG->wwwroot.'"><h1>'.$SITE->shortname.'</h1></a></div>';
}
echo '</div>';
if ($fplogoextrapos == 2) {
    echo '<div class="logotitle">';
    if ($frontpagelogo) {
        if ($fpflexlayout) {
            echo '<a href="'.$CFG->wwwroot.'"><img src="'.$frontpagelogo.'"></a>';
        } else {
            echo '<a href="'.$CFG->wwwroot.'"><img src="'.$frontpagelogo.'" class="logoheight img-responsive"></a>';
        }
    } else {
        echo '<a href="'.$CFG->wwwroot.'"><h1>'.$SITE->shortname.'</h1></a>';
    }
    echo '</div>';
}
echo '</div></div>';

if (!$fpfancynavbar) {
    require_once(dirname(__FILE__).'/navbar.php');
}

// Carousel pre-loading if the frontpage.  If otherwise, then need to also alter theme_campus_page_init() in lib.php.
if ($PAGE->pagelayout == 'frontpage') {
    $frontpagecarouselstatus = (!empty($PAGE->theme->settings->frontpagecarouselstatus)) ? $PAGE->theme->settings->frontpagecarouselstatus : 1;  // 1 is 'Draft'.
    if ($frontpagecarouselstatus == 2) { // Only if published.
        $numberofslides = (!empty($PAGE->theme->settings->numberofslidesforfrontpage)) ? $PAGE->theme->settings->numberofslidesforfrontpage : 0;
        $settingprefix = 'frontpage'; // Cross ref to theme_campus_pluginfile() image serving in lib.php.
    }
}
