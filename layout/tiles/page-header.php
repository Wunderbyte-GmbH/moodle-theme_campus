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
 * @author     G J Barnard - {@link http://moodle.org/user/profile.php?id=442195}
 * @author     Based on code originally written by Mary Evans, Bas Brands, Stuart Lamour and David Scotson.
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
?>
<header id="page-header" class="clearfix">
    <div id="page-navbar" class="clearfix">
        <nav class="breadcrumb-nav"><?php echo $OUTPUT->navbar(); ?></nav>
        <div class="breadcrumb-button"><?php echo $OUTPUT->page_heading_button(); ?></div>
    </div>
    <?php
    if ($OUTPUT->using_frontpage_header_on_another_page()) {
        if (\theme_campus\toolbox::get_setting('frontpagepageheadinglocation') == 2) {
            echo $OUTPUT->get_page_heading();
        } 
    }
    echo $html->heading; ?>
    <div id="course-header">
        <?php echo $OUTPUT->course_header(); ?>
    </div>
</header>

<?php
// Note: $numberofslides established in the header file as pulled in by $OUTPUT->get_header_file() if there are any.
if ((!empty($numberofslides)) && (\theme_campus\toolbox::get_setting('sliderposition') == 1)) {
    require_once(dirname(__FILE__).'/slideshow.php');
}
