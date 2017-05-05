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

$OUTPUT->optional_jquery();
// Get the HTML for the settings bits.
$html = theme_campus_get_html_for_settings($OUTPUT, $PAGE);

$rtl = right_to_left();  // To know if to add 'pull-right' and 'desktop-first-column' classes in the layout for LTR.
$hassidepre = $PAGE->blocks->is_known_region('side-pre');
$hassidepost = $PAGE->blocks->is_known_region('side-post');
if ($hassidepre) {
    $useblock = 'side-pre';
    /*
     This deals with the side to show the blocks on.
     If we have a 'side-pre' then the blocks are on the left for LTR and right for RTL.
    */
    if ($rtl) {
        $left = false;
    } else {
        $left = true;
    }
} else if ($hassidepost) {
    $useblock = 'side-post';
    /*
     This deals with the side to show the blocks on.
     If we have a 'side-post' then the blocks are on the right for LTR and left for RTL.
    */
    if ($rtl) {
        $left = true;
    } else {
        $left = false;
    }
} else {
    $useblock = false;
}

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

<body <?php echo $OUTPUT->body_attributes('two-column'); ?>>

<?php
echo $OUTPUT->standard_top_of_body_html();
require_once(dirname(__FILE__).'/tiles/'.$OUTPUT->get_header_file());
?>

<div id="page" class="container-fluid">

    <?php require_once(dirname(__FILE__).'/tiles/page-header.php'); ?>

    <div id="page-content" class="row-fluid">
        <?php if ($useblock) { ?>
        <div id="region-main" class="span9<?php if ($left) { echo ' pull-right'; } ?>">
        <?php } else { ?>
        <div id="region-main" class="span12">
        <?php }
                require_once(dirname(__FILE__).'/tiles/pagebody_slideshow.php');
                ?>
                <section id="region-main-campus" class="row-fluid">
                <?php
                if ($OUTPUT->course_category_header()) {
                    if ((!empty($PAGE->theme->settings->coursepagepageheadinglocation)) &&
                        ($PAGE->theme->settings->coursepagepageheadinglocation == 3)) {
                        echo $OUTPUT->get_page_heading();
                    }
                } else if ($OUTPUT->using_frontpage_header_on_another_page()) {
                    if ((!empty($PAGE->theme->settings->frontpagepageheadinglocation)) && ($PAGE->theme->settings->frontpagepageheadinglocation == 3)) {
                        echo $OUTPUT->get_page_heading();
                    }
                }
                echo $OUTPUT->course_content_header();
                echo $OUTPUT->main_content();
                echo $OUTPUT->course_content_footer();
                ?>
            </section>
        </div>
        <?php
        if ($useblock) {
            $classextra = '';
            if ($left) {
                $classextra = ' desktop-first-column';
            }
            echo $OUTPUT->campussingleblocks('span3'.$classextra);
        }
        ?>
    </div>

    <?php require_once(dirname(__FILE__).'/tiles/footer.php'); ?>

</div>
</body>
</html>
