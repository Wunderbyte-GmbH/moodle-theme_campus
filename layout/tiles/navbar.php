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
$logininfoheader = (!isset($PAGE->theme->settings->showlogininfoheader)) ? true : $PAGE->theme->settings->showlogininfoheader;
$navbarclasses = $html->navbarclass;
if (!empty($hdfancynavbar)) {
    $navbarclasses .= ' iamfancy';
}
?>
<header class="campusnavbar navbar navbar-static-top<?php echo $navbarclasses ?>">
    <nav class="navbar-inner">
        <div class="container-fluid">
            <?php echo $OUTPUT->page_heading(); ?>
            <?php echo $OUTPUT->navbar_button(); ?>
            <ul class="nav pull-right">
            <?php echo $OUTPUT->gotobottom_menu(); ?>
            <?php echo $OUTPUT->navbar_plugin_output(); ?>
            <?php if ($logininfoheader) { ?>
                <li class="usermenu"><?php echo $OUTPUT->custom_menu_user() ?></li>
            <?php } ?>
            <?php echo $OUTPUT->header_toggle_menu(); ?>
            </ul>
            <div class="campusnav nav-collapse collapse">
                <?php echo $OUTPUT->custom_menu(); ?>
                <?php echo $OUTPUT->user_menu(); ?>
                <ul class="nav pull-right">
                    <li><?php echo $OUTPUT->search_box(); ?></li>
                    <li><?php echo $OUTPUT->page_heading_menu(); ?></li>
                </ul>
            </div>
        </div>
    </nav>
</header>
