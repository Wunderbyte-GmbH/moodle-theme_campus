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
 * @copyright  &copy; 2016-onwards G J Barnard in respect to modifications of the Clean theme.
 * @copyright  &copy; 2016-onwards Work undertaken for David Bogner of Edulabs.org.
 * @author     G J Barnard - {@link http://moodle.org/user/profile.php?id=442195}
 * @author     Based on code originally written by Mary Evans, Bas Brands, Stuart Lamour and David Scotson.
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace theme_campus;

class toolbox {

    protected static $theme;

    /**
     * Finds the given setting in the theme from the themes' configuration object.
     * @param string $setting Setting name.
     * @param string $format false|'format_text'|'format_html'.
     * @param theme_config $theme null|theme_config object.
     * @return any false|value of setting.
     */
    public static function get_setting($setting, $format = false, $theme = null) {

        if (empty($theme)) {
            if (empty(self::$theme)) {
                self::$theme = \theme_config::load('campus');
            }
            $theme = self::$theme;
        }

        global $CFG;
        require_once($CFG->dirroot . '/lib/weblib.php');
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

    /**
     * Finds the given setting in the theme using the get_config core function for when the theme_config object has not been created.
     * @param string $setting Setting name.
     * @param themename $themename null(default of 'shoelace' used)|theme name.
     * @return any false|value of setting.
     */
    public static function get_config_setting($setting, $themename = null) {
        if (empty($themename)) {
            $themename = 'campus';
        }
        return \get_config('theme_' . $themename, $setting);
    }

    /**
     * Gets the setting moodle_url for the given setting if it exists and set.
     *
     * See: https://moodle.org/mod/forum/discuss.php?d=371252#p1516474 and change if theme_config::setting_file_url
     * changes.
     */
    public static function get_setting_moodle_url($setting) {
        $settingurl = null;

        $thesetting = self::get_config_setting($setting);
        if (!empty($thesetting)) {
            global $CFG;
            $itemid = \theme_get_revision();
            $syscontext = \context_system::instance();

            $settingurl = \moodle_url::make_file_url("$CFG->wwwroot/pluginfile.php", "/$syscontext->id/theme_campus/$setting/$itemid".$thesetting);
            $settingurl = preg_replace('|^https?://|i', '//', $settingurl->out(false));
        }
        return $settingurl;
    }

    /**
     * Gets the setting moodle_url for the given setting if it exists and set.
     *
     * See: https://moodle.org/mod/forum/discuss.php?d=371252#p1516474 and change if theme_config::setting_file_url
     * changes.
     */
    public static function get_setting_moodle_url_noitemid($setting) {
        $settingurl = null;

        $thesetting = self::get_config_setting($setting);
        if (!empty($thesetting)) {
            global $CFG;
            $syscontext = \context_system::instance();

            $settingurl = \moodle_url::make_file_url("$CFG->wwwroot/pluginfile.php", "/$syscontext->id/theme_campus/$setting".$thesetting);
            $settingurl = preg_replace('|^https?://|i', '//', $settingurl->out(false));
        }
        return $settingurl;
    }

    public static function change_icons() {
        static $lastrun = 0;
        if (empty($lastrun)) {
            $lastrun = time();
        } else {
            $thisrun = time();
            if (($thisrun - $lastrun) <= 5) {
                $lastrun = $thisrun;
                /* Prevent muiltiple runs within a five second period.
                   Helps to reduce the issue of multiple calls when 'Purging all caches'. */
                return;
            }
            $lastrun = $thisrun;
        }

        static $folder = null;
        if (empty($folder)) {
            global $CFG, $PAGE;
            $themedir = $PAGE->theme->dir;
            $folder = '.';

            if (file_exists("$CFG->dirroot/theme/campus/$folder")) {
                $folder = "$CFG->dirroot/theme/campus";
            } else if (!empty($CFG->themedir) && file_exists("$CFG->themedir/campus")) {
                $folder = "$CFG->themedir/campus";
            } else {
                $folder = dirname(__FILE__);
            }
        }

        $iconcolour = self::get_setting('iconcolour');
        if (strlen($iconcolour) > 0) {
            $currenticoncolour = self::get_config_setting('currenticoncolour');
            // Do we need to look at all the files and change them?
            if (strcmp($currenticoncolour, $iconcolour) != 0) {
                set_config('currenticoncolour', $iconcolour, 'theme_campus');
                $files = array();
                self::svg_files($files, $folder . '/pix/fp');
                self::svg_files($files, $folder . '/pix_core');
                self::svg_files($files, $folder . '/pix_plugins');
                $attrset = false;

                foreach ($files as $file => $filename) {
                    $svg = simplexml_load_file($filename);
                    if (isset($svg->path)) {
                        foreach ($svg->path as $pathidx => $path) {
                            foreach ($path->attributes() as $attridx => $attr) {
                                if ((strcmp($attridx, 'fill') == 0)) {
                                    if ((strcmp($attr, '#fff') != 0) && (strcmp($attr, $iconcolour) != 0)) {
                                        $path['fill'] = $iconcolour;
                                        $attrset = true;
                                    }
                                }
                            }
                        }
                        if ($attrset) {
                            $svg->asXML($filename);
                            $attrset = false;
                        }
                    }
                }
                \purge_all_caches();  // Reset cache even though setting would have done this, files not updated on system!
            }
        }
    }

    private static function svg_files(&$files, $root) {
        if (file_exists($root)) {
            $thefiles = scandir($root);

            foreach ($thefiles as $file => $filename) {
                if ((strlen($filename) == 1) && ($filename[0] == '.')) {
                    continue;
                }
                if ((strlen($filename) == 2) && ($filename[0] == '.') && ($filename[1] == '.')) {
                    continue;
                }
                if (is_dir("$root/$filename")) {
                    self::svg_files($files, "$root/$filename");
                } else if (strpos($filename, '.svg') !== false) { // TODO: See if 'finfo_file' is better.
                    $files[] = $root . '/' . $filename;
                }
            }
        }
    }

    public static function get_scss_file($filename) {
        // TODO - themedir.
        global $CFG;
        return file_get_contents($CFG->dirroot.'/theme/campus/scss/'.$filename.'.scss');
    }


    /**
     * States if there will be settings in course.
     *
     * Adapted from the Boost_Campus theme.
     *
     * @copyright 2017 Kathrin Osswald, Ulm University kathrin.osswald@uni-ulm.de
     * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
     *
     * @return boolean yes - true or no - false.
     */
    public static function has_incourse_settings() {
        global $PAGE;

        $incourse = false;
        // If setting showsettingsincourse is enabled.
        if (self::get_setting('showsettingsincourse') == 'yes') {
            // Only search for the courseadmin node if we are within a course or a module context.
            if ($PAGE->context->contextlevel == CONTEXT_COURSE || $PAGE->context->contextlevel == CONTEXT_MODULE) {
                $node = $PAGE->settingsnav->find('courseadmin', \navigation_node::TYPE_COURSE);
                // Check if $node is not empty for other pages like for example the langauge customization page.
                if (!empty($node)) {
                    $incourse = true;
                }
            }
        }
        return $incourse;
    }

    /**
     * Provides the node for the in-course course or activity settings.
     *
     * Adapted from the Boost_Campus theme.
     *
     * @copyright 2017 Kathrin Osswald, Ulm University kathrin.osswald@uni-ulm.de
     * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
     *
     * @return navigation_node.
     */
    public static function get_incourse_settings() {
        global $COURSE, $PAGE;
        // Initialize the node with false to prevent problems on pages that do not have a courseadmin node.
        $node = false;
        // If setting showsettingsincourse is enabled and there will be settings on the course.
        if (self::has_incourse_settings()) {
            // Get the courseadmin node for the current page.
            $node = $PAGE->settingsnav->find('courseadmin', \navigation_node::TYPE_COURSE);

            /* If the setting 'incoursesettingsswitchtoroleposition' is set either set to the option 'yes'
               or to the option 'both', then add these to the $node. */
            if (((self::get_setting('incoursesettingsswitchtoroleposition') == 'yes') ||
                (self::get_setting('incoursesettingsswitchtoroleposition') == 'both')) &&
                !is_role_switched($COURSE->id)) {
                /* Build switch role link
                   We could only access the existing menu item by creating the user menu and traversing it.
                   So we decided to create this node from scratch with the values copied from Moodle core. */
                $roles = get_switchable_roles($PAGE->context);
                if (is_array($roles) && (count($roles) > 0)) {
                    // Define the properties for a new tab.
                    $properties = array('text' => get_string('switchroleto', 'theme_campus'),
                        'type' => \navigation_node::TYPE_CONTAINER,
                        'key'  => 'switchroletotab');
                    // Create the node.
                    $switchroletabnode = new \navigation_node($properties);
                    // Add the tab to the course administration node.
                    $node->add_node($switchroletabnode);
                    // Add the available roles as children nodes to the tab content.
                    foreach ($roles as $key => $role) {
                        $properties = array('action' => new \moodle_url('/course/switchrole.php',
                            array(
                                'id'         => $COURSE->id,
                                'switchrole' => $key,
                                'returnurl'  => $PAGE->url->out_as_local_url(false),
                                'sesskey'    => sesskey())),
                                'type'   => \navigation_node::TYPE_CUSTOM,
                                'text'   => $role);
                        $switchroletabnode->add_node(new \navigation_node($properties));
                    }
                }
            }
            return $node;
        }
    }

    /**
     * Provides the node for the in-course settings for other contexts.
     *
     * Adapted from the Boost_Campus theme.
     *
     * @copyright 2017 Kathrin Osswald, Ulm University kathrin.osswald@uni-ulm.de
     * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
     *
     * @return navigation_node.
     */
    public static function get_incourse_activity_settings() {
        global $PAGE;
        $context = $PAGE->context;
        $node = false;
        // If setting showsettingsincourse is enabled.
        if (self::get_setting('showsettingsincourse') == 'yes') {
            // Settings belonging to activity or resources.
            if ($context->contextlevel == CONTEXT_MODULE) {
                $node = $PAGE->settingsnav->find('modulesettings', \navigation_node::TYPE_SETTING);
            } else if ($context->contextlevel == CONTEXT_COURSECAT) {
                // For course category context, show category settings menu, if we're on the course category page.
                if ($PAGE->pagetype === 'course-index-category') {
                    $node = $PAGE->settingsnav->find('categorysettings', \navigation_node::TYPE_CONTAINER);
                }
            } else {
                $node = false;
            }
        }
        return $node;
    }
}
