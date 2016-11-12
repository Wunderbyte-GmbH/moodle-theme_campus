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

    if (\theme_campus\toolbox::get_setting('iconcoloursetting')) {
        \theme_campus\toolbox::change_icons();
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
    if (!empty($theme->settings->pagewidthmax)) {
        if ($theme->settings->pagewidthmax == 100) { // Percentage value.
            $variables['pageWidthMaximum'] = $theme->settings->pagewidthmax.'%';
        } else {
            $variables['pageWidthMaximum'] = $theme->settings->pagewidthmax.'px';
        }
    }
    if (!empty($theme->settings->headingfont)) {
        $variables['headingsFontName'] = $theme->settings->headingfont;
    }
    if (!empty($theme->settings->bodyfont)) {
        $variables['baseFontName'] = $theme->settings->bodyfont;
    }
    if (!empty($theme->settings->textcolour)) {
        $variables['textColor'] = $theme->settings->textcolour;
    }
    if (!empty($theme->settings->linkcolour)) {
        $variables['linkColor'] = $theme->settings->linkcolour;
    }
    if (!empty($theme->settings->contentcolour)) {
        $variables['contentColor'] = $theme->settings->contentcolour;
    }
    if (!empty($theme->settings->headingcolour)) {
        $variables['headingsColor'] = $theme->settings->headingcolour;
    }
    if (!empty($theme->settings->navbartextcolour)) {
        $variables['navbarText'] = $theme->settings->navbartextcolour;
        $variables['navbarBrandColor'] = $theme->settings->navbartextcolour;
        $variables['navbarLinkColor'] = $theme->settings->navbartextcolour;
    }
    if (!empty($theme->settings->navbarlinkcolour)) {
        $variables['navbarLinkColor'] = $theme->settings->navbarlinkcolour;
    }
    if (!empty($theme->settings->navbarbackgroundcolour)) {
        $variables['navbarBackground'] = $theme->settings->navbarbackgroundcolour;
        $variables['navbarBackgroundHighlight'] = $theme->settings->navbarbackgroundcolour;
    }
    if (!empty($theme->settings->blockheadingcolour)) {
        $variables['blockHeadingColor'] = $theme->settings->blockheadingcolour;
    }
    if (!empty($theme->settings->blockheadingbackgroundcolour)) {
        $variables['blockHeadingBackgroundColour'] = $theme->settings->blockheadingbackgroundcolour;
    }
    if (!empty($theme->settings->blockbackgroundcolour)) {
        $variables['blockBackgroundColour'] = $theme->settings->blockbackgroundcolour;
    }
    if (!empty($theme->settings->blockborderoptions)) {
        $blockborderthickness = (!empty($theme->settings->blockborderthickness)) ? $theme->settings->blockborderthickness : '1px';
        switch ($theme->settings->blockborderoptions) {
            case 1: // No border.
                $variables['blockHeadingBorderTopWidth'] = '0';
                $variables['blockHeadingBorderRightWidth'] = '0';
                $variables['blockHeadingBorderBottomWidth'] = '0';
                $variables['blockHeadingBorderLeftWidth'] = '0';
                $variables['blockContentBorderTopWidth'] = '0';
                $variables['blockContentBorderRightWidth'] = '0';
                $variables['blockContentBorderBottomWidth'] = '0';
                $variables['blockContentBorderLeftWidth'] = '0';
            break;
            case 2: // Border around the whole block.
                $variables['blockHeadingBorderTopWidth'] = $blockborderthickness;
                $variables['blockHeadingBorderRightWidth'] = $blockborderthickness;
                $variables['blockHeadingBorderBottomWidth'] = '0';
                $variables['blockHeadingBorderLeftWidth'] = $blockborderthickness;
                $variables['blockContentBorderTopWidth'] = '0';
                $variables['blockContentBorderRightWidth'] = $blockborderthickness;
                $variables['blockContentBorderBottomWidth'] = $blockborderthickness;
                $variables['blockContentBorderLeftWidth'] = $blockborderthickness;
            break;
            case 3: // Border on header only.
                $variables['blockHeadingBorderTopWidth'] = $blockborderthickness;
                $variables['blockHeadingBorderRightWidth'] = $blockborderthickness;
                $variables['blockHeadingBorderBottomWidth'] = $blockborderthickness;
                $variables['blockHeadingBorderLeftWidth'] = $blockborderthickness;
                $variables['blockContentBorderTopWidth'] = '0';
                $variables['blockContentBorderRightWidth'] = '0';
                $variables['blockContentBorderBottomWidth'] = '0';
                $variables['blockContentBorderLeftWidth'] = '0';
            break;
            case 4: // Border on content only.
                $variables['blockHeadingBorderTopWidth'] = '0';
                $variables['blockHeadingBorderRightWidth'] = '0';
                $variables['blockHeadingBorderBottomWidth'] = '0';
                $variables['blockHeadingBorderLeftWidth'] = '0';
                $variables['blockContentBorderTopWidth'] = $blockborderthickness;
                $variables['blockContentBorderRightWidth'] = $blockborderthickness;
                $variables['blockContentBorderBottomWidth'] = $blockborderthickness;
                $variables['blockContentBorderLeftWidth'] = $blockborderthickness;
            break;
            case 5: // Three horizontal lines: above header, between header/content and bottom.
                $variables['blockHeadingBorderTopWidth'] = $blockborderthickness;
                $variables['blockHeadingBorderRightWidth'] = '0';
                $variables['blockHeadingBorderBottomWidth'] = '0';
                $variables['blockHeadingBorderLeftWidth'] = '0';
                $variables['blockContentBorderTopWidth'] = $blockborderthickness;
                $variables['blockContentBorderRightWidth'] = '0';
                $variables['blockContentBorderBottomWidth'] = $blockborderthickness;
                $variables['blockContentBorderLeftWidth'] = '0';
            break;
        }
    }
    if (!empty($theme->settings->blockbordercolour)) {
        $variables['blockBorderColour'] = $theme->settings->blockbordercolour;
    }
    if (!empty($theme->settings->blockborderstyle)) {
        $variables['blockBorderStyle'] = $theme->settings->blockborderstyle;
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
    if (!empty($theme->settings->wellbackgroundcolour)) {
        $variables['wellBackground'] = $theme->settings->wellbackgroundcolour;
    }
    if (!empty($theme->settings->alertinfotextcolour)) {
        $variables['infoText'] = $theme->settings->alertinfotextcolour;
    }
    if (!empty($theme->settings->alertinfobackgroundcolour)) {
        $variables['infoBackground'] = $theme->settings->alertinfobackgroundcolour;
    }
    if (!empty($theme->settings->navbarpageheadingmax)) {
        $variables['navbarPageHeadingMax'] = $theme->settings->navbarpageheadingmax.'px';
    }
    if (!empty($theme->settings->frontpagelogoposition)) {
        switch ($theme->settings->frontpagelogoposition) {
            case 1:
                $variables['frontpagePageHeadingHeaderPositionRight'] = '50px';
            break;
            case 2:
                $variables['frontpagePageHeadingHeaderPositionLeft'] = '50px';
            break;
        }
        if ((!empty($theme->settings->frontpagelayout)) && ($theme->settings->frontpagelayout == 'absolutelayout')) {
            switch ($theme->settings->frontpagelogoposition) {
                case 1:
                    $variables['frontpageLogoPosition'] = 'left';
                break;
                case 2:
                    $variables['frontpageLogoPosition'] = 'right';
                break;
            }
        }
    }
    if ((!empty($theme->settings->frontpagelogo)) && (!empty($theme->settings->frontpagebackgroundimage))) {
        if ($dimensions = theme_campus_get_image_dimensions($theme, 'frontpagelogo', 'frontpagelogo')) {
            if ($backgrounddimensions = theme_campus_get_image_dimensions($theme, 'frontpagebackgroundimage', 'frontpagebackgroundimage')) {
                $backgroundwidth = $backgrounddimensions['width'];
                $backgroundheight = $backgrounddimensions['height'];
            } else {
                if (!empty($theme->settings->pagewidthmax)) {
                    $backgroundwidth = $theme->settings->pagewidthmax; // Fallback, default max px of #page unless a percentage.
                    if ($backgroundwidth == 100) { // Percentage value, cannot use in calculation!
                        $backgroundwidth = 1680; // Fallback, where 1680 is the default max px of #page.
                    }
                } else {
                    $backgroundwidth = 1680; // Fallback, where 1680 is the default max px of #page.
                }
                $backgroundheight = $dimensions['height'];
            }
            $totalwidth = $dimensions['width'] + $backgroundwidth;
            $fplogowidth = ($dimensions['width'] / $totalwidth) * 100;
            $fpabsolutepaddingbottom = ($backgroundheight / $backgroundwidth) * 100;
            $fpflexpaddingbottom = ($dimensions['height'] / $totalwidth) * 100;
            $fpbackgroundwidth = 100 - $fplogowidth;
            $variables['frontpageLogoWidth'] = $fplogowidth.'%';
            $variables['frontpageBackgroundWidth'] = $fpbackgroundwidth.'%';
            $variables['frontpageHeaderHeightDefault'] = 'auto';  // This negates the setting of the height as there is a logo.  Without a logo there is no height to the header and things look bad.
            $variables['frontpageAbsolutePaddingBottom'] = $fpabsolutepaddingbottom.'%';
            $variables['frontpageFlexPaddingBottom'] = $fpflexpaddingbottom.'%';
       }
    } else if ($logodetails = theme_campus_get_theme_logo()) { // Fallback to theme logo.
        // http://php.net/manual/en/function.getimagesize.php - index 0 = width and index 1 = height.
        if (($logodetails['fullname']) && ($dimensions = getimagesize($logodetails['fullname']))) {
            $backgrounddetails = theme_campus_get_theme_background();
            if (($backgrounddetails['fullname']) && ($backgrounddimensions = getimagesize($backgrounddetails['fullname']))) {
                $backgroundwidth = $backgrounddimensions[0];
                $backgroundheight = $backgrounddimensions[1];
            } else {
                if (!empty($theme->settings->pagewidthmax)) {
                    $backgroundwidth = $theme->settings->pagewidthmax; // Fallback, default max px of #page unless a percentage.
                    if ($backgroundwidth == 100) { // Percentage value, cannot use in calculation!
                        $backgroundwidth = 1680; // Fallback, where 1680 is the default max px of #page.
                    }
                } else {
                    $backgroundwidth = 1680; // Fallback, where 1680 is the default max px of #page.
                }
                $backgroundheight = $dimensions[1];
            }
            $totalwidth = $dimensions[0] + $backgroundwidth;
            $fplogowidth = ($dimensions[0] / $totalwidth) * 100;
            $fpabsolutepaddingbottom = ($backgroundheight / $backgroundwidth) * 100;
            $fpflexpaddingbottom = ($dimensions[1] / $totalwidth) * 100;
            $fpbackgroundwidth = 100 - $fplogowidth;
            $variables['frontpageLogoWidth'] = $fplogowidth.'%';
            $variables['frontpageBackgroundWidth'] = $fpbackgroundwidth.'%';
            $variables['frontpageHeaderHeightDefault'] = 'auto';  // This negates the setting of the height as there is a logo.  Without a logo there is no height to the header and things look bad.
            $variables['frontpageAbsolutePaddingBottom'] = $fpabsolutepaddingbottom.'%';
            $variables['frontpageFlexPaddingBottom'] = $fpflexpaddingbottom.'%';
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

    if (file_exists("{$CFG->dirroot}/theme/campus/campus-lib.php")) {
        include_once($CFG->dirroot . '/theme/campus/campus-lib.php');
    } else if (!empty($CFG->themedir) && file_exists("{$CFG->themedir}/campus/campus-lib.php")) {
        include_once($CFG->themedir . '/campus/campus-lib.php');
    }

    $campuscategorytree = theme_campus_get_top_level_categories();

    $content = '@import "'.$CFG->dirroot.'/theme/bootstrapbase/less/moodle";';
    $content .= '@import "variables-campus";';
    $content .= '@import "bootstrapchanges";';
    $content .= '@import "moodlechanges";';
    $content .= '@import "campuschanges";';
    $content .= '@import "campuscustom";';

    // Front page.
    if ((!empty($theme->settings->frontpagelogo)) && (!empty($theme->settings->frontpagebackgroundimage))) {
        if ((!empty($theme->settings->frontpageresponsivelogo)) && (!empty($theme->settings->frontpageresponsivebackgroundimage))) {
            if ($dimensions = theme_campus_get_image_dimensions($theme, 'frontpageresponsivelogo', 'frontpageresponsivelogo')) {
                if ($backgrounddimensions = theme_campus_get_image_dimensions($theme, 'frontpageresponsivebackgroundimage', 'frontpageresponsivebackgroundimage')) {
                    $backgroundwidth = $backgrounddimensions['width'];
                    $backgroundheight = $backgrounddimensions['height'];
                } else {
                    $backgroundwidth = 960; // Fallback, where 960 is the value of @navbarCollapseWidth.
                    $backgroundheight = $dimensions['height'];
                }
                $totalwidth = $dimensions['width'] + $backgroundwidth;
                $fplogowidth = ($dimensions['width'] / $totalwidth) * 100;
                $fpabsolutepaddingbottom = ($backgroundheight / $backgroundwidth) * 100;
                $fpflexpaddingbottom = ($dimensions['height'] / $totalwidth) * 100;
                $fpbackgroundwidth = 100 - $fplogowidth;
                /* .fpresponsiveheaderlogo(@frontpageMixinLogoWidth;
                       @frontpageAbsoluteMixinPaddingBottom;
                       @frontpageFlexMixinPaddingBottom;
                       @frontpageMixinBackgroundWidth) */
                $content .= '.fpresponsiveheaderlogo('.$fplogowidth.'%; '.$fpabsolutepaddingbottom.'%; '.$fpflexpaddingbottom.'%; '.$fpbackgroundwidth.'%);';
            }
        }
    } else {
        // Theme responsive images fall back.
        if (($logoresponsivedetails = theme_campus_get_theme_responsive_logo()) && ($backgroundresponsivedetails = theme_campus_get_theme_responsive_background())) {
            if (($logoresponsivedetails['fullname']) && ($dimensions = getimagesize($logoresponsivedetails['fullname']))) {
                // http://php.net/manual/en/function.getimagesize.php - index 0 = width and index 1 = height.
                if (($backgroundresponsivedetails['fullname']) && ($backgrounddimensions = getimagesize($backgroundresponsivedetails['fullname']))) {
                    $backgroundwidth = $backgrounddimensions[0];
                    $backgroundheight = $backgrounddimensions[1];
                } else {
                    $backgroundwidth = 960; // Fallback, where 960 is the value of @navbarCollapseWidth.
                    $backgroundheight = $dimensions[1];
                }
                $totalwidth = $dimensions[0] + $backgroundwidth;
                $fplogowidth = ($dimensions[0] / $totalwidth) * 100;
                $fpabsolutepaddingbottom = ($backgroundheight / $backgroundwidth) * 100;
                $fpflexpaddingbottom = ($dimensions[1] / $totalwidth) * 100;
                $fpbackgroundwidth = 100 - $fplogowidth;
                /* .fpresponsiveheaderlogo(@frontpageMixinLogoWidth;
                       @frontpageAbsoluteMixinPaddingBottom;
                       @frontpageFlexMixinPaddingBottom;
                       @frontpageMixinBackgroundWidth) */
                $content .= '.fpresponsiveheaderlogo('.$fplogowidth.'%; '.$fpabsolutepaddingbottom.'%; '.$fpflexpaddingbottom.'%; '.$fpbackgroundwidth.'%);';
            }
        }
    }

    // Course catetgory.
    foreach($campuscategorytree as $key => $value){
        $categorylogoused = false;
        $cchavecustomsetting = 'coursecategoryhavecustomheader'.$key;
        $ccsetting = 'coursecategorylogo'.$key;
        $ccbsetting = 'coursecategorybackgroundimage'.$key;
        if ((!empty($theme->settings->$cchavecustomsetting)) && (!empty($theme->settings->$ccsetting)) && (!empty($theme->settings->$ccbsetting))) {
            if ($dimensions = theme_campus_get_image_dimensions($theme, $ccsetting, $ccsetting)) {
                if ($backgrounddimensions = theme_campus_get_image_dimensions($theme, $ccbsetting, $ccbsetting)) {
                    $backgroundwidth = $backgrounddimensions['width'];
                    $backgroundheight = $backgrounddimensions['height'];
                } else {
                    if (!empty($theme->settings->pagewidthmax)) {
                        $backgroundwidth = $theme->settings->pagewidthmax; // Fallback, default max px of #page unless a percentage.
                        if ($backgroundwidth == 100) { // Percentage value, cannot use in calculation!
                            $backgroundwidth = 1680; // Fallback, where 1680 is the default max px of #page.
                        }
                    } else {
                        $backgroundwidth = 1680; // Fallback, where 1680 is the default max px of #page.
                    }
                    $backgroundheight = $dimensions['height'];
                }
                $totalwidth = $dimensions['width'] + $backgroundwidth;
                $cclogowidth = ($dimensions['width'] / $totalwidth) * 100;
                $ccabsolutepaddingbottom = ($backgroundheight / $backgroundwidth) * 100;
                $ccflexpaddingbottom = ($dimensions['height'] / $totalwidth) * 100;
                $ccbackgroundwidth = 100 - $cclogowidth;
                /* ccheaderlogo(@courseCategoryKey;
                     @courseCategoryMixinLogoWidth;
                     @courseCategoryMixinAbsolutePaddingBottom;
                     @courseCategoryMixinFlexPaddingBottom;
                     @courseCategoryMixinBackgroundWidth) */
                $content .= '.ccheaderlogo('.$key.'; '.$cclogowidth.'%; '.$ccabsolutepaddingbottom.'%; '.$ccflexpaddingbottom.'%; '.$ccbackgroundwidth.'%);';

                $ccsetting = 'coursecategoryresponsivelogo'.$key;
                $ccbsetting = 'coursecategoryresponsivebackgroundimage'.$key;
                if ((!empty($theme->settings->$ccsetting)) && (!empty($theme->settings->$ccbsetting))) {
                    if ($dimensions = theme_campus_get_image_dimensions($theme, $ccsetting, $ccsetting)) {
                        if ($backgrounddimensions = theme_campus_get_image_dimensions($theme, $ccbsetting, $ccbsetting)) {
                            $backgroundwidth = $backgrounddimensions['width'];
                            $backgroundheight = $backgrounddimensions['height'];
                        } else {
                            $backgroundwidth = 960; // Fallback, where 960 is the value of @navbarCollapseWidth.
                            $backgroundheight = $dimensions['height'];
                        }
                        $totalwidth = $dimensions['width'] + $backgroundwidth;
                        $cclogowidth = ($dimensions['width'] / $totalwidth) * 100;
                        $ccabsolutepaddingbottom = ($backgroundheight / $backgroundwidth) * 100;
                        $ccflexpaddingbottom = ($dimensions['height'] / $totalwidth) * 100;
                        $ccbackgroundwidth = 100 - $cclogowidth;
                        /* .ccresponsiveheaderlogo(@courseCategoryKey;
                             @courseCategoryMixinLogoWidth;
                             @courseCategoryMixinAbsolutePaddingBottom;
                             @courseCategoryMixinFlexPaddingBottom;
                             @courseCategoryMixinBackgroundWidth) */
                        $content .= '.ccresponsiveheaderlogo('.$key.'; '.$cclogowidth.'%; '.$ccabsolutepaddingbottom.'%; '.$ccflexpaddingbottom.'%; '.$ccbackgroundwidth.'%);';
                    }
                }
                $categorylogoused = true;
            }
        } else if ((!empty($theme->settings->frontpagelogo)) && (!empty($theme->settings->frontpagebackgroundimage))) { // Front page fall back.
            if ($dimensions = theme_campus_get_image_dimensions($theme, 'frontpagelogo', 'frontpagelogo')) {
                // Front page campus desktop images.
                if ($backgrounddimensions = theme_campus_get_image_dimensions($theme, 'frontpagebackgroundimage', 'frontpagebackgroundimage')) {
                    $backgroundwidth = $backgrounddimensions['width'];
                    $backgroundheight = $backgrounddimensions['height'];
                } else {
                    if (!empty($theme->settings->pagewidthmax)) {
                        $backgroundwidth = $theme->settings->pagewidthmax; // Fallback, default max px of #page unless a percentage.
                        if ($backgroundwidth == 100) { // Percentage value, cannot use in calculation!
                            $backgroundwidth = 1680; // Fallback, where 1680 is the default max px of #page.
                        }
                    } else {
                        $backgroundwidth = 1680; // Fallback, where 1680 is the default max px of #page.
                    }
                    $backgroundheight = $dimensions['height'];
                }
                $totalwidth = $dimensions['width'] + $backgroundwidth;
                $cclogowidth = ($dimensions['width'] / $totalwidth) * 100;
                $ccabsolutepaddingbottom = ($backgroundheight / $backgroundwidth) * 100;
                $ccflexpaddingbottom = ($dimensions['height'] / $totalwidth) * 100;
                $ccbackgroundwidth = 100 - $cclogowidth;
                /* ccheaderlogo(@courseCategoryKey;
                     @courseCategoryMixinLogoWidth;
                     @courseCategoryMixinAbsolutePaddingBottom;
                     @courseCategoryMixinFlexPaddingBottom;
                     @courseCategoryMixinBackgroundWidth) */
                $content .= '.ccheaderlogo('.$key.'; '.$cclogowidth.'%; '.$ccabsolutepaddingbottom.'%; '.$ccflexpaddingbottom.'%; '.$ccbackgroundwidth.'%);';

                if ((!empty($theme->settings->frontpageresponsivelogo)) && (!empty($theme->settings->frontpageresponsivebackgroundimage))) {
                    if ($dimensions = theme_campus_get_image_dimensions($theme, 'frontpageresponsivelogo', 'frontpageresponsivelogo')) {
                        if ($backgrounddimensions = theme_campus_get_image_dimensions($theme, 'frontpageresponsivebackgroundimage', 'frontpageresponsivebackgroundimage')) {
                            $backgroundwidth = $backgrounddimensions['width'];
                            $backgroundheight = $backgrounddimensions['height'];
                        } else {
                            $backgroundwidth = 960; // Fallback, where 960 is the value of @navbarCollapseWidth.
                            $backgroundheight = $dimensions['height'];
                        }
                        $totalwidth = $dimensions['width'] + $backgroundwidth;
                        $cclogowidth = ($dimensions['width'] / $totalwidth) * 100;
                        $ccabsolutepaddingbottom = ($backgroundheight / $backgroundwidth) * 100;
                        $ccflexpaddingbottom = ($dimensions['height'] / $totalwidth) * 100;
                        $ccbackgroundwidth = 100 - $cclogowidth;
                        /* ccheaderlogo(@courseCategoryKey;
                             @courseCategoryMixinLogoWidth;
                             @courseCategoryMixinAbsolutePaddingBottom;
                             @courseCategoryMixinFlexPaddingBottom;
                             @courseCategoryMixinBackgroundWidth) */
                        $content .= '.ccresponsiveheaderlogo('.$key.'; '.$cclogowidth.'%; '.$ccabsolutepaddingbottom.'%; '.$ccflexpaddingbottom.'%; '.$ccbackgroundwidth.'%);';
                    }
                }

                // Using front page, so use those settings.
                if (!empty($theme->settings->frontpagelogoposition)) {
                    switch ($theme->settings->frontpagelogoposition) {
                    /* .ccheaderlogoposition(@courseCategoryKey;
                          @courseCategoryMixinLogoPosition;
                          @courseCategoryMixinPageHeadingHeaderPositionLeft;
                          @courseCategoryMixinPageHeadingHeaderPositionRight) */
                        case 1:
                            $content .= '.ccheaderlogoposition('.$key.'; left; auto; 50px);';
                        break;
                        case 2:
                            $content .= '.ccheaderlogoposition('.$key.'; right; 50px; auto);';
                        break;
                    }
                }
            }
        } else if ($logodetails = theme_campus_get_theme_logo()) { // Theme images fall back.
            if (($logodetails['fullname']) && ($dimensions = getimagesize($logodetails['fullname']))) {
                // http://php.net/manual/en/function.getimagesize.php - index 0 = width and index 1 = height.
                $backgrounddetails = theme_campus_get_theme_background();
                if (($backgrounddetails['fullname']) && ($backgrounddimensions = getimagesize($backgrounddetails['fullname']))) {
                    $backgroundwidth = $backgrounddimensions[0];
                    $backgroundheight = $backgrounddimensions[1];
                } else {
                    if (!empty($theme->settings->pagewidthmax)) {
                        $backgroundwidth = $theme->settings->pagewidthmax; // Fallback, default max px of #page unless a percentage.
                        if ($backgroundwidth == 100) { // Percentage value, cannot use in calculation!
                            $backgroundwidth = 1680; // Fallback, where 1680 is the default max px of #page.
                        }
                    } else {
                        $backgroundwidth = 1680; // Fallback, where 1680 is the default max px of #page.
                    }
                    $backgroundheight = $dimensions[1];
                }
                $totalwidth = $dimensions[0] + $backgroundwidth;
                $cclogowidth = ($dimensions[0] / $totalwidth) * 100;
                $ccabsolutepaddingbottom = ($backgroundheight / $backgroundwidth) * 100;
                $ccflexpaddingbottom = ($dimensions[1] / $totalwidth) * 100;
                $ccbackgroundwidth = 100 - $cclogowidth;
                /* ccheaderlogo(@courseCategoryKey;
                     @courseCategoryMixinLogoWidth;
                     @courseCategoryMixinAbsolutePaddingBottom;
                     @courseCategoryMixinFlexPaddingBottom;
                     @courseCategoryMixinBackgroundWidth) */
                $content .= '.ccheaderlogo('.$key.'; '.$cclogowidth.'%; '.$ccabsolutepaddingbottom.'%; '.$ccflexpaddingbottom.'%; '.$ccbackgroundwidth.'%);';

                // Theme responsive images fall back.
                if (($logoresponsivedetails = theme_campus_get_theme_responsive_logo()) && ($backgroundresponsivedetails = theme_campus_get_theme_responsive_background())) {
                    if (($logoresponsivedetails['fullname']) && ($dimensions = getimagesize($logoresponsivedetails['fullname']))) {
                        // http://php.net/manual/en/function.getimagesize.php - index 0 = width and index 1 = height.
                        if (($backgroundresponsivedetails['fullname']) && ($backgrounddimensions = getimagesize($backgroundresponsivedetails['fullname']))) {
                            $backgroundwidth = $backgrounddimensions[0];
                            $backgroundheight = $backgrounddimensions[1];
                        } else {
                            $backgroundwidth = 960; // Fallback, where 960 is the value of @navbarCollapseWidth.
                            $backgroundheight = $dimensions[1];
                        }
                        $totalwidth = $dimensions[0] + $backgroundwidth;
                        $cclogowidth = ($dimensions[0] / $totalwidth) * 100;
                        $ccabsolutepaddingbottom = ($backgroundheight / $backgroundwidth) * 100;
                        $ccflexpaddingbottom = ($dimensions[1] / $totalwidth) * 100;
                        $ccbackgroundwidth = 100 - $cclogowidth;
                        /* ccheaderlogo(@courseCategoryKey;
                             @courseCategoryMixinLogoWidth;
                             @courseCategoryMixinAbsolutePaddingBottom;
                             @courseCategoryMixinFlexPaddingBottom;
                             @courseCategoryMixinBackgroundWidth) */
                        $content .= '.ccresponsiveheaderlogo('.$key.'; '.$cclogowidth.'%; '.$ccabsolutepaddingbottom.'%; '.$ccflexpaddingbottom.'%; '.$ccbackgroundwidth.'%);';
                    }
                }
                $content .= '.ccheaderlogoposition('.$key.'; left; auto; 50px);'; // Theme layout uses logo on left.
            }
        }

        if ($categorylogoused == true) {
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
                      @courseCategoryMixinLogoPosition;
                      @courseCategoryMixinPageHeadingHeaderPositionLeft;
                      @courseCategoryMixinPageHeadingHeaderPositionRight) */
                    case 1:
                        $content .= '.ccheaderlogoposition('.$key.'; left; auto; 50px);';
                    break;
                    case 2:
                        $content .= '.ccheaderlogoposition('.$key.'; right; 50px; auto);';
                    break;
                }
            }
        }
    }

    // Header toggle.
    if (!empty($theme->settings->showheadertoggle)) {
        // NOTE: If @navbarCollapseWidth changes in the variables-campus.less file, then change this.
        // .headertogglesetup(@screenWidth)
        $content .= '.headertogglesetup(961px);';
        // .headertogglemenuhide(@screenWidth)
        $content .= '.headertogglemenuhide(960px);';
        // .headertogglemenuhidenofancy(@screenWidth)
        $content .= '.headertogglemenuhidenofancy(960px);';
    }

    return $content;
}

/**
 * Gets the details of the logo for the theme in the 'pix' folder.
 *
 * @return boolean|array false if not found|array with 'name' of image and 'fullname' with complete path and name.
 */
function theme_campus_get_theme_logo() {
    global $CFG;

    $logodetails = array();
    $logodetails['name'] = 'logo';
    if (file_exists("{$CFG->dirroot}/theme/campus/pix/")) {
        $thelogofile = $CFG->dirroot . '/theme/campus/pix/'.$logodetails['name'];
    } else if (!empty($CFG->themedir) && file_exists("{$CFG->themedir}/campus/pix/")) {
        $thelogofile = $CFG->themedir . '/campus/pix/'.$logodetails['name'];
    }
    // Unfortunately the file extension is not in the URL from 'pix_url', so no chance of extracting from there.
    if (file_exists("$thelogofile.png")) {
        $logodetails['fullname'] = "$thelogofile.png";
    } else if (file_exists("$thelogofile.gif")) {
        $logodetails['fullname'] = "$thelogofile.gif";
    } else if (file_exists("$thelogofile.jpg")) {
        $logodetails['fullname'] = "$thelogofile.jpg";
    } else if (file_exists("$thelogofile.jpeg")) {
        $logodetails['fullname'] = "$thelogofile.jpeg";
    } else if (file_exists("$thelogofile.ico")) {
        $logodetails['fullname'] = "$thelogofile.ico";
    } else {
        $logodetails = false; // 'getimagesize()' does not support svg files.
    }

    return $logodetails;
}

/**
 * Gets the details of the logo for the theme for small devices in the 'pix' folder.
 *
 * @return boolean|array false if not found|array with 'name' of image and 'fullname' with complete path and name.
 */
function theme_campus_get_theme_responsive_logo() {
    global $CFG;

    $logodetails = array();
    $logodetails['name'] = 'logo_responsive';
    if (file_exists("{$CFG->dirroot}/theme/campus/pix/")) {
        $thelogofile = $CFG->dirroot . '/theme/campus/pix/'.$logodetails['name'];
    } else if (!empty($CFG->themedir) && file_exists("{$CFG->themedir}/campus/pix/")) {
        $thelogofile = $CFG->themedir . '/campus/pix/'.$logodetails['name'];
    }
    // Unfortunately the file extension is not in the URL from 'pix_url', so no chance of extracting from there.
    if (file_exists("$thelogofile.png")) {
        $logodetails['fullname'] = "$thelogofile.png";
    } else if (file_exists("$thelogofile.gif")) {
        $logodetails['fullname'] = "$thelogofile.gif";
    } else if (file_exists("$thelogofile.jpg")) {
        $logodetails['fullname'] = "$thelogofile.jpg";
    } else if (file_exists("$thelogofile.jpeg")) {
        $logodetails['fullname'] = "$thelogofile.jpeg";
    } else if (file_exists("$thelogofile.ico")) {
        $logodetails['fullname'] = "$thelogofile.ico";
    } else {
        $logodetails = false; // 'getimagesize()' does not support svg files.
    }

    return $logodetails;
}

/**
 * Gets the details of the background for the theme in the 'pix' folder.
 *
 * @return boolean|array false if not found|array with 'name' of image and 'fullname' with complete path and name.
 */
function theme_campus_get_theme_background() {
    global $CFG;

    $backgrounddetails = array();
    $backgrounddetails['name'] = 'background';
    if (file_exists("{$CFG->dirroot}/theme/campus/pix/")) {
        $thebackgroundfile = $CFG->dirroot . '/theme/campus/pix/'.$backgrounddetails['name'];
    } else if (!empty($CFG->themedir) && file_exists("{$CFG->themedir}/campus/pix/")) {
        $thebackgroundfile = $CFG->themedir . '/campus/pix/'.$backgrounddetails['name'];
    }
    // Unfortunately the file extension is not in the URL from 'pix_url', so no chance of extracting from there.
    if (file_exists("$thebackgroundfile.png")) {
        $backgrounddetails['fullname'] = "$thebackgroundfile.png";
    } else if (file_exists("$thebackgroundfile.gif")) {
        $backgrounddetails['fullname'] = "$thebackgroundfile.gif";
    } else if (file_exists("$thebackgroundfile.jpg")) {
        $backgrounddetails['fullname'] = "$thebackgroundfile.jpg";
    } else if (file_exists("$thebackgroundfile.jpeg")) {
        $backgrounddetails['fullname'] = "$thebackgroundfile.jpeg";
    } else if (file_exists("$thebackgroundfile.ico")) {
        $backgrounddetails['fullname'] = "$thebackgroundfile.ico";
    } else {
        $backgrounddetails = false; // 'getimagesize()' does not support svg files.
    }

    return $backgrounddetails;
}

/**
 * Gets the details of the background for the theme for small devices in the 'pix' folder.
 *
 * @return boolean|array false if not found|array with 'name' of image and 'fullname' with complete path and name.
 */
function theme_campus_get_theme_responsive_background() {
    global $CFG;

    $backgrounddetails = array();
    $backgrounddetails['name'] = 'background_responsive';
    if (file_exists("{$CFG->dirroot}/theme/campus/pix/")) {
        $thebackgroundfile = $CFG->dirroot . '/theme/campus/pix/'.$backgrounddetails['name'];
    } else if (!empty($CFG->themedir) && file_exists("{$CFG->themedir}/campus/pix/")) {
        $thebackgroundfile = $CFG->themedir . '/campus/pix/'.$backgrounddetails['name'];
    }
    // Unfortunately the file extension is not in the URL from 'pix_url', so no chance of extracting from there.
    if (file_exists("$thebackgroundfile.png")) {
        $backgrounddetails['fullname'] = "$thebackgroundfile.png";
    } else if (file_exists("$thebackgroundfile.gif")) {
        $backgrounddetails['fullname'] = "$thebackgroundfile.gif";
    } else if (file_exists("$thebackgroundfile.jpg")) {
        $backgrounddetails['fullname'] = "$thebackgroundfile.jpg";
    } else if (file_exists("$thebackgroundfile.jpeg")) {
        $backgrounddetails['fullname'] = "$thebackgroundfile.jpeg";
    } else if (file_exists("$thebackgroundfile.ico")) {
        $backgrounddetails['fullname'] = "$thebackgroundfile.ico";
    } else {
        $backgrounddetails = false; // 'getimagesize()' does not support svg files.
    }

    return $backgrounddetails;
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
        } else if (preg_match("/^coursecategorylogo[1-9][0-9]*$/", $filearea) !== false) { // http://regexpal.com/ useful.
            // By default, theme files must be cache-able by both browsers and proxies.  From 'More' theme.
            if (!array_key_exists('cacheability', $options)) {
                $options['cacheability'] = 'public';
            }
            return $theme->setting_file_serve($filearea, $args, $forcedownload, $options);
        } else if (preg_match("/^coursecategorybackgroundimage[1-9][0-9]*$/", $filearea) !== false) { // http://regexpal.com/ useful.
            // By default, theme files must be cache-able by both browsers and proxies.  From 'More' theme.
            if (!array_key_exists('cacheability', $options)) {
                $options['cacheability'] = 'public';
            }
            return $theme->setting_file_serve($filearea, $args, $forcedownload, $options);
        } else if (preg_match("/^frontpage[1-9][0-9]*image$/", $filearea) !== false) { // http://regexpal.com/ useful.
            // By default, theme files must be cache-able by both browsers and proxies.  From 'More' theme.
            if (!array_key_exists('cacheability', $options)) {
                $options['cacheability'] = 'public';
            }
            return $theme->setting_file_serve($filearea, $args, $forcedownload, $options);
        } else if (preg_match("/^coursecategory[1-9][0-9]*_[1-9][0-9]*image$/", $filearea) !== false) { // http://regexpal.com/ useful.
            // By default, theme files must be cache-able by both browsers and proxies.  From 'More' theme.
            if (!array_key_exists('cacheability', $options)) {
                $options['cacheability'] = 'public';
            }
            return $theme->setting_file_serve($filearea, $args, $forcedownload, $options);
        } else if ($filearea === 'favicon') {
            // By default, theme files must be cache-able by both browsers and proxies.  From 'More' theme.
            if (!array_key_exists('cacheability', $options)) {
                $options['cacheability'] = 'public';
            }
            return $theme->setting_file_serve('favicon', $args, $forcedownload, $options);
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
    $slidelink = theme_campus_get_setting($settingprefix . $i . 'link', true);
    $slideextraclass = ($i === 1) ? ' active' : '';
    $slideimagealt = strip_tags($slidetitle);
    if (empty($slideimagealt)) {
        $slideimagealt = get_string('slideno', 'theme_campus', array('slide' => $i));
    }

    // Get slide image or fallback to default
    if (theme_campus_get_setting($settingprefix . $i . 'image')) {
        $slideimage = $PAGE->theme->setting_file_url($settingprefix . $i . 'image', $settingprefix . $i . 'image');
    } else {
        $slideimage = $OUTPUT->pix_url('default_slide', 'theme');
    }

    if ($slidelink) {
        $slidelinktarget = theme_campus_get_setting($settingprefix . $i . 'linktarget', true);
        $slide = '<a href="'.$slidelink.'" target="'.$slidelinktarget.'" class="item' . $slideextraclass . '">';
    } else {
        $slide = '<div class="item' . $slideextraclass . '">';
    }

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
    if ($slidelink) {
        $slide .= '</a>';
    } else {
        $slide .= '</div>';
    }

    return $slide;
}

function theme_campus_render_slide_controls($left) {
    $previous = get_string('sliderpreviousslide', 'theme_campus');
    $next = get_string('slidernextslide', 'theme_campus');
    $faleft = 'left';
    $faright = 'right';
    $prev = '<a class="left carousel-control" data-target="#campusCarousel" data-slide="prev" title="'.$previous.'"><span class="fa fa-chevron-circle-' . $faleft . '"></span></a>';
    $next = '<a class="right carousel-control" data-target="#campusCarousel" data-slide="next" title="'.$next.'"><span class="fa fa-chevron-circle-' . $faright . '"></span></a>';

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
