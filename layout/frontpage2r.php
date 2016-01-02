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
     If we have a 'side-pre' then the blocks are on the right for LTR and left for RTL.
    */
    if ($rtl) {
        $right = false;
    } else {
        $right = true;
    }
} else if ($hassidepost) {
    $useblock = 'side-post';
    /*
     This deals with the side to show the blocks on.
     If we have a 'side-post' then the blocks are on the left for LTR and right for RTL.
    */
    if ($rtl) {
        $right = true;
    } else {
        $right = false;
    }
} else {
    $useblock = false;
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

<body <?php echo $OUTPUT->body_attributes('two-column'); ?>>

<?php
echo $OUTPUT->standard_top_of_body_html();
require_once(dirname(__FILE__).'/tiles/'.$OUTPUT->get_header_file());
?>

<div id="page" class="container-fluid">

    <?php require_once(dirname(__FILE__).'/tiles/page-header_frontpage.php'); ?>

    <div id="page-content" class="row-fluid">
        <?php if ($useblock) { ?>
        <div id="region-main" class="span9<?php if (!$right) { echo ' pull-right'; } ?>">
        <?php } else { ?>
        <div id="region-main" class="span12">
        <?php }
                require_once(dirname(__FILE__).'/tiles/pagebody_slideshow.php');
                ?>
                <section id="region-main-campus" class="row-fluid">
                <?php
                if ((!empty($PAGE->theme->settings->frontpagepageheadinglocation)) && ($PAGE->theme->settings->frontpagepageheadinglocation == 3)) {
                    echo $OUTPUT->get_page_heading();
                }
				?>
				<div id="schnecke" class="">
				<img id="frontpageimage" src="<?php echo $OUTPUT->pix_url('10-2-one', 'theme'); ?>" usemap="#schneckenmap" class="img-responsive" alt="SQA Navigationsschnecke" height="528" width="517">
				<map id="frontpagemap" name="schneckenmap"> 
<area shape="poly" id="area1" class="mapstyle" coords="121,40,209,5,337,12,407,49,332,144,264,123,195,138," href="http://www.sqa.at/course/category.php?id=15" alt="BZG Bilanz- und Zielvereinbarungsgespräch" title="BZG Bilanz- und Zielvereinbarungsgespräch">
 
<area shape="poly" id="area2" class="mapstyle" coords="405,46,449,84,495,149,516,222,389,222,370,180,330,144," href="http://www.sqa.at/course/category.php?id=16" alt="Feedback &amp; Evaluation" title="Feedback &amp; Evaluation">
 
<area shape="poly" id="area3" class="mapstyle" coords="513,224,516,378,393,378,390,222," href="http://www.sqa.at/course/category.php?id=17" alt="Beratung &amp; Begleitung" title="Beratung &amp; Begleitung">
 
<area shape="poly" id="area4" class="mapstyle" coords="393,378,516,377,516,527,393,527," href="http://www.sqa.at/course/category.php?id=14" alt="SQA Leitfaden" title="SQA Leitfaden">
 
<area shape="poly" id="area5" class="mapstyle" coords="393,307,392,516,226,514,228,389,287,392,328,373,378,322," href="http://www.sqa.at/course/category.php?id=6" alt="Bibliothek &amp; Medien" title="Bibliothek &amp; Medien">
 
<area shape="poly" id="area6" class="mapstyle" coords="228,390,228,514,126,484,48,413,19,357,165,356,200,382," href="http://www.sqa.at/course/category.php?id=18" alt="Grundlagen" title="Grundlagen">
 
<area shape="poly" id="area7" class="mapstyle" coords="127,220,126,290,165,357,21,360,1,277,3,219," href="http://www.sqa.at/course/category.php?id=10" alt="Qualität von Schule und Unterricht" title="Qualität von Schule und Unterricht">
 
<area shape="poly" id="area8" class="mapstyle" coords="4,220,126,221,152,175,197,137,125,39,123,37,91,62,29,140,9,192," href="http://www.sqa.at/course/category.php?id=5" alt="Entwicklungsplan" title="Entwicklungsplan">
 
<area shape="poly" id="area9" class="mapstyle" coords="195,141,265,120,330,145,367,179,387,219,393,270,384,315,353,354,307,384,318,377,257,393,207,384,170,360,141,330,123,280,126,221,144,179,173,153," href="http://www.sqa.at/course/category.php?id=7" alt="Lernen &amp; Lehren" title="Lernen &amp; Lehren">
 </map>
 </div>
				<?php
				// Option rmapoption in General settings.
				$rmapoption = (!empty($PAGE->theme->settings->rmapoption)) ? $PAGE->theme->settings->rmapoption : 3;
				if ($rmapoption == 2) {
					$PAGE->requires->js_call_amd('theme_campus/rwdImageMaps', 'init', array());
				} else if ($rmapoption == 3) {
					$PAGE->requires->js_call_amd('theme_campus/campus_imagemapster', 'init', array());
				}
                echo $OUTPUT->main_content();
                ?>
            </section>
        </div>
        <?php
        if ($useblock) {
            $classextra = '';
            if (!$right) {
                $classextra = ' desktop-first-column';
            }
            echo $OUTPUT->campusblocks($useblock, 'span3'.$classextra);
        }
        ?>
    </div>

    <?php require_once(dirname(__FILE__).'/tiles/footer.php'); ?>

</div>
</body>
</html>
