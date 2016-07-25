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
 * @copyright  &copy; 2016-onwards G J Barnard in respect to modifications of the Clean theme.
 * @copyright  &copy; 2016-onwards Work undertaken for David Bogner of Edulabs.org.
 * @author     G J Barnard - gjbarnard at gmail dot com and {@link http://moodle.org/user/profile.php?id=442195}
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
    static public function get_setting($setting, $format = false, $theme = null) {

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
    static public function get_config_setting($setting, $themename = null) {
        if (empty($themename)) {
            $themename = 'campus';
        }
        return \get_config('theme_' . $themename, $setting);
    }

    static public function change_icons() {
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
            } else if (!empty($CFG->themedir) and file_exists("$CFG->themedir/campus")) {
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

    static private function svg_files(&$files, $root) {
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
                } else if (strpos($filename, '.svg') !== FALSE) { // TODO: See if 'finfo_file' is better.
                    $files[] = $root . '/' . $filename;
                }
            }
        }
    }
}
