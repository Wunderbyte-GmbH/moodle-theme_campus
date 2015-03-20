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

if (($hdresponsivelogo) && ($hdresponsivebackgroundimage)) {
    // Responsive images available.
    $hdresponsive = true;
} else {
    $hdresponsive = false;
}

if ((!$hdflexlayout) && (!$hdlogo)) {
    $hdextra = ' sitename';
} else {
    $hdextra = '';
}

echo '<div id="page-header" class="'.$hdtype.'">';
echo '<div class="container">';

global $CFG;
if ($hdlogoextrapos == 1) {
    echo '<div class="logotitle headertoggled'.$hdextra.'">';
    if ($hdlogo) {
        echo '<a href="'.$CFG->wwwroot.'">';
        echo '<img class="campuslogodesktop" src="'.$hdlogo.'">';
        if ($hdresponsive) {
            echo '<img class="campuslogosmalldevice" src="'.$hdresponsivelogo.'">';
        }
        echo '</a>';
    } else {
        echo '<a href="'.$CFG->wwwroot.'"><h1>'.$SITE->shortname.'</h1></a>';
    }
    echo '</div>';
}
echo '<div class="backgroundcontainer '.$hdbackgroundextra.'">'; // Need the container regardless if there is a background image or not.  This is for the 'sitename'.
if ($hdbackgroundimage) {
    echo '<img class="campusdesktop headertoggled" src="'.$hdbackgroundimage.'">';
    if ($hdresponsive) {
        echo '<img class="campussmalldevice" src="'.$hdresponsivebackgroundimage.'">';
    }
    if ($hdfancynavbar) {
        include(dirname(__FILE__).'/navbar.php');
    }
}
$showpageheading = (!isset($PAGE->theme->settings->showpageheading)) ? true : $PAGE->theme->settings->showpageheading;
if (($showpageheading) && ($hdlogo)) {
    echo '<div class="sitename headertoggled"><a href="'.$CFG->wwwroot.'"><h1>'.$SITE->shortname.'</h1></a></div>';
}
echo '</div>';
if ($hdlogoextrapos == 2) {
    echo '<div class="logotitle headertoggled">';
    if ($hdlogo) {
        echo '<a href="'.$CFG->wwwroot.'">';
        echo '<img class="campuslogodesktop" src="'.$hdlogo.'">';
        if ($hdresponsive) {
            echo '<img class="campuslogosmalldevice" src="'.$hdresponsivelogo.'">';
        }
        echo '</a>';
    } else {
        echo '<a href="'.$CFG->wwwroot.'"><h1>'.$SITE->shortname.'</h1></a>';
    }
    echo '</div>';
}
echo '</div></div>';

include(dirname(__FILE__).'/navbar.php');
