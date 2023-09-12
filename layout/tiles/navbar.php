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

defined('MOODLE_INTERNAL') || die();

$logininfoheader = (!isset($PAGE->theme->settings->showlogininfoheader)) ? true : $PAGE->theme->settings->showlogininfoheader;
$navbarclasses = $html->navbarclass;
if (!empty($hdfancynavbar)) {
    $navbarclasses .= ' iamfancy';
}

$navbarcontext = new stdClass;
$navbarcontext->output = $OUTPUT;
$navbarcontext->logininfoheader = $logininfoheader;
$navbarcontext->navbarclasses = $navbarclasses;
if (\theme_campus\toolbox::has_incourse_settings()) {
    $actionsmenustr = get_string('actionsmenu');
    $settingsmenu = '<div id="campus-course-settings-toggle" type="button" data-toggle="modal" data-target="#campus-course-settings">';
    $settingsmenu .= '<i class="icon fa fa-cog fa-fw" title="'.$actionsmenustr.'" aria-label="'.$actionsmenustr.'">';
    $settingsmenu .= '<span class="sr-only">'.$actionsmenustr.'</span></i></div>';
} else {
    $settingsmenu = $OUTPUT->context_header_settings_menu();
}
$navbarcontext->settingsmenu = $settingsmenu;

echo $OUTPUT->render_from_template('theme_campus/navbar', $navbarcontext);
