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
 * Campus theme.
 *
 * @package    theme
 * @subpackage campus
 * @copyright  &copy; 2014-onwards G J Barnard in respect to modifications of the Clean theme.
 * @copyright  &copy; 2014-onwards Work undertaken for David Bogner of Edulabs.org.
 * @author     G J Barnard - {@link http://moodle.org/user/profile.php?id=442195}
 * @author     Based on code originally written by Mary Evans, Bas Brands, Stuart Lamour and David Scotson.
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();
?>
    <div class="row-fluid">
<a href="/" class="col-md-4 frontblock fb-1">

<span class="fb-title"><span>Info</span></span>
<span class="fb-content"><span>&Uuml;berblick - kurz zusammengefasst - und rechtliche Grundlagen</span></span>
</a>

<a href="/course/view.php?id=3" class="col-md-4  frontblock fb-2">
    <span class="fb-title"><span>Veran-<br> staltungen</span></span>
<span class="fb-content"><span>Lehrveranstaltungen der P&auml;dagogischen Hochschulen, passend zur Nachqualifizierung</span></span>
</a>

<a href="/course/view.php?id=7" class="col-md-4  frontblock fb-3">
<span class="fb-title"><span>Hilfe <br> FAQ</span></span>
<span class="fb-content"><span>Anleitungen und Hilfestellungen zum Nachqualifizierungsprozess</span></span>
</a>
</div>

<div class="row-fluid">
<a href="/course/view.php?id=5" class="col-md-4 frontblock fb-4">
<span class="fb-title"><span>Einreichung</span></span>
<span class="fb-content"><span>Links zu den einzelnen PHs um den Antrag einzureichen</span></span>
</a>



<a href="/course/view.php?id=6" class="col-md-4 frontblock fb-5">
    <span class="fb-title"><span>Kompetenz-<br> portfolio</span></span>
<span class="fb-content"><span>Erstellung des pers&ouml;nlichen Kompetenzportfolios mittels Onlineformular</span></span>
</a>

<a href="/course/view.php?id=4" class="col-md-4 frontblock fb-6">
<span class="fb-title"><span>Kontakt</span></span>
<span class="fb-content"><span>Hier erreichen Sie das zentrale Support-Team und ExpertInnen</span></span>
</a>
</div>
<header id="page-header" class="row-fluid">
    <div id="page-navbar" class="d-flex flex-wrap col-12">
        <nav class="breadcrumb-nav"><?php echo $OUTPUT->navbar(); ?></nav>
        <div class="breadcrumb-button ml-auto d-flex"><?php echo $OUTPUT->page_heading_button(); ?></div>
    </div>
    <?php
    if ($OUTPUT->using_frontpage_header_on_another_page()) {
        if (\theme_campus\toolbox::get_setting('frontpagepageheadinglocation') == 2) {
            echo $OUTPUT->get_page_heading();
        }
    }
    echo $html->heading;
    echo $OUTPUT->incourse_settings();
    ?>
    <div id="course-header" class="col-12">
        <?php echo $OUTPUT->course_header(); ?>
    </div>
</header>

<?php
// Note: $numberofslides established in the header file as pulled in by $OUTPUT->get_header_file() if there are any.
if ((!empty($numberofslides)) && (\theme_campus\toolbox::get_setting('sliderposition') == 1)) {
    require_once(dirname(__FILE__).'/slideshow.php');
}
?>
