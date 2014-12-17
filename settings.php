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

defined('MOODLE_INTERNAL') || die;

if ($ADMIN->fulltree) {

    /* CDN Fonts - 1 = no, 2 = yes. */
    $name = 'theme_campus/cdnfonts';
    $title = get_string('cdnfonts', 'theme_campus');
    $description = get_string('cdnfonts_desc', 'theme_campus');
    $default = 1;
    $choices = array(
        1 => new lang_string('no'),   // No.
        2 => new lang_string('yes')   // Yes.
    );
    $settings->add(new admin_setting_configselect($name, $title, $description, $default, $choices));

    // Invert Navbar to dark background.
    $name = 'theme_campus/invert';
    $title = get_string('invert', 'theme_campus');
    $description = get_string('invertdesc', 'theme_campus');
    $setting = new admin_setting_configcheckbox($name, $title, $description, 0);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settings->add($setting);

    // Logo file setting.
    $name = 'theme_campus/logo';
    $title = get_string('logo','theme_campus');
    $description = get_string('logodesc', 'theme_campus');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'logo');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settings->add($setting);

    // Number of footer blocks.
    $name = 'theme_campus/numfooterblocks';
    $title = get_string('numfooterblocks','theme_campus');
    $description = get_string('numfooterblocksdesc', 'theme_campus');
    $choices = array(
        1 => new lang_string('one', 'theme_campus'),
        2 => new lang_string('two', 'theme_campus'),
        3 => new lang_string('three', 'theme_campus'),
        4 => new lang_string('four', 'theme_campus')
    );
    $default = 2;
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $settings->add($setting);

    // Custom CSS file.
    $name = 'theme_campus/customcss';
    $title = get_string('customcss', 'theme_campus');
    $description = get_string('customcssdesc', 'theme_campus');
    $default = '';
    $setting = new admin_setting_configtextarea($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settings->add($setting);

    // Footnote setting.
    $name = 'theme_campus/footnote';
    $title = get_string('footnote', 'theme_campus');
    $description = get_string('footnotedesc', 'theme_campus');
    $default = '';
    $setting = new admin_setting_confightmleditor($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settings->add($setting);
}
