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

$pre = 'side-pre';
$post = 'side-post';
$rtl = right_to_left(); // Used later on in slider.
if ($rtl) {
    $regionbsid = 'region-bs-main-and-post';
    // In RTL the sides are reversed, so swap the 'campusblocks' method parameter....
    $temp = $pre;
    $pre = $post;
    $post = $temp;
} else {
    $regionbsid = 'region-bs-main-and-pre';
}

$hassidepre = (empty($PAGE->layout_options['noblocks']) && $PAGE->blocks->region_has_content('side-pre', $OUTPUT));
$hassidepost = (empty($PAGE->layout_options['noblocks']) && $PAGE->blocks->region_has_content('side-post', $OUTPUT));
$contentclass = 'span8';
$blockclass = 'span4';
$rowclass = 'span9';
if (!($hassidepre AND $hassidepost)) {
    // Two columns.
    $contentclass = 'span9';
    $blockclass = 'span3';
    if (!$PAGE->user_is_editing()) {
        if (((!$hassidepre) && (!$rtl)) ||
            ((!$hassidepost) && ($rtl))) {
            // Fill complete area when editing off and LTR and no side-pre content or RTL and no side-post content.
            $contentclass = 'span12';
        } else if ((!$hassidepre) && ($rtl)) {
            // Fill complete area when editing off, RTL and no side pre.
            $regionclass = 'span12';
        }
    } else {
        if (((!$hassidepre) && ($rtl)) || (($hassidepre) && (!$rtl))) {
            // Fill complete area when editing on, RTL and no side pre.
            // Fill complete area when editing on, LTR and no side post.
            $contentclass = 'span8';
            $blockclass = 'span4';
        }
    }
}

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

<body <?php echo $OUTPUT->body_attributes(); ?>>

<?php
echo $OUTPUT->standard_top_of_body_html();
require_once(dirname(__FILE__).'/tiles/'.$OUTPUT->get_header_file());
?>

<div id="page" class="container-fluid">

    <?php require_once(dirname(__FILE__).'/tiles/page-header_frontpage.php'); ?>

    <div id="page-content" class="row-fluid">
        <div id="<?php echo $regionbsid ?>" class="<?php echo $rowclass; ?>">
            <div class="row-fluid">
                <div id="region-main" class="<?php echo $contentclass; ?> pull-right">
                <?php require_once(dirname(__FILE__).'/tiles/pagebody_slideshow.php'); ?>
                    <section id="region-main-campus" class="row-fluid">
                        <?php
                        if ((!empty($PAGE->theme->settings->frontpagepageheadinglocation)) && ($PAGE->theme->settings->frontpagepageheadinglocation == 3)) {
                            echo $OUTPUT->get_page_heading();
                        }
                        echo $OUTPUT->main_content();
                        ?>
                    </section>
                </div>
                <?php echo $OUTPUT->campusblocks($pre, $blockclass.' desktop-first-column'); ?>
            </div>
        </div>
        <?php echo $OUTPUT->campusblocks($post, 'span3'); ?>
    </div>

    <?php require_once(dirname(__FILE__).'/tiles/footer.php'); ?>

</div>
</body>
</html>
