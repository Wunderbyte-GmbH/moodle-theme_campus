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
    // Set the background image for the logo.
    $logo = $theme->setting_file_url('logo', 'logo');
    $css = theme_campus_set_logo($css, $logo);

    // Set custom CSS.
    if (!empty($theme->settings->customcss)) {
        $customcss = $theme->settings->customcss;
    } else {
        $customcss = null;
    }
    $css = theme_campus_set_customcss($css, $customcss);

    return $css;
}

function theme_campus_set_logo($css, $logo) {
    global $OUTPUT;
    $tag = '[[setting:logo]]';
    $replacement = $logo;
    if (is_null($replacement)) {
        $replacement = '';
    }

    $css = str_replace($tag, $replacement, $css);

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
    }
    if (!empty($theme->settings->themebackgroundcolour)) {
        $variables['themeBackground'] = $theme->settings->themebackgroundcolour;
    }
    if (!empty($theme->settings->baseborderradius)) {
        $variables['baseBorderRadius'] = $theme->settings->baseborderradius.'px';
    }
    if (!empty($theme->settings->borderradiussmall)) {
        $variables['borderRadiusSmall'] = $theme->settings->borderradiussmall.'px';
    }
    if (!empty($theme->settings->borderradiuslarge)) {
        $variables['borderRadiusLarge'] = $theme->settings->borderradiuslarge.'px';
    }
    return $variables;
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
    if ($context->contextlevel == CONTEXT_SYSTEM) {
        if ($filearea === 'logo') {
            $theme = theme_config::load('campus');
            // By default, theme files must be cache-able by both browsers and proxies.  From 'More' theme.
            if (!array_key_exists('cacheability', $options)) {
                $options['cacheability'] = 'public';
            }
            return $theme->setting_file_serve('logo', $args, $forcedownload, $options);
        } else {
            send_file_not_found();
        }
    } else {
        send_file_not_found();
    }
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
        $return->heading = $output->page_heading();
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
}

function theme_campus_get_top_level_category_ids() {
    global $CFG;
    include_once($CFG->libdir . '/coursecatlib.php');

    $categoryids = array();
    $categories = coursecat::get(0)->get_children();  // Parent = 0 i.e. top-level categories only.

    foreach($categories as $category){
        $categoryids[] = $category->id;
    }

    return $categoryids;
}

function theme_campus_get_current_category() {
    global $PAGE;
    $catid = 0;

    if (is_array($PAGE->categories)) {
        $catids = array_keys($PAGE->categories);
        $catid = reset($catids);
    } else if (!empty($PAGE->course->category)) {
        $catid = $PAGE->course->category;
    }

    return $catid;
}
