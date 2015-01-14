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

function theme_campus_process_css($css, $theme) {
    // Set custom CSS.
    if (!empty($theme->settings->customcss)) {
        $customcss = $theme->settings->customcss;
    } else {
        $customcss = null;
    }
    $css = theme_campus_set_customcss($css, $customcss);

    return $css;
}

function theme_campus_set_customcss($css, $customcss) {
    $tag = '[[setting:customcss]]';
    $replacement = $customcss;
    if (is_null($replacement)) {
        $replacement = '';
    }

    $css = str_replace($tag, $replacement, $css);

    return $css;
}

/**
 * Returns variables for LESS.
 *
 * We will inject some LESS variables from the settings that the user has defined
 * for the theme. No need to write some custom LESS for this.
 *
 * Ref: https://docs.moodle.org/dev/Themes_overview#Compiling_LESS_on_the_fly
 *
 * @param theme_config $theme The theme config object.
 * @return array of LESS variables without the @.
 */
function theme_campus_less_variables($theme) {
    $variables = array();
    if (!empty($theme->settings->textcolour)) {
        $variables['textColor'] = $theme->settings->textcolour;
    }
    if (!empty($theme->settings->headingcolour)) {
        $variables['headingColor'] = $theme->settings->headingcolour;
    }
    if (!empty($theme->settings->navbartextcolour)) {
        $variables['navbarText'] = $theme->settings->navbartextcolour;
        $variables['navbarBrandColor'] = $theme->settings->navbartextcolour;
        $variables['navbarLinkColor'] = $theme->settings->navbartextcolour;
    }
    if (!empty($theme->settings->blockheadingcolour)) {
        $variables['blockHeadingColor'] = $theme->settings->blockheadingcolour;
    }
    if (!empty($theme->settings->blockbackgroundcolour)) {
        $variables['wellBackground'] = $theme->settings->blockbackgroundcolour;
    }
    if (!empty($theme->settings->themecolour)) {
        $variables['bodyBackgroundAlt'] = $theme->settings->themecolour;
        $variables['carouselColour'] = $theme->settings->themecolour;
        $variables['carouselActiveColour'] = $theme->settings->themecolour;
    }
    if (!empty($theme->settings->themebackgroundcolour)) {
        $variables['themeBackground'] = $theme->settings->themebackgroundcolour;
    }
    if (!empty($theme->settings->borderradiussmall)) {
        $variables['borderRadiusSmall'] = $theme->settings->borderradiussmall;
    }
    if (!empty($theme->settings->borderradiusmedium)) {
        $variables['baseBorderRadius'] = $theme->settings->borderradiusmedium;
    }
    if (!empty($theme->settings->borderradiuslarge)) {
        $variables['borderRadiusLarge'] = $theme->settings->borderradiuslarge;
    }
    if (!empty($theme->settings->frontpagelogoposition)) {
        switch ($theme->settings->frontpagelogoposition) {
            case 1:
                $variables['frontpageLogoPositionLeft'] = '20px';
                $variables['frontpageSitenamePositionRight'] = '50px';
            break;
            case 2:
                $variables['frontpageLogoPositionRight'] = '20px';
                $variables['frontpageSitenamePositionLeft'] = '50px';
            break;
        }
    }
    if (!empty($theme->settings->frontpagebackgroundposition)) {
        switch ($theme->settings->frontpagebackgroundposition) {
            case 1:
                $variables['frontpageBackgroundPosition'] = 'left';
            break;
            case 2:
                $variables['frontpageBackgroundPosition'] = 'right';
            break;
        }
    }
    if (!empty($theme->settings->frontpagelogo)) {
        if ($dimensions = theme_campus_get_image_dimensions($theme, 'frontpagelogo', 'frontpagelogo')) {
            $fplogowidth = ($dimensions['width'] / 1680) * 100; // Currently 1680 is the max px of #page.
            $fppaddingbottom = ($dimensions['height'] / 1680) * 100; // Currently 1680 is the max px of #page.
            $fpbackgroundwidth = 100 - $fplogowidth;
            $variables['frontpageLogoWidth'] = $fplogowidth.'%';
            $variables['frontpageBackgroundWidth'] = $fpbackgroundwidth.'%';
            $variables['frontpageHeaderHeight'] = $dimensions['height'].'px';
            $variables['frontpageHeaderHeightDefault'] = 'auto';  // This negates the setting of the height as there is a logo.  Without a logo there is no height to the header and things look bad.
            $variables['frontpageLogoHeight'] = $dimensions['height'].'px';
            $variables['frontpagePaddingBottom'] = $fppaddingbottom.'%';
       }
    }
    if (!empty($theme->settings->carouseltextcolour)) {
        $variables['carouselTextColour'] = $theme->settings->carouseltextcolour;
    }
    if (!empty($theme->settings->slidebuttoncolour)) {
        $variables['slideButtonColour'] = $theme->settings->slidebuttoncolour;
    }
    if (!empty($theme->settings->slidebuttonhovercolour)) {
        $variables['slideButtonHoverColour'] = $theme->settings->slidebuttonhovercolour;
    }

    return $variables;
}

/**
 * Extra LESS code to inject.
 *
 * This will generate some LESS code from the settings used by the user. We cannot use
 * the {@link theme_more_less_variables()} here because we need to create selectors or
 * alter existing ones.
 *
 * @param theme_config $theme The theme config object.
 * @return string Raw LESS code.
 */
function theme_campus_extra_less($theme) {
    global $CFG, $OUTPUT;
    include_once($CFG->dirroot . '/theme/campus/campus-lib.php');
    $campuscategorytree = theme_campus_get_top_level_categories();

    $content = '';

    foreach($campuscategorytree as $key => $value){
        $ccsetting = 'coursecategorybgcolour'.$key;
        if (!empty($theme->settings->$ccsetting)) {
            /* .ccheaderbackgroundcolour(@courseCategoryKey;
                 @courseCategoryMixinBackgroundColour) */
            $content .= '.ccheaderbackgroundcolour('.$key.'; '.$theme->settings->$ccsetting.');';
        }

        $ccsetting = 'coursecategorylogoposition'.$key;
        if (!empty($theme->settings->$ccsetting)) {
            switch ($theme->settings->$ccsetting) {
            /* .ccheaderlogoposition(@courseCategoryKey;
                  @courseCategoryMixinLogoPositionLeft;
                  @courseCategoryMixinLogoPositionRight;
                  @courseCategoryMixinSitenamePositionLeft;
                  @courseCategoryMixinSitenamePositionRight) */
                case 1:
                    $content .= '.ccheaderlogoposition('.$key.'; 20px; auto; auto; 50px);';
                break;
                case 2:
                    $content .= '.ccheaderlogoposition('.$key.'; auto; 20px; 50px; auto);';
                break;
            }
        }

        $ccsetting = 'coursecategorybackgroundposition'.$key;
        if (!empty($theme->settings->$ccsetting)) {
            switch ($theme->settings->$ccsetting) {
            /* .ccheaderbackgroundposition(@courseCategoryKey;
                 @courseCategoryMixinBackgroundPosition) */
                case 1:
                    $content .= '.ccheaderbackgroundposition('.$key.'; left);';
                break;
                case 2:
                    $content .= '.ccheaderbackgroundposition('.$key.'; right);';
                break;
            }
        }

        $ccsetting = 'coursecategorylogo'.$key;
        if (!empty($theme->settings->$ccsetting)) {
            if ($dimensions = theme_campus_get_image_dimensions($theme, $ccsetting, $ccsetting)) {
                $cclogowidth = ($dimensions['width'] / 1680) * 100; // Currently 1680 is the max px of #page.
                $ccpaddingbottom = ($dimensions['height'] / 1680) * 100; // Currently 1680 is the max px of #page.
                $ccbackgroundwidth = 100 - $cclogowidth;
                /* ccheaderlogo(@courseCategoryKey;
                     @courseCategoryMixinHeaderHeight;
                     @courseCategoryMixinLogoHeight;
                     @courseCategoryMixinLogoWidth;
                     @courseCategoryMixinPaddingBottom;
                     @courseCategoryMixinBackgroundWidth) */
                $content .= '.ccheaderlogo('.$key.'; '.$dimensions['height'].'px; '.$dimensions['height'].'px; '.$cclogowidth.'%; '.$ccpaddingbottom.'%; '.$ccbackgroundwidth.'%);';
            }
        } else if (!empty($theme->settings->frontpagelogo)) {
            if ($dimensions = theme_campus_get_image_dimensions($theme, 'frontpagelogo', 'frontpagelogo')) {
                $cclogowidth = ($dimensions['width'] / 1680) * 100; // Currently 1680 is the max px of #page.
                $ccpaddingbottom = ($dimensions['height'] / 1680) * 100; // Currently 1680 is the max px of #page.
                $ccbackgroundwidth = 100 - $cclogowidth;
                /* ccheaderlogo(@courseCategoryKey;
                     @courseCategoryMixinHeaderHeight;
                     @courseCategoryMixinLogoHeight;
                     @courseCategoryMixinLogoWidth;
                     @courseCategoryMixinPaddingBottom;
                     @courseCategoryMixinBackgroundWidth) */
                $content .= '.ccheaderlogo('.$key.'; '.$dimensions['height'].'px; '.$dimensions['height'].'px; '.$cclogowidth.'%; '.$ccpaddingbottom.'%; '.$ccbackgroundwidth.'%);';
            }
        } else if (!empty($OUTPUT->pix_url('logo', 'theme'))) {
            if (!empty($CFG->themedir)) {
                $thelogofile = $CFG->themedir . '/campus/pix/logo';
            } else {
                $thelogofile = $CFG->dirroot . '/theme/campus/pix/logo';
            }
            // Unfortunately the file extension is not in the URL from 'pix_url', so no chance of extracting.
            if (file_exists("$thelogofile.png")) {
                $logofile = "$thelogofile.png";
            } else if (file_exists("$thelogofile.gif")) {
                $logofile = "$thelogofile.gif";
            } else if (file_exists("$thelogofile.jpg")) {
                $logofile = "$thelogofile.jpg";
            } else if (file_exists("$thelogofile.jpeg")) {
                $logofile = "$thelogofile.jpeg";
            } else if (file_exists("$thelogofile.ico")) {
                $logofile = "$thelogofile.ico";
            } else {
                $logofile = false; // Can only happen if 'svg' file as 'pix_url' would return.  But 'getimagesize()' does not support svg files.
            }
            if (($logofile) && ($dimensions = getimagesize($logofile))) {
                // http://php.net/manual/en/function.getimagesize.php - index 0 = width and index 1 = height.
                $cclogowidth = ($dimensions[0] / 1680) * 100; // Currently 1680 is the max px of #page.
                $ccpaddingbottom = ($dimensions[1] / 1680) * 100; // Currently 1680 is the max px of #page.
                $ccbackgroundwidth = 100 - $cclogowidth;
                /* ccheaderlogo(@courseCategoryKey;
                     @courseCategoryMixinHeaderHeight;
                     @courseCategoryMixinLogoHeight;
                     @courseCategoryMixinLogoWidth;
                     @courseCategoryMixinPaddingBottom;
                     @courseCategoryMixinBackgroundWidth) */
                $content .= '.ccheaderlogo('.$key.'; '.$dimensions[1].'px; '.$dimensions[1].'px; '.$cclogowidth.'%; '.$ccpaddingbottom.'%; '.$ccbackgroundwidth.'%);';
            }
        }
    }

    return $content;
}


/**
 * Serves any files associated with the theme settings.
 *
 * @param stdClass $course
 * @param stdClass $cm
 * @param context $context
 * @param string $filearea
 * @param array $args
 * @param bool $forcedownload
 * @param array $options
 * @return bool
 */
function theme_campus_pluginfile($course, $cm, $context, $filearea, $args, $forcedownload, array $options = array()) {
    static $theme;
    if (empty($theme)) {
        $theme = theme_config::load('campus');
    }

    if ($context->contextlevel == CONTEXT_SYSTEM) {
        if ($filearea === 'frontpagelogo') {
            // By default, theme files must be cache-able by both browsers and proxies.  From 'More' theme.
            if (!array_key_exists('cacheability', $options)) {
                $options['cacheability'] = 'public';
            }
            return $theme->setting_file_serve('frontpagelogo', $args, $forcedownload, $options);
        } else if ($filearea === 'frontpagebackgroundimage') {
            // By default, theme files must be cache-able by both browsers and proxies.  From 'More' theme.
            if (!array_key_exists('cacheability', $options)) {
                $options['cacheability'] = 'public';
            }
            return $theme->setting_file_serve('frontpagebackgroundimage', $args, $forcedownload, $options);
        } else if (preg_match("/coursecategorylogo[1-9][0-9]*/", $filearea) !== false) { // http://regexpal.com/ useful.
            // By default, theme files must be cache-able by both browsers and proxies.  From 'More' theme.
            if (!array_key_exists('cacheability', $options)) {
                $options['cacheability'] = 'public';
            }
            return $theme->setting_file_serve($filearea, $args, $forcedownload, $options);
        } else if (preg_match("/coursecategorybackgroundimage[1-9][0-9]*/", $filearea) !== false) { // http://regexpal.com/ useful.
            // By default, theme files must be cache-able by both browsers and proxies.  From 'More' theme.
            if (!array_key_exists('cacheability', $options)) {
                $options['cacheability'] = 'public';
            }
            return $theme->setting_file_serve($filearea, $args, $forcedownload, $options);
        } else if (preg_match("/frontpage[1-9][0-9]*image/", $filearea) !== false) { // http://regexpal.com/ useful.
            // By default, theme files must be cache-able by both browsers and proxies.  From 'More' theme.
            if (!array_key_exists('cacheability', $options)) {
                $options['cacheability'] = 'public';
            }
            return $theme->setting_file_serve($filearea, $args, $forcedownload, $options);
        } else if (preg_match("/coursecategory[1-9][0-9]*_[1-9][0-9]*image/", $filearea) !== false) { // http://regexpal.com/ useful.
            // By default, theme files must be cache-able by both browsers and proxies.  From 'More' theme.
            if (!array_key_exists('cacheability', $options)) {
                $options['cacheability'] = 'public';
            }
            return $theme->setting_file_serve($filearea, $args, $forcedownload, $options);
        } else {
            send_file_not_found();
        }
    } else {
        send_file_not_found();
    }
}

function theme_campus_get_setting($setting, $format = false) {
    global $CFG;
    require_once($CFG->dirroot . '/lib/weblib.php');
    static $theme;
    if (empty($theme)) {
        $theme = theme_config::load('campus');
    }
    if (empty($theme->settings->$setting)) {
        return false;
    } else if (!$format) {
        return $theme->settings->$setting;
    } else if ($format === 'format_text') {
        return format_text($theme->settings->$setting, FORMAT_PLAIN);
    } else if ($format === 'format_html') {
        return format_text($theme->settings->$setting, FORMAT_HTML, array('trusted' => true, 'noclean' => true));
    } else {
        return format_string($theme->settings->$setting);
    }
}

function theme_campus_render_slide($i, $settingprefix) {
    global $PAGE, $OUTPUT;

    $slidetitle = theme_campus_get_setting($settingprefix . $i . 'title', true);
    $slidecaption = theme_campus_get_setting($settingprefix . $i . 'caption', true);
    $slideextraclass = ($i === 1) ? ' active' : '';
    $slideimagealt = strip_tags($slidetitle);

    // Get slide image or fallback to default
    if (theme_campus_get_setting($settingprefix . $i . 'image')) {
        $slideimage = $PAGE->theme->setting_file_url($settingprefix . $i . 'image', $settingprefix . $i . 'image');
    } else {
        $slideimage = $OUTPUT->pix_url('default_slide', 'theme');
    }

    $slide = '<div class="item' . $slideextraclass . '">';

    $nocaption = (!($slidetitle || $slidecaption)) ? ' nocaption' : '';
    $slide .= '<div class="carousel-image-container'.$nocaption.'">';
    $slide .= '<img src="' . $slideimage . '" alt="' . $slideimagealt . '" class="carousel-image"/>';
    $slide .= '</div>';

    // Output title and caption if either is present
    if ($slidetitle || $slidecaption) {
        $slide .= '<div class="carousel-caption">';
        $slide .= '<div class="carousel-caption-inner">';
        $slide .= '<h4>' . $slidetitle . '</h4>';
        $slide .= '<p>' . $slidecaption . '</p>';
        $slide .= '</div>';
        $slide .= '</div>';
    }
    $slide .= '</div>';

    return $slide;
}

function theme_campus_render_slide_controls($left) {
    $faleft = 'left';
    $faright = 'right';
    if (!$left) {
        $temp = $faleft;
        $faleft = $faright;
        $faright = $temp;
    }
    $prev = '<a class="left carousel-control" href="#campusCarousel" data-slide="prev"><i class="fa fa-chevron-circle-' . $faleft . '"></i></a>';
    $next = '<a class="right carousel-control" href="#campusCarousel" data-slide="next"><i class="fa fa-chevron-circle-' . $faright . '"></i></a>';

    return $prev . $next;
}

/**
 * Serves any files associated with the theme settings.
 *
 * @param stdClass $theme null or theme object.
 * @param string $setting setting name for the admin_setting_configstoredfile setting.
 * @param string $filearea filearea for the admin_setting_configstoredfile setting.
 * @return bool|array false if not an image / no file uploaded or array of image dimensions and mime type as returned by 'get_imageinfo()' of 'stored_file.php'.
 */
function theme_campus_get_image_dimensions($theme, $setting, $filearea) {
    if ($theme == null) {
        $theme = theme_config::load('campus');
    }

    if (empty($theme->settings->$setting)) {
        return false;
    }

    $filepath = $theme->settings->$setting;
    $syscontext = context_system::instance();
    $fullpath = "/$syscontext->id/theme_campus/$filearea/0".$filepath;
    $fullpath = rtrim($fullpath, '/');

    $fs = get_file_storage();
    if ($file = $fs->get_file_by_hash(sha1($fullpath))) {
        if ($imageinfo = $file->get_imageinfo()) {
            return $imageinfo; // E.g. Array ( [width] => 150 [height] => 106 [mimetype] => image/jpeg ).
        }
    }
    return false;
}

/**
 * Returns an object containing HTML for the areas affected by settings.
 *
 * @param renderer_base $output Pass in $OUTPUT.
 * @param moodle_page $page Pass in $PAGE.
 * @return stdClass An object with the following properties:
 *      - navbarclass A CSS class to use on the navbar. By default ''.
 *      - heading HTML to use for the heading. A logo if one is selected or the default heading.
 *      - footnote HTML to use as a footnote. By default ''.
 */
function theme_campus_get_html_for_settings(renderer_base $output, moodle_page $page) {
    global $CFG;
    $return = new stdClass;

    $return->navbarclass = '';
    if (!empty($page->theme->settings->invert)) {
        $return->navbarclass .= ' navbar-inverse';
    }

    if (!empty($page->theme->settings->logo)) {
        $return->heading = html_writer::link($CFG->wwwroot, '', array('title' => get_string('home'), 'class' => 'logo'));
    } else {
        $return->heading = '';
    }

    $return->footnote = '';
    if (!empty($page->theme->settings->footnote)) {
        $return->footnote = '<div class="footnote text-center">'.$page->theme->settings->footnote.'</div>';
    }

    return $return;
}

function theme_campus_page_init(moodle_page $page) {
    $page->requires->jquery();
    $page->requires->jquery_plugin('antigravity', 'theme_campus');
    if (($page->pagelayout == 'frontpage') || ($page->pagelayout == 'coursecategory')) {
        $page->requires->jquery_plugin('bootstrap', 'theme_campus');
    }
}
