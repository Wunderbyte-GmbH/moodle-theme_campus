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

$OUTPUT->optional_jquery();
// Get the HTML for the settings bits.
$html = theme_campus_get_html_for_settings($OUTPUT, $PAGE);

echo $OUTPUT->doctype() ?>
<html <?php echo $OUTPUT->htmlattributes(); ?>>
<head>
    <title><?php echo $OUTPUT->page_title(); ?></title>
    <link rel="shortcut icon" href="<?php echo $OUTPUT->favicon(); ?>" />
    <meta name="description" content="<?php p(strip_tags(format_text($SITE->summary, FORMAT_HTML))) ?>" />
    <?php
        echo $OUTPUT->standard_head_html();
    ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body <?php echo $OUTPUT->body_attributes('two-column'); ?>>

<?php
echo $OUTPUT->standard_top_of_body_html();
require_once(dirname(__FILE__).'/tiles/'.$OUTPUT->get_header_file());
?>

<div id="page" class="container-fluid">

    <?php require_once(dirname(__FILE__).'/tiles/page-header_frontpage.php'); ?>

    <div id="page-content" class="row-fluid">
        <div id="region-main" class="col-12">
            <?php
            require_once(dirname(__FILE__).'/tiles/pagebody_slideshow.php');
            ?>
            <section id="region-main-campus">
            <?php
            if (\theme_campus\toolbox::get_setting('frontpagepageheadinglocation') == 3) {
                echo $OUTPUT->get_page_heading();
            }
            echo $OUTPUT->main_content();
            ?>
            </section>
        </div>
    </div>

    <?php
        require_once(dirname(__FILE__).'/tiles/footer.php');
        echo $OUTPUT->standard_after_main_region_html();
    ?>
</div>
</body>
</html>
