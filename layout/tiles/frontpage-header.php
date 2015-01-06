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

// TEMPORARY TEST CODE.
global $CFG, $OUTPUT;
if (!empty($CFG->campusheader)) {
    echo '<div style="display: none;">TEST CODE: Campus frontpage header: '.$CFG->campusheader.'</div>';
}

// Image files.
$frontpagelogo = $PAGE->theme->setting_file_url('frontpagelogo', 'frontpagelogo');
$frontpagebackgroundimage = $PAGE->theme->setting_file_url('frontpagebackgroundimage', 'frontpagebackgroundimage');
?>

<div class="frontpageheader">
    <div class="logotitle">
    <?php
    if ($frontpagelogo) {
        echo '<img src="'.$frontpagelogo.'" class="frontpagelogoheight img-responsive">';
    } else {
        global $CFG;
        echo '<a href="'.$CFG->wwwroot.'"><h1>'.$SITE->shortname.'</h1></a>';
    }
    ?>
    </div>
    <?php
    $showpageheading = (!isset($PAGE->theme->settings->showpageheading)) ? true : $PAGE->theme->settings->showpageheading;
    if (($showpageheading) && ($frontpagelogo)) {
        echo '<div class="sitename"><a href="'.$CFG->wwwroot.'"><h1>'.$SITE->shortname.'</h1></a></div>';
    }
    if ($frontpagebackgroundimage) {
        echo '<img src="'.$frontpagebackgroundimage.'" class="backgroundimage img-responsive">';
    }
    ?>
</div>

<?php
require_once(dirname(__FILE__).'/navbar.php');
