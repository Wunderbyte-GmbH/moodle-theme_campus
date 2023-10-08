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
 * @copyright  &copy; 2014-onwards G J Barnard.
 * @copyright  &copy; 2014-onwards Work undertaken for David Bogner of Edulabs.org.
 * @copyright  &copy; 2020-onwards Work undertaken for David Bogner of Wunderbyte.at.
 * @author     G J Barnard - {@link http://moodle.org/user/profile.php?id=442195}
 * @author     Based on code originally written by Mary Evans, Bas Brands, Stuart Lamour and David Scotson.
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

if ($ADMIN->fulltree) {
    $settings = new theme_boost_admin_settingspage_tabs('themesettingcampus', get_string('configtitle', 'theme_campus'));

    // Generic settings.
    $settingpage = new admin_settingpage('theme_campus_generic', get_string('genericsettings', 'theme_campus'));
    global $CFG;
    if (file_exists("{$CFG->dirroot}/theme/campus/admin_setting_configinteger.php")) {
        require_once($CFG->dirroot . '/theme/campus/admin_setting_configinteger.php');
    } else if (!empty($CFG->themedir) && file_exists("{$CFG->themedir}/campus/admin_setting_configinteger.php")) {
        require_once($CFG->themedir . '/campus/admin_setting_configinteger.php');
    }

    $settingpage->add(new admin_setting_heading(
        'theme_campus_generalheading',
        null,
        format_text(get_string('generalheadingdesc', 'theme_campus'), FORMAT_MARKDOWN)
    ));

    // Login alternative URL setting.
    $name = 'theme_campus/alternateloginurl';
    $title = get_string('alternateloginurl', 'theme_campus');
    $description = get_string('alternateloginurldesc', 'theme_campus');
    $default = 0;
    $sql = "SELECT DISTINCT h.id, h.wwwroot, h.name, a.sso_jump_url, a.name as application
            FROM {mnet_host} h
            JOIN {mnet_host2service} m ON h.id = m.hostid
            JOIN {mnet_service} s ON s.id = m.serviceid
            JOIN {mnet_application} a ON h.applicationid = a.id
            WHERE s.name = ? AND h.deleted = ? AND m.publish = ?";
    $params = ['sso_sp', 0, 1];

    if (!empty($CFG->mnet_all_hosts_id)) {
        $sql .= " AND h.id <> ?";
        $params[] = $CFG->mnet_all_hosts_id;
    }

    if ($hosts = $DB->get_records_sql($sql, $params)) {
        $choices = [];
        $choices[0] = 'notset';
        foreach ($hosts as $id => $host) {
            $choices[$id] = $host->name;
        }
    } else {
        $choices = [];
        $choices[0] = 'notset';
    }
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    // No CSS change, so no need to reset caches.
    $settingpage->add($setting);

    // Hide local login on login page.
    $name = 'theme_campus/hidelocallogin';
    $title = get_string('hidelocallogin', 'theme_campus');
    $description = get_string('hidelocallogindesc', 'theme_campus');
    $default = false;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default, true, false);
    // No CSS change, so no need to reset caches.
    $settingpage->add($setting);

    // Show login info header.
    $name = 'theme_campus/showlogininfoheader';
    $title = get_string('showlogininfoheader', 'theme_campus');
    $description = get_string('showlogininfoheaderdesc', 'theme_campus');
    $default = true;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default, true, false);
    // No CSS change, so no need to reset caches.
    $settingpage->add($setting);

    // Show login info footer.
    $name = 'theme_campus/showlogininfofooter';
    $title = get_string('showlogininfofooter', 'theme_campus');
    $description = get_string('showlogininfofooterdesc', 'theme_campus');
    $default = true;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default, true, false);
    // No CSS change, so no need to reset caches.
    $settingpage->add($setting);

    // Favicon file setting.
    $name = 'theme_campus/favicon';
    $title = get_string('favicon', 'theme_campus');
    $description = get_string('favicondesc', 'theme_campus');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'favicon');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settingpage->add($setting);

    // Number of course blocks.
    $name = 'theme_campus/numcourseblocks';
    $title = get_string('numcourseblocks', 'theme_campus');
    $description = get_string('numcourseblocksdesc', 'theme_campus');
    $choices = [
        1 => new lang_string('one', 'theme_campus'),
        2 => new lang_string('two', 'theme_campus'),
        3 => new lang_string('three', 'theme_campus'),
        4 => new lang_string('four', 'theme_campus'),
    ];
    $default = 2;
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    // No CSS change, so no need to reset caches.
    $settingpage->add($setting);

    // Custom CSS.
    $name = 'theme_campus/customcss';
    $title = get_string('customcss', 'theme_campus');
    $description = get_string('customcssdesc', 'theme_campus');
    $default = '';
    $setting = new admin_setting_configtextarea($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settingpage->add($setting);

    // Must add the page after defining all the settings!
    $settings->add($settingpage);

    // Look and feel settings.
    $settingpage = new admin_settingpage('theme_campus_landf', get_string('landfsettings', 'theme_campus'));
    $settingpage->add(new admin_setting_heading(
        'theme_campus_landfheading',
        null,
        format_text(get_string('landfheadingdesc', 'theme_campus'), FORMAT_MARKDOWN)
    ));

    // Page width maximum.
    $name = 'theme_campus/pagewidthmax';
    $title = get_string('pagewidthmax', 'theme_campus');
    $description = get_string('pagewidthmaxdesc', 'theme_campus');
    $default = '1680';
    $choices = [
        '1000' => new lang_string('px1000', 'theme_campus'),
        '1200' => new lang_string('px1200', 'theme_campus'),
        '1400' => new lang_string('px1400', 'theme_campus'),
        '1680' => new lang_string('px1680', 'theme_campus'),
        '100' => new lang_string('per100', 'theme_campus'),
    ];
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settingpage->add($setting);
    $currentpagewidthmaxheaders = get_config('theme_campus', 'pagewidthmax');  // Current value for other setting information descriptions below.
    if ($currentpagewidthmaxheaders == 100) { // Percentage value.
        $currentpagewidthmaxheaders = 1680; // Default for headers as need px max width.
    }

    // Heading font.
    $name = 'theme_campus/headingfont';
    $title = get_string('headingfont', 'theme_campus');
    $description = get_string('headingfontdesc', 'theme_campus');
    $default = 'Roboto Condensed';
    $choices = [
        'Droid Serif' => 'Droid Serif',
        'EB Garamond' => 'EB Garamond',
        'Jura' => 'Jura',
        'Nunito' => 'Nunito',
        'Roboto Condensed' => 'Roboto Condensed',
        'Source Sans Pro' => 'Source Sans Pro',
        'Titillium Text' => 'Titillium Text',
        'Ubuntu' => 'Ubuntu',
        'Vollkorn' => 'Vollkorn',
    ];
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settingpage->add($setting);

    // Body font.
    $name = 'theme_campus/bodyfont';
    $title = get_string('bodyfont', 'theme_campus');
    $description = get_string('bodyfontdesc', 'theme_campus');
    $default = 'Questrial';
    $choices = [
        'Open Sans' => 'Open Sans',
        'Questrial' => 'Questrial',
        'Roboto Condensed' => 'Roboto Condensed',
        'Source Sans Pro' => 'Source Sans Pro',
    ];
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settingpage->add($setting);

    // Text colour setting.
    $name = 'theme_campus/textcolour';
    $title = get_string('textcolour', 'theme_campus');
    $description = get_string('textcolourdesc', 'theme_campus');
    $default = '#333333';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settingpage->add($setting);

    // Link colour setting.
    $name = 'theme_campus/linkcolour';
    $title = get_string('linkcolour', 'theme_campus');
    $description = get_string('linkcolourdesc', 'theme_campus');
    $default = '#333333';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settingpage->add($setting);

    // Content colour setting.
    $name = 'theme_campus/contentcolour';
    $title = get_string('contentcolour', 'theme_campus');
    $description = get_string('contentcolourdesc', 'theme_campus');
    $default = '#ffffff';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settingpage->add($setting);

    // Heading colour setting.
    $name = 'theme_campus/headingcolour';
    $title = get_string('headingcolour', 'theme_campus');
    $description = get_string('headingcolourdesc', 'theme_campus');
    $default = '#555555';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settingpage->add($setting);

    // Navbar text colour setting.
    $name = 'theme_campus/navbartextcolour';
    $title = get_string('navbartextcolour', 'theme_campus');
    $description = get_string('navbartextcolourdesc', 'theme_campus');
    $default = '#eeeeee';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settingpage->add($setting);

    // Navbar link colour setting.
    $name = 'theme_campus/navbarlinkcolour';
    $title = get_string('navbarlinkcolour', 'theme_campus');
    $description = get_string('navbarlinkcolourdesc', 'theme_campus');
    $default = '#eeeeee';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settingpage->add($setting);

    // Navbar icon colour setting.
    $name = 'theme_campus/navbariconcolour';
    $title = get_string('navbariconcolour', 'theme_campus');
    $description = get_string('navbariconcolourdesc', 'theme_campus');
    $default = '#eeeeee';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settingpage->add($setting);

    // Navbar background colour setting.
    $name = 'theme_campus/navbarbackgroundcolour';
    $title = get_string('navbarbackgroundcolour', 'theme_campus');
    $description = get_string('navbarbackgroundcolourdesc', 'theme_campus');
    $default = '#ec8600';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settingpage->add($setting);

    // Block heading colour setting.
    $name = 'theme_campus/blockheadingcolour';
    $title = get_string('blockheadingcolour', 'theme_campus');
    $description = get_string('blockheadingcolourdesc', 'theme_campus');
    $default = '#190300';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settingpage->add($setting);

    // Block heading background colour setting.
    $name = 'theme_campus/blockheadingbackgroundcolour';
    $title = get_string('blockheadingbackgroundcolour', 'theme_campus');
    $description = get_string('blockheadingbackgroundcolourdesc', 'theme_campus');
    $default = '#a1d6de';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settingpage->add($setting);

    // Block background colour setting.
    $name = 'theme_campus/blockbackgroundcolour';
    $title = get_string('blockbackgroundcolour', 'theme_campus');
    $description = get_string('blockbackgroundcolourdesc', 'theme_campus');
    $default = '#ffffff';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settingpage->add($setting);

    // Block border options.
    $name = 'theme_campus/blockborderoptions';
    $title = get_string('blockborderoptions', 'theme_campus');
    $description = get_string('blockborderoptionsdesc', 'theme_campus');
    $default = 2;
    $choices = [
        1 => new lang_string('blocknoborder', 'theme_campus'),
        2 => new lang_string('blockborderall', 'theme_campus'),
        3 => new lang_string('blockborderheader', 'theme_campus'),
        4 => new lang_string('blockbordercontent', 'theme_campus'),
        5 => new lang_string('blockborderthreelines', 'theme_campus'),
    ];
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settingpage->add($setting);

    // Block border colour setting.
    $name = 'theme_campus/blockbordercolour';
    $title = get_string('blockbordercolour', 'theme_campus');
    $description = get_string('blockbordercolourdesc', 'theme_campus');
    $default = '#a1d6de';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settingpage->add($setting);

    // Block border thickness.
    $name = 'theme_campus/blockborderthickness';
    $title = get_string('blockborderthickness', 'theme_campus');
    $description = get_string('blockborderthicknessdesc', 'theme_campus');
    $default = '2px';
    $choices = [
        '1px' => new lang_string('px01', 'theme_campus'),
        '2px' => new lang_string('px02', 'theme_campus'),
        '3px' => new lang_string('px03', 'theme_campus'),
        '4px' => new lang_string('px04', 'theme_campus'),
        '5px' => new lang_string('px05', 'theme_campus'),
        '6px' => new lang_string('px06', 'theme_campus'),
        '7px' => new lang_string('px07', 'theme_campus'),
        '8px' => new lang_string('px08', 'theme_campus'),
        '9px' => new lang_string('px09', 'theme_campus'),
        '10px' => new lang_string('px10', 'theme_campus'),
    ];
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settingpage->add($setting);

    // Block border style.
    $name = 'theme_campus/blockborderstyle';
    $title = get_string('blockborderstyle', 'theme_campus');
    $description = get_string('blockborderstyledesc', 'theme_campus');
    $default = 'solid';
    $choices = [
        'none' => new lang_string('blockborderstylenone', 'theme_campus'),
        'hidden' => new lang_string('blockborderstylehidden', 'theme_campus'),
        'dotted' => new lang_string('blockborderstyledotted', 'theme_campus'),
        'dashed' => new lang_string('blockborderstyledashed', 'theme_campus'),
        'solid' => new lang_string('blockborderstylesolid', 'theme_campus'),
        'double' => new lang_string('blockborderstyledouble', 'theme_campus'),
        'groove' => new lang_string('blockborderstylegroove', 'theme_campus'),
        'ridge' => new lang_string('blockborderstylenridge', 'theme_campus'),
        'inset' => new lang_string('blockborderstyleninset', 'theme_campus'),
        'outset' => new lang_string('blockborderstylenoutset', 'theme_campus'),
    ];
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settingpage->add($setting);

    // Theme colour setting.
    $name = 'theme_campus/themecolour';
    $title = get_string('themecolour', 'theme_campus');
    $description = get_string('themecolourdesc', 'theme_campus');
    $default = '#263683';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settingpage->add($setting);

    // Theme background colour setting.
    $name = 'theme_campus/themebackgroundcolour';
    $title = get_string('themebackgroundcolour', 'theme_campus');
    $description = get_string('themebackgroundcolourdesc', 'theme_campus');
    $default = '#ffffff';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settingpage->add($setting);

    // Forum header text colour setting.
    $name = 'theme_campus/forumheadertextcolour';
    $title = get_string('forumheadertextcolour', 'theme_campus');
    $description = get_string('forumheadertextcolourdesc', 'theme_campus');
    $default = '#333333';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settingpage->add($setting);

    // Small border radius.
    $name = 'theme_campus/borderradiussmall';
    $title = get_string('borderradiussmall', 'theme_campus');
    $description = get_string('borderradiussmall_desc', 'theme_campus');
    $default = '3px';
    $choices = [
        '0px' => new lang_string('px00', 'theme_campus'),
        '1px' => new lang_string('px01', 'theme_campus'),
        '2px' => new lang_string('px02', 'theme_campus'),
        '3px' => new lang_string('px03', 'theme_campus'),
        '4px' => new lang_string('px04', 'theme_campus'),
        '5px' => new lang_string('px05', 'theme_campus'),
        '6px' => new lang_string('px06', 'theme_campus'),
        '7px' => new lang_string('px07', 'theme_campus'),
        '8px' => new lang_string('px08', 'theme_campus'),
        '9px' => new lang_string('px09', 'theme_campus'),
        '10px' => new lang_string('px10', 'theme_campus'),
        '11px' => new lang_string('px11', 'theme_campus'),
        '12px' => new lang_string('px12', 'theme_campus'),
        '13px' => new lang_string('px13', 'theme_campus'),
        '14px' => new lang_string('px14', 'theme_campus'),
        '15px' => new lang_string('px15', 'theme_campus'),
        '16px' => new lang_string('px16', 'theme_campus'),
        '17px' => new lang_string('px17', 'theme_campus'),
        '18px' => new lang_string('px18', 'theme_campus'),
        '19px' => new lang_string('px19', 'theme_campus'),
        '20px' => new lang_string('px20', 'theme_campus'),
        '21px' => new lang_string('px21', 'theme_campus'),
        '22px' => new lang_string('px22', 'theme_campus'),
        '23px' => new lang_string('px23', 'theme_campus'),
        '24px' => new lang_string('px24', 'theme_campus'),
        '25px' => new lang_string('px25', 'theme_campus'),
    ];
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settingpage->add($setting);

    // Medium border radius.
    $name = 'theme_campus/borderradiusmedium';
    $title = get_string('borderradiusmedium', 'theme_campus');
    $description = get_string('borderradiusmedium_desc', 'theme_campus');
    $default = '6px';
    $choices = [
        '0px' => new lang_string('px00', 'theme_campus'),
        '1px' => new lang_string('px01', 'theme_campus'),
        '2px' => new lang_string('px02', 'theme_campus'),
        '3px' => new lang_string('px03', 'theme_campus'),
        '4px' => new lang_string('px04', 'theme_campus'),
        '5px' => new lang_string('px05', 'theme_campus'),
        '6px' => new lang_string('px06', 'theme_campus'),
        '7px' => new lang_string('px07', 'theme_campus'),
        '8px' => new lang_string('px08', 'theme_campus'),
        '9px' => new lang_string('px09', 'theme_campus'),
        '10px' => new lang_string('px10', 'theme_campus'),
        '11px' => new lang_string('px11', 'theme_campus'),
        '12px' => new lang_string('px12', 'theme_campus'),
        '13px' => new lang_string('px13', 'theme_campus'),
        '14px' => new lang_string('px14', 'theme_campus'),
        '15px' => new lang_string('px15', 'theme_campus'),
        '16px' => new lang_string('px16', 'theme_campus'),
        '17px' => new lang_string('px17', 'theme_campus'),
        '18px' => new lang_string('px18', 'theme_campus'),
        '19px' => new lang_string('px19', 'theme_campus'),
        '20px' => new lang_string('px20', 'theme_campus'),
        '21px' => new lang_string('px21', 'theme_campus'),
        '22px' => new lang_string('px22', 'theme_campus'),
        '23px' => new lang_string('px23', 'theme_campus'),
        '24px' => new lang_string('px24', 'theme_campus'),
        '25px' => new lang_string('px25', 'theme_campus'),
    ];
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settingpage->add($setting);

    // Large border radius.
    $name = 'theme_campus/borderradiuslarge';
    $title = get_string('borderradiuslarge', 'theme_campus');
    $description = get_string('borderradiuslarge_desc', 'theme_campus');
    $default = '8px';
    $choices = [
        '0px' => new lang_string('px00', 'theme_campus'),
        '1px' => new lang_string('px01', 'theme_campus'),
        '2px' => new lang_string('px02', 'theme_campus'),
        '3px' => new lang_string('px03', 'theme_campus'),
        '4px' => new lang_string('px04', 'theme_campus'),
        '5px' => new lang_string('px05', 'theme_campus'),
        '6px' => new lang_string('px06', 'theme_campus'),
        '7px' => new lang_string('px07', 'theme_campus'),
        '8px' => new lang_string('px08', 'theme_campus'),
        '9px' => new lang_string('px09', 'theme_campus'),
        '10px' => new lang_string('px10', 'theme_campus'),
        '11px' => new lang_string('px11', 'theme_campus'),
        '12px' => new lang_string('px12', 'theme_campus'),
        '13px' => new lang_string('px13', 'theme_campus'),
        '14px' => new lang_string('px14', 'theme_campus'),
        '15px' => new lang_string('px15', 'theme_campus'),
        '16px' => new lang_string('px16', 'theme_campus'),
        '17px' => new lang_string('px17', 'theme_campus'),
        '18px' => new lang_string('px18', 'theme_campus'),
        '19px' => new lang_string('px19', 'theme_campus'),
        '20px' => new lang_string('px20', 'theme_campus'),
        '21px' => new lang_string('px21', 'theme_campus'),
        '22px' => new lang_string('px22', 'theme_campus'),
        '23px' => new lang_string('px23', 'theme_campus'),
        '24px' => new lang_string('px24', 'theme_campus'),
        '25px' => new lang_string('px25', 'theme_campus'),
    ];
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settingpage->add($setting);

    // Must add the page after defining all the settings!
    $settings->add($settingpage);

    // Header settings.
    $settingpage = new admin_settingpage('theme_campus_header', get_string('headersettings', 'theme_campus'));
    $settingpage->add(new admin_setting_heading(
        'theme_campus_headerheading',
        null,
        format_text(get_string('headerheadingdesc', 'theme_campus'), FORMAT_MARKDOWN)
    ));

    // Invert Navbar to dark background.
    $name = 'theme_campus/invert';
    $title = get_string('invert', 'theme_campus');
    $description = get_string('invertdesc', 'theme_campus');
    $setting = new admin_setting_configcheckbox($name, $title, $description, 0);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settingpage->add($setting);

    // Navbar type.
    $name = 'theme_campus/navbartype';
    $title = get_string('navbartype', 'theme_campus');
    $description = get_string('navbartypedesc', 'theme_campus');
    $default = 1;
    $choices = [
        1 => new lang_string('standardnavbar', 'theme_campus'),
        2 => new lang_string('fancynavbar', 'theme_campus'),
    ];
    // No CSS change, so no need to reset caches.
    $settingpage->add(new admin_setting_configselect($name, $title, $description, $default, $choices));

    // Page heading range.
    $name = 'theme_campus/navbarpageheadingmax';
    $title = get_string('navbarpageheadingmax', 'theme_campus');
    $default = 200;
    $lower = 40;
    $upper = 400;
    $description = get_string('navbarpageheadingmaxdesc', 'theme_campus', ['lower' => $lower, 'upper' => $upper]);
    $setting = new admin_setting_configinteger($name, $title, $description, $default, $lower, $upper);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settingpage->add($setting);

    // Course and category page heading position setting.
    $name = 'theme_campus/coursepagepageheadinglocation';
    $title = get_string('coursepagepageheadinglocation', 'theme_campus');
    $description = get_string('coursepagepageheadinglocationdesc', 'theme_campus');
    $default = 1;
    $choices = [
        1 => new lang_string('pageheadinglocationnavbar', 'theme_campus'),
        3 => new lang_string('pageheadinglocationpagecontenttop', 'theme_campus'),
        4 => new lang_string('pageheadinglocationheaderarea', 'theme_campus'),
    ];
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $settingpage->add($setting);

    // Show system area name in the breadcrumb.
    $name = 'theme_campus/showsysteminbreadcrumb';
    $title = get_string('showsysteminbreadcrumb', 'theme_campus');
    $description = get_string('showsysteminbreadcrumbdesc', 'theme_campus');
    $default = true;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default, true, false);
    // No CSS change, so no need to reset caches.
    $settingpage->add($setting);

    // Show section name in the breadcrumb.
    $name = 'theme_campus/showsectioninbreadcrumb';
    $title = get_string('showsectioninbreadcrumb', 'theme_campus');
    $description = get_string('showsectioninbreadcrumbdesc', 'theme_campus');
    $default = true;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default, true, false);
    // No CSS change, so no need to reset caches.
    $settingpage->add($setting);

    // Settings title for grouping course settings related aspects together.
    $name = 'theme_campus/coursesettingsheading';
    $title = get_string('coursesettingsheadingsetting', 'theme_campus');
    $setting = new admin_setting_heading($name, $title, null);
    $settingpage->add($setting);

    // Setting to display the course settings page as a panel within the course.
    $name = 'theme_campus/showsettingsincourse';
    $title = get_string('showsettingsincoursesetting', 'theme_campus');
    $description = get_string('showsettingsincoursesetting_desc', 'theme_campus');
    $setting = new admin_setting_configcheckbox($name, $title, $description, 'no', 'yes', 'no'); // Overriding default values.
    /* yes = 1 and no = 0 because of the use of empty() in theme_boost_campus_get_pre_scss() (lib.php).
       Default 0 value would not write the variable to scss that could cause the scss to crash if used in that file.
       See MDL-58376.*/
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settingpage->add($setting);

    // Setting to display the switch role to link as a separate tab within the in-course settings panel.
    $name = 'theme_campus/incoursesettingsswitchtoroleposition';
    $title = get_string('incoursesettingsswitchtorolepositionsetting', 'theme_campus');
    $description = get_string('incoursesettingsswitchtorolepositionsetting_desc', 'theme_campus');
    $incoursesettingsswitchtorolesetting = [
        'no' => get_string('incoursesettingsswitchtorolesettingjustmenu', 'theme_campus'),
        'yes' => get_string('incoursesettingsswitchtorolesettingjustcourse', 'theme_campus'),
        'both' => get_string('incoursesettingsswitchtorolesettingboth', 'theme_campus'),
    ];
    $setting = new admin_setting_configselect(
        $name,
        $title,
        $description,
        $incoursesettingsswitchtorolesetting['no'],
        $incoursesettingsswitchtorolesetting
    );
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settingpage->add($setting);
    $settingpage->hide_if(
        'theme_campus/incoursesettingsswitchtoroleposition',
        'theme_campus/showsettingsincourse',
        'notchecked'
    );

    // Frontpage header settings.
    $settingpage->add(new admin_setting_heading(
        'theme_campus_frontpage',
        get_string('frontpageheadersettings', 'theme_campus'),
        format_text(get_string('frontpageheadersettings_desc', 'theme_campus'), FORMAT_MARKDOWN)
    ));

    // Have a custom front page header.
    $name = 'theme_campus/usefrontpageheader';
    $title = get_string('usefrontpageheader', 'theme_campus');
    $description = get_string('usefrontpageheaderdesc', 'theme_campus');
    $setting = new admin_setting_configcheckbox($name, $title, $description, 1);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settingpage->add($setting);

    // Frontpage layout setting.
    $name = 'theme_campus/frontpagelayout';
    $title = get_string('frontpagelayout', 'theme_campus');
    $description = get_string('frontpagelayoutdesc', 'theme_campus');
    $default = 'flexlayout';
    $choices = [
        'absolutelayout' => new lang_string('layoutontop', 'theme_campus'),
        'flexlayout' => new lang_string('layoutonside', 'theme_campus'),
    ];
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settingpage->add($setting);

    // Logo file setting.
    $name = 'theme_campus/frontpagelogo';
    $title = get_string('frontpagelogo', 'theme_campus');
    $description = get_string('frontpagelogodesc', 'theme_campus', ['pagewidthmax' => $currentpagewidthmaxheaders]);
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'frontpagelogo');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settingpage->add($setting);

    // Logo file setting on small devices.
    $name = 'theme_campus/frontpageresponsivelogo';
    $title = get_string('frontpageresponsivelogo', 'theme_campus');
    $description = get_string('frontpageresponsivelogodesc', 'theme_campus');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'frontpageresponsivelogo');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settingpage->add($setting);

    // Logo position setting.
    $name = 'theme_campus/frontpagelogoposition';
    $title = get_string('frontpagelogoposition', 'theme_campus');
    $description = get_string('frontpagelogopositiondesc', 'theme_campus');
    $default = 2;
    $choices = [
        1 => new lang_string('imageleft', 'theme_campus'),
        2 => new lang_string('imageright', 'theme_campus'),
    ];
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settingpage->add($setting);

    // Background image file setting.
    $name = 'theme_campus/frontpagebackgroundimage';
    $title = get_string('frontpagebackgroundimage', 'theme_campus');
    $description = get_string(
        'frontpagebackgroundimagedesc',
        'theme_campus',
        ['pagewidthmax' => $currentpagewidthmaxheaders]
    );
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'frontpagebackgroundimage');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settingpage->add($setting);

    // Background image file setting on small devices.
    $name = 'theme_campus/frontpageresponsivebackgroundimage';
    $title = get_string('frontpageresponsivebackgroundimage', 'theme_campus');
    $description = get_string('frontpageresponsivebackgroundimagedesc', 'theme_campus');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'frontpageresponsivebackgroundimage');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settingpage->add($setting);

    // Frontpage heading position setting.
    $name = 'theme_campus/frontpagepageheadinglocation';
    $title = get_string('frontpagepageheadinglocation', 'theme_campus');
    $description = get_string('frontpagepageheadinglocationdesc', 'theme_campus');
    $default = 1;
    $choices = [
        1 => new lang_string('pageheadinglocationnavbar', 'theme_campus'),
        2 => new lang_string('pageheadinglocationunderneathnavbar', 'theme_campus'),
        3 => new lang_string('pageheadinglocationpagecontenttop', 'theme_campus'),
        4 => new lang_string('pageheadinglocationheaderarea', 'theme_campus'),
    ];
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $settingpage->add($setting);

    $settingpage->add(new admin_setting_heading(
        'theme_campus_coursecategory',
        get_string('coursecategoryhavecustomheaderheader', 'theme_campus'),
        format_text(get_string('coursecategoryhavecustomheaderheader_desc', 'theme_campus'), FORMAT_MARKDOWN)
    ));

    if (file_exists("{$CFG->dirroot}/theme/campus/campus-lib.php")) {
        include_once($CFG->dirroot . '/theme/campus/campus-lib.php');
    } else if (!empty($CFG->themedir) && file_exists("{$CFG->themedir}/campus/campus-lib.php")) {
        include_once($CFG->themedir . '/campus/campus-lib.php');
    }
    $campuscategorytree = theme_campus_get_top_level_categories();
    foreach ($campuscategorytree as $key => $value) {
        // Have a custom header for the course category.
        $name = 'theme_campus/coursecategoryhavecustomheader' . $key;
        $title = get_string('coursecategoryhavecustomheader', 'theme_campus', ['categoryname' => $value]);
        $description = get_string('coursecategoryhavecustomheaderdesc', 'theme_campus', ['categoryname' => $value]);
        $setting = new admin_setting_configcheckbox($name, $title, $description, 0);
        $setting->set_updatedcallback('theme_reset_all_caches');  // CSS change to generate extra selectors if turning on for a new category for the first time.
        $settingpage->add($setting);
    }

    // Must add the page after defining all the settings!
    $settings->add($settingpage);

    // Course category header settings.
    $settingpage = new admin_settingpage(
        'theme_campus_category_header',
        get_string('coursecategoryheadersettings', 'theme_campus')
    );
    $settingpage->add(new admin_setting_heading(
        'theme_campus_category_header_heading',
        null,
        format_text(get_string('coursecategoryheadersettings_desc', 'theme_campus'), FORMAT_MARKDOWN)
    ));

    $havecategories = false;
    foreach ($campuscategorytree as $key => $value) {
        $havecustomheader = get_config('theme_campus', 'coursecategoryhavecustomheader' . $key);
        if (empty($havecustomheader)) {
            continue;
        }
        $havecategories = true;

        $name = 'theme_campus/coursecategoryheading' . $key;
        $heading = get_string('coursecategoryheading', 'theme_campus', ['categoryname' => $value]);
        $information = '';
        $setting = new admin_setting_heading($name, $heading, $information);
        // No CSS change, so no need to reset caches.
        $settingpage->add($setting);

        // Background colour.
        $name = 'theme_campus/coursecategorybgcolour' . $key;
        $title = get_string('coursecategorybgcolour', 'theme_campus');
        $description = get_string('coursecategorybgcolourdesc', 'theme_campus', ['categoryname' => $value]);
        $default = '#11847D';
        $previewconfig = null;
        $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
        $setting->set_updatedcallback('theme_reset_all_caches');
        $settingpage->add($setting);

        // Course category layout setting.
        $name = 'theme_campus/coursecategorylayout' . $key;
        $title = get_string('coursecategorylayout', 'theme_campus');
        $description = get_string('coursecategorylayoutdesc', 'theme_campus');
        $default = 'flexlayout';
        $choices = [
            'absolutelayout' => new lang_string('layoutontop', 'theme_campus'),
            'flexlayout' => new lang_string('layoutonside', 'theme_campus'),
        ];
        $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
        $setting->set_updatedcallback('theme_reset_all_caches');
        $settingpage->add($setting);

        // Logo file setting.
        $name = 'theme_campus/coursecategorylogo' . $key;
        $title = get_string('coursecategorylogo', 'theme_campus');
        $description = get_string(
            'coursecategorylogodesc',
            'theme_campus',
            ['pagewidthmax' => $currentpagewidthmaxheaders]
        );
        $setting = new admin_setting_configstoredfile($name, $title, $description, 'coursecategorylogo' . $key);
        $setting->set_updatedcallback('theme_reset_all_caches');
        $settingpage->add($setting);

        // Logo file setting on small devices.
        $name = 'theme_campus/coursecategoryresponsivelogo' . $key;
        $title = get_string('coursecategoryresponsivelogo', 'theme_campus');
        $description = get_string('coursecategoryresponsivelogodesc', 'theme_campus');
        $setting = new admin_setting_configstoredfile($name, $title, $description, 'coursecategoryresponsivelogo' . $key);
        $setting->set_updatedcallback('theme_reset_all_caches');
        $settingpage->add($setting);

        // Logo position setting.
        $name = 'theme_campus/coursecategorylogoposition' . $key;
        $title = get_string('coursecategorylogoposition', 'theme_campus');
        $description = get_string('coursecategorylogopositiondesc', 'theme_campus');
        $default = 2;
        $choices = [
            1 => new lang_string('imageleft', 'theme_campus'),
            2 => new lang_string('imageright', 'theme_campus'),
        ];
        $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
        $setting->set_updatedcallback('theme_reset_all_caches');
        $settingpage->add($setting);

        // Background image file setting.
        $name = 'theme_campus/coursecategorybackgroundimage' . $key;
        $title = get_string('coursecategorybackgroundimage', 'theme_campus');
        $description = get_string(
            'coursecategorybackgroundimagedesc',
            'theme_campus',
            ['pagewidthmax' => $currentpagewidthmaxheaders]
        );
        $setting = new admin_setting_configstoredfile(
            $name,
            $title,
            $description,
            'coursecategorybackgroundimage' . $key
        );
        $setting->set_updatedcallback('theme_reset_all_caches');
        $settingpage->add($setting);

        // Background image file setting on small devices.
        $name = 'theme_campus/coursecategoryresponsivebackgroundimage' . $key;
        $title = get_string('coursecategoryresponsivebackgroundimage', 'theme_campus');
        $description = get_string('coursecategoryresponsivebackgroundimagedesc', 'theme_campus');
        $setting = new admin_setting_configstoredfile(
            $name,
            $title,
            $description,
            'coursecategoryresponsivebackgroundimage' . $key
        );
        $setting->set_updatedcallback('theme_reset_all_caches');
        $settingpage->add($setting);
    }
    if ($havecategories == false) {
        $settingpage->add(new admin_setting_heading(
            'theme_campus_category_header_none_heading',
            null,
            format_text(get_string('coursecategoryhavecustomheadernone', 'theme_campus'), FORMAT_MARKDOWN)
        ));
    }

    // Must add the page after defining all the settings!
    $settings->add($settingpage);

    // Footer settings.
    $settingpage = new admin_settingpage('theme_campus_footer', get_string('footersettings', 'theme_campus'));
    $settingpage->add(new admin_setting_heading(
        'theme_campus_footerheading',
        null,
        format_text(get_string('footerheadingdesc', 'theme_campus'), FORMAT_MARKDOWN)
    ));

    // Number of footer blocks.
    $name = 'theme_campus/numfooterblocks';
    $title = get_string('numfooterblocks', 'theme_campus');
    $description = get_string('numfooterblocksdesc', 'theme_campus');
    $choices = [
        1 => new lang_string('one', 'theme_campus'),
        2 => new lang_string('two', 'theme_campus'),
        3 => new lang_string('three', 'theme_campus'),
        4 => new lang_string('four', 'theme_campus'),
    ];
    $default = 2;
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    // No CSS change, so no need to reset caches.
    $settingpage->add($setting);

    // Footnote setting.
    $name = 'theme_campus/footnote';
    $title = get_string('footnote', 'theme_campus');
    $description = get_string('footnotedesc', 'theme_campus');
    $default = '';
    $setting = new admin_setting_confightmleditor($name, $title, $description, $default);
    // No CSS change, so no need to reset caches.
    $settingpage->add($setting);

    // Must add the page after defining all the settings!
    $settings->add($settingpage);

    // Carousel settings.
    $settingpage = new admin_settingpage('theme_campus_carousel', get_string('carouselsettings', 'theme_campus'));
    $settingpage->add(new admin_setting_heading(
        'theme_campus_carouselheading',
        null,
        format_text(get_string('carouselsettingsdesc', 'theme_campus'), FORMAT_MARKDOWN)
    ));

    // Slider position setting.
    $name = 'theme_campus/sliderposition';
    $title = get_string('sliderposition', 'theme_campus');
    $description = get_string('sliderpositiondesc', 'theme_campus');
    $default = 1;
    $choices = [
        1 => new lang_string('sliderpositionheader', 'theme_campus'),
        2 => new lang_string('sliderpositionpage', 'theme_campus'),
    ];
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    // No CSS change, so no need to reset caches.
    $settingpage->add($setting);

    // Autoplay.
    $name = 'theme_campus/carouselautoplay';
    $title = get_string('carouselautoplay', 'theme_campus');
    $description = get_string('carouselautoplaydesc', 'theme_campus');
    $default = 2;
    $choices = [
        1 => new lang_string('no'), // No.
        2 => new lang_string('yes'), // Yes.
    ];
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    // No CSS change, so no need to reset caches.
    $settingpage->add($setting);

    // Slide interval.
    $name = 'theme_campus/slideinterval';
    $title = get_string('slideinterval', 'theme_campus');
    $default = 5000;
    $lower = 1000;
    $upper = 100000;
    $description = get_string('slideintervaldesc', 'theme_campus', ['lower' => $lower, 'upper' => $upper]);
    $setting = new admin_setting_configinteger($name, $title, $description, $default, $lower, $upper);
    // No CSS change, so no need to reset caches.
    $settingpage->add($setting);

    // Carousel text colour setting.
    $name = 'theme_campus/carouseltextcolour';
    $title = get_string('carouseltextcolour', 'theme_campus');
    $description = get_string('carouseltextcolourdesc', 'theme_campus');
    $default = '#ffffff';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settingpage->add($setting);

    // Show caption centred.
    $name = 'theme_campus/slidecaptioncentred';
    $title = get_string('slidecaptioncentred', 'theme_campus');
    $description = get_string('slidecaptioncentreddesc', 'theme_campus');
    $default = false;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default, true, false);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settingpage->add($setting);

    // Slide button colour setting.
    $name = 'theme_campus/slidebuttoncolour';
    $title = get_string('slidebuttoncolour', 'theme_campus');
    $description = get_string('slidebuttoncolourdesc', 'theme_campus');
    $default = '#3a53c1';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settingpage->add($setting);

    // Slide button hover colour setting.
    $name = 'theme_campus/slidebuttonhovercolour';
    $title = get_string('slidebuttonhovercolour', 'theme_campus');
    $description = get_string('slidebuttonhovercolourdesc', 'theme_campus');
    $default = '#4f72ff';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settingpage->add($setting);

    // Must add the page after defining all the settings!
    $settings->add($settingpage);

    // Frontpage carousel settings.
    $settingpage = new admin_settingpage(
        'theme_campus_frontpage_carousel',
        get_string('frontpagecarouselsettings', 'theme_campus')
    );
    $settingpage->add(new admin_setting_heading(
        'theme_campus_carousel_frontpage',
        null,
        format_text(get_string('frontpagecarouselsettings_desc', 'theme_campus'), FORMAT_MARKDOWN)
    ));

    // Status.
    $name = 'theme_campus/frontpagecarouselstatus';
    $title = get_string('carouselstatus', 'theme_campus');
    $description = get_string('carouselstatus_desc', 'theme_campus');
    $default = 1;
    $choices = [
        1 => new lang_string('draft', 'theme_campus'),
        2 => new lang_string('published', 'theme_campus'),
    ];
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    // No CSS change, so no need to reset caches.
    $settingpage->add($setting);

    // Number of slides.
    $name = 'theme_campus/numberofslidesforfrontpage';
    $title = get_string('numberofslides', 'theme_campus');
    $default = 0;
    $lower = 0;
    $upper = 6;
    $description = get_string('numberofslidesdesc', 'theme_campus', ['lower' => $lower, 'upper' => $upper]);
    $setting = new admin_setting_configinteger($name, $title, $description, $default, $lower, $upper);
    // No CSS change, so no need to reset caches.
    $settingpage->add($setting);

    $numberofslides = get_config('theme_campus', 'numberofslidesforfrontpage');
    for ($i = 1; $i <= $numberofslides; $i++) {
        // This is the information.
        $name = 'theme_campus/frontpageslide' . $i . 'info';
        $heading = get_string('slideno', 'theme_campus', ['slide' => $i]);
        $information = get_string('slidenodesc', 'theme_campus', ['slide' => $i]);
        $setting = new admin_setting_heading($name, $heading, $information);
        // No CSS change, so no need to reset caches.
        $settingpage->add($setting);

        // Title.
        $name = 'theme_campus/frontpage' . $i . 'title';
        $title = get_string('slidetitle', 'theme_campus');
        $description = get_string('slidetitledesc', 'theme_campus');
        $default = '';
        $setting = new admin_setting_configtext($name, $title, $description, $default);
        // No CSS change, so no need to reset caches.
        $settingpage->add($setting);

        // Image.
        $name = 'theme_campus/frontpage' . $i . 'image';
        $title = get_string('slideimage', 'theme_campus');
        $description = get_string('slideimagedesc', 'theme_campus');
        $setting = new admin_setting_configstoredfile($name, $title, $description, 'frontpage' . $i . 'image');
        // No CSS change, so no need to reset caches.
        $settingpage->add($setting);

        // Caption text.
        $name = 'theme_campus/frontpage' . $i . 'caption';
        $title = get_string('slidecaption', 'theme_campus');
        $description = get_string('slidecaptiondesc', 'theme_campus');
        $default = '';
        $setting = new admin_setting_configtextarea($name, $title, $description, $default, PARAM_TEXT);
        // No CSS change, so no need to reset caches.
        $settingpage->add($setting);

        // Link.
        $name = 'theme_campus/frontpage' . $i . 'link';
        $title = get_string('slidelink', 'theme_campus');
        $description = get_string('slidelinkdesc', 'theme_campus');
        $default = '';
        $setting = new admin_setting_configtext($name, $title, $description, $default, PARAM_URL);
        // No CSS change, so no need to reset caches.
        $settingpage->add($setting);

        // Link target.
        $name = 'theme_campus/frontpage' . $i . 'linktarget';
        $title = get_string('slidelinktarget', 'theme_campus');
        $description = get_string('slidelinktargetdesc', 'theme_campus');
        $default = 1;
        $choices = [
            '_self' => new lang_string('slidelinktargetself', 'theme_campus'),
            '_blank' => new lang_string('slidelinktargetblank', 'theme_campus'),
        ];
        $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
        // No CSS change, so no need to reset caches.
        $settingpage->add($setting);
    }

    // Must add the page after defining all the settings!
    $settings->add($settingpage);

    // Course category carousel settings.
    $settingpage = new admin_settingpage(
        'theme_campus_category_carousel',
        get_string('coursecategorycarouselsettings', 'theme_campus')
    );
    $settingpage->add(new admin_setting_heading(
        'theme_campus_carousel_coursecategory',
        null,
        format_text(get_string('coursecategorycarouselsettings_desc', 'theme_campus'), FORMAT_MARKDOWN)
    ));

    $campuscategorytree = theme_campus_get_top_level_categories();
    foreach ($campuscategorytree as $key => $value) {
        $name = 'theme_campus/coursecategoryheading' . $key;
        $heading = get_string('coursecategoryheading', 'theme_campus', ['categoryname' => $value]);
        $information = '';
        $setting = new admin_setting_heading($name, $heading, $information);
        // No CSS change, so no need to reset caches.
        $settingpage->add($setting);

        // Status.
        $name = 'theme_campus/coursecategorycarouselstatus' . $key;
        $title = get_string('carouselstatus', 'theme_campus');
        $description = get_string('carouselstatus_desc', 'theme_campus');
        $default = 1;
        $choices = [
            1 => new lang_string('draft', 'theme_campus'),
            2 => new lang_string('published', 'theme_campus'),
        ];
        $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
        // No CSS change, so no need to reset caches.
        $settingpage->add($setting);

        // Number of slides.
        $name = 'theme_campus/numberofslidesforcategory' . $key;
        $title = get_string('numberofslides', 'theme_campus');
        $default = 0;
        $lower = 0;
        $upper = 6;
        $description = get_string('numberofslidesdesc', 'theme_campus', ['lower' => $lower, 'upper' => $upper]);
        $setting = new admin_setting_configinteger($name, $title, $description, $default, $lower, $upper);
        // No CSS change, so no need to reset caches.
        $settingpage->add($setting);

        $numberofslides = get_config('theme_campus', 'numberofslidesforcategory' . $key);
        for ($i = 1; $i <= $numberofslides; $i++) {
            // This is the information.
            $name = 'theme_campus/coursecategory' . $key . '_slide' . $i . 'info';
            $heading = get_string('slideno', 'theme_campus', ['slide' => $i]);
            $information = get_string('slidenodesc', 'theme_campus', ['slide' => $i]);
            $setting = new admin_setting_heading($name, $heading, $information);
            // No CSS change, so no need to reset caches.
            $settingpage->add($setting);

            // Title.
            $name = 'theme_campus/coursecategory' . $key . '_' . $i . 'title';
            $title = get_string('slidetitle', 'theme_campus');
            $description = get_string('slidetitledesc', 'theme_campus');
            $default = '';
            $setting = new admin_setting_configtext($name, $title, $description, $default);
            // No CSS change, so no need to reset caches.
            $settingpage->add($setting);

            // Image.
            $name = 'theme_campus/coursecategory' . $key . '_' . $i . 'image';
            $title = get_string('slideimage', 'theme_campus');
            $description = get_string('slideimagedesc', 'theme_campus');
            $setting = new admin_setting_configstoredfile(
                $name,
                $title,
                $description,
                'coursecategory' . $key . '_' . $i . 'image'
            );
            // No CSS change, so no need to reset caches.
            $settingpage->add($setting);

            // Caption text.
            $name = 'theme_campus/coursecategory' . $key . '_' . $i . 'caption';
            $title = get_string('slidecaption', 'theme_campus');
            $description = get_string('slidecaptiondesc', 'theme_campus');
            $default = '';
            $setting = new admin_setting_configtextarea($name, $title, $description, $default, PARAM_TEXT);
            // No CSS change, so no need to reset caches.
            $settingpage->add($setting);

            // Link.
            $name = 'theme_campus/coursecategory' . $key . '_' . $i . 'link';
            $title = get_string('slidelink', 'theme_campus');
            $description = get_string('slidelinkdesc', 'theme_campus');
            $default = '';
            $setting = new admin_setting_configtext($name, $title, $description, $default, PARAM_URL);
            // No CSS change, so no need to reset caches.
            $settingpage->add($setting);

            // Link target.
            $name = 'theme_campus/coursecategory' . $key . '_' . $i . 'linktarget';
            $title = get_string('slidelinktarget', 'theme_campus');
            $description = get_string('slidelinktargetdesc', 'theme_campus');
            $default = 1;
            $choices = [
                '_self' => new lang_string('slidelinktargetself', 'theme_campus'),
                '_blank' => new lang_string('slidelinktargetblank', 'theme_campus'),
            ];
            $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
            // No CSS change, so no need to reset caches.
            $settingpage->add($setting);
        }
    }

    // Must add the page after defining all the settings!
    $settings->add($settingpage);

    // Social links page....
    $settingpage = new admin_settingpage('theme_campus_social', get_string('socialheading', 'theme_campus'));
    // Number of social links.
    $name = 'theme_campus/numberofsociallinks';
    $title = get_string('numberofsociallinks', 'theme_campus');
    $description = get_string('numberofsociallinks_desc', 'theme_campus');
    $default = 2;
    $choices = [
        0 => '0',
        1 => '1',
        2 => '2',
        3 => '3',
        4 => '4',
        5 => '5',
        6 => '6',
        7 => '7',
        8 => '8',
        9 => '9',
        10 => '10',
        11 => '11',
        12 => '12',
        13 => '13',
        14 => '14',
        15 => '15',
        16 => '16',
    ];

    $settingpage->add(new admin_setting_heading(
        'theme_campus_social',
        get_string('socialheadingsub', 'theme_campus'),
        format_text(get_string('socialheadingdesc', 'theme_campus'), FORMAT_MARKDOWN)
    ));
    $settingpage->add(new admin_setting_configselect($name, $title, $description, $default, $choices));

    $numberofsociallinks = get_config('theme_campus', 'numberofsociallinks');
    for ($i = 1; $i <= $numberofsociallinks; $i++) {
        // Social url setting.
        $name = 'theme_campus/social' . $i;
        $title = get_string('socialnetworklink', 'theme_campus') . $i;
        $description = get_string('socialnetworklink_desc', 'theme_campus') . $i;
        $default = '';
        $setting = new admin_setting_configtext($name, $title, $description, $default, PARAM_URL);
        $setting->set_updatedcallback('theme_reset_all_caches');
        $settingpage->add($setting);

        // Social icon setting.
        $name = 'theme_campus/socialicon' . $i;
        $title = get_string('socialnetworkicon', 'theme_campus') . $i;
        $description = get_string('socialnetworkicon_desc', 'theme_campus') . $i;
        $default = 'globe';
        $choices = [
            'dropbox' => 'Dropbox',
            'facebook-square' => 'Facebook',
            'flickr' => 'Flickr',
            'github' => 'Github',
            'google-plus-square' => 'Google Plus',
            'instagram' => 'Instagram',
            'linkedin-square' => 'Linkedin',
            'pinterest-square' => 'Pinterest',
            'skype' => 'Skype',
            'tumblr-square' => 'Tumblr',
            'twitter-square' => 'Twitter',
            'users' => 'Unlisted',
            'vimeo-square' => 'Vimeo',
            'vk' => 'Vk',
            'globe' => 'Website',
            'youtube-square' => 'YouTube',
        ];
        $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
        $setting->set_updatedcallback('theme_reset_all_caches');
        $settingpage->add($setting);
    }

    // Must add the page after defining all the settings!
    $settings->add($settingpage);

    // Forum page....
    $settingpage = new admin_settingpage('theme_campus_forum', get_string('forumsettings', 'theme_campus'));
    $settingpage->add(new admin_setting_heading(
        'theme_campus_forumheading',
        null,
        format_text(get_string('forumsettingsdesc', 'theme_campus'), FORMAT_MARKDOWN)
    ));

    // Enable custom template.
    $name = 'theme_campus/forumcustomtemplate';
    $title = get_string('forumcustomtemplate', 'theme_campus');
    $description = get_string('forumcustomtemplatedesc', 'theme_campus');
    $default = 0;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default);
    // No CSS change, so no need to reset caches.
    $settingpage->add($setting);

    // Header setting.
    $name = 'theme_campus/forumhtmlemailheader';
    $title = get_string('forumhtmlemailheader', 'theme_campus');
    $description = get_string('forumhtmlemailheaderdesc', 'theme_campus');
    $default = '';
    $setting = new admin_setting_confightmleditor($name, $title, $description, $default);
    // No CSS change, so no need to reset caches.
    $settingpage->add($setting);

    // Footer setting.
    $name = 'theme_campus/forumhtmlemailfooter';
    $title = get_string('forumhtmlemailfooter', 'theme_campus');
    $description = get_string('forumhtmlemailfooterdesc', 'theme_campus');
    $default = '';
    $setting = new admin_setting_confightmleditor($name, $title, $description, $default);
    // No CSS change, so no need to reset caches.
    $settingpage->add($setting);

    // Must add the page after defining all the settings!
    $settings->add($settingpage);

    // File store.
    $settingpage = new admin_settingpage('theme_campus_filestore', get_string('filestoresettings', 'theme_campus'));
    $settingpage->add(new admin_setting_heading(
        'theme_campus_filestoreheading',
        null,
        format_text(get_string('filestoresettingsdesc', 'theme_campus'), FORMAT_MARKDOWN)
    ));

    // Number of stores.
    $name = 'theme_campus/numberoffiles';
    $title = get_string('numberoffiles', 'theme_campus');
    $default = 10;
    $lower = 0;
    $upper = 20;
    $description = get_string('numberoffilesdesc', 'theme_campus', ['lower' => $lower, 'upper' => $upper]);
    $setting = new admin_setting_configinteger($name, $title, $description, $default, $lower, $upper);
    // No CSS change, so no need to reset caches.
    $settingpage->add($setting);

    $numberoffiles = \theme_campus\toolbox::get_config_setting('numberoffiles');
    for ($i = 1; $i <= $numberoffiles; $i++) {
        // File.
        $name = 'theme_campus/campusfile' . $i;
        $title = get_string('campusfile', 'theme_campus', $i);
        $thefile = \theme_campus\toolbox::get_setting_moodle_url_noitemid('campusfile' . $i);
        if (is_null($thefile)) {
            $description = get_string('campusnofile', 'theme_campus');
        } else {
            $description = get_string('campusfilestored', 'theme_campus', $thefile);
        }
        $setting = new admin_setting_configstoredfile($name, $title, $description, 'campusfile' . $i);
        // No CSS change, so no need to reset caches.
        $settingpage->add($setting);
    }

    $settings->add($settingpage);
}
