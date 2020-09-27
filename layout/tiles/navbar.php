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
<header>
    <nav class="campusnavbar navbar navbar-light navbar-static-top<?php echo $navbarclasses ?>">
        <div class="campusnavbarcontainer">
            <?php
                echo $OUTPUT->render_flatnav_button();
                echo $OUTPUT->page_heading();
            ?>
            <ul class="campusnav nav nav-collapse collapse ml-auto">
                <?php echo $OUTPUT->custom_menu(); ?>
                <ul class="nav pull-right">
                    <li><?php echo $OUTPUT->search_box(); ?></li>
                    <li><?php echo $OUTPUT->page_heading_menu(); ?></li>
                </ul>
            </ul>
            <ul class="nav pull-right">
            <?php echo $OUTPUT->gotobottom_menu(); ?>
            <?php echo $OUTPUT->navbar_plugin_output(); ?>
            <?php echo html_writer::tag('li', $OUTPUT->context_header_settings_menu(), array('class' => 'nav-item context-menu')); ?>
            <?php if ($logininfoheader) { ?>
                <li class="nav-item d-flex align-items-center"><?php echo $OUTPUT->user_menu(); ?></li>
            <?php } ?>
            <?php echo $OUTPUT->navbar_button(); ?>
            </ul>
        </div>
    </nav>
</header>
<?php echo $OUTPUT->render_flatnav(); ?>