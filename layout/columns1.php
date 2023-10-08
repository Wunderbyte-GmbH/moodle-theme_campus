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
 * @package    theme_campus
 * @copyright  &copy; 2014-onwards G J Barnard in respect to modifications of the Clean theme.
 * @copyright  &copy; 2014-onwards Work undertaken for David Bogner of Edulabs.org.
 * @author     G J Barnard - {@link http://moodle.org/user/profile.php?id=442195}
 * @author     Based on code originally written by Mary Evans, Bas Brands, Stuart Lamour and David Scotson.
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$OUTPUT->sticky_navbar();
// Get the HTML for the settings bits.
$html = theme_campus_get_html_for_settings($OUTPUT, $PAGE);

echo $OUTPUT->doctype() ?>
<html <?php echo $OUTPUT->htmlattributes(); ?>>
<head>
    <title><?php echo $OUTPUT->page_title(); ?></title>
    <link rel="shortcut icon" href="<?php echo $OUTPUT->favicon(); ?>" />
    <?php
        echo $OUTPUT->standard_head_html();
    ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body <?php echo $OUTPUT->body_attributes(); ?>>

<?php
echo $OUTPUT->standard_top_of_body_html();
require_once(dirname(__FILE__) . '/tiles/' . $OUTPUT->get_header_file());
?>

<div id="page" class="container-fluid">

    <?php
        require_once(dirname(__FILE__) . '/tiles/page-header.php');
    ?>

    <div id="page-content" class="row-fluid">
        <div id="region-main" class="col-12">
            <?php require_once(dirname(__FILE__) . '/tiles/pagebody_slideshow.php'); ?>
            <section id="region-main-campus">
                <?php
                if ($OUTPUT->course_category_header()) {
                    if (\theme_campus\toolbox::get_setting('coursepagepageheadinglocation') == 3) {
                        echo $OUTPUT->get_page_heading();
                    }
                } else if ($OUTPUT->using_frontpage_header_on_another_page()) {
                    if (\theme_campus\toolbox::get_setting('frontpagepageheadinglocation') == 3) {
                        echo $OUTPUT->get_page_heading();
                    }
                }
                $headeractions = $PAGE->get_header_actions();
                if (!empty($headeractions)) {
                    $context = new stdClass();
                    $context->headeractions = $headeractions;
                    echo $OUTPUT->render_from_template('theme_campus/header_actions', $context);
                }

                $secondarynavigation = $OUTPUT->secondarynavigation();
                if ((!is_null($secondarynavigation)) && (!empty($secondarynavigation['secondarynavigation']))) {
                    echo html_writer::start_tag('div', ['id' => 'secondary-navigation', 'class' => 'secondary-navigation d-print-none']);
                    echo $OUTPUT->render_from_template('core/moremenu', $secondarynavigation['secondarynavigation']);
                    echo html_writer::end_tag('div');
                }

                echo $OUTPUT->course_content_header();

                if ((!is_null($secondarynavigation)) && (!empty($secondarynavigation['overflow']))) {
                    echo html_writer::start_tag('div', ['class' => 'container-fluid tertiary-navigation']);
                    echo html_writer::start_tag('div', ['class' => 'navitem']);
                    echo $OUTPUT->render_from_template('core/url_select', $secondarynavigation['overflow']);
                    echo html_writer::end_tag('div');
                    echo html_writer::end_tag('div');
                }

                $header = $PAGE->activityheader;
                $headercontent = $header->export_for_template($OUTPUT);
                if (!empty($headercontent)) {
                    echo $OUTPUT->render_from_template('core/activity_header', $headercontent);
                }

                echo $OUTPUT->main_content();
                echo $OUTPUT->course_content_footer();
                ?>
            </section>
        </div>
    </div>

    <?php
    require_once(dirname(__FILE__) . '/tiles/footer.php');
        echo $OUTPUT->standard_after_main_region_html();
    ?>
</div>
</body>
</html>
