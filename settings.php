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

$settings = null;

defined('MOODLE_INTERNAL') || die;
if (is_siteadmin()) {
    require_once($CFG->dirroot . '/theme/campus/admin_setting_configinteger.php');

    $ADMIN->add('themes', new admin_category('theme_campus', 'Campus'));

    // Generic settings.
    $settingpage = new admin_settingpage('theme_campus_generic', get_string('genericsettings', 'theme_campus'));
    $settingpage->add(new admin_setting_heading('theme_campus_generalheading', get_string('generalheadingsub', 'theme_campus'),
        format_text(get_string('generalheadingdesc', 'theme_campus'), FORMAT_MARKDOWN)));

    // Theme layout setting.
    $name = 'theme_campus/themelayout';
    $title = get_string('themelayout', 'theme_campus');
    $description = get_string('themelayoutdesc', 'theme_campus');
    $default = 1;
    $choices = array(
        1 => get_string('themelayoutthreecolumns', 'theme_campus'),
        2 => get_string('themelayoutthreecolumnsfplefttwo', 'theme_campus'),
        3 => get_string('themelayoutthreecolumnsfprighttwo', 'theme_campus'),
        4 => get_string('themelayoutlefttwocolumns', 'theme_campus'),
        5 => get_string('themelayoutrighttwocolumns', 'theme_campus')
    );
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    // No CSS change, but need to re-read config.php file, so needed.
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settingpage->add($setting);

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
    $params = array('sso_sp', 0, 1);

    if (!empty($CFG->mnet_all_hosts_id)) {
        $sql .= " AND h.id <> ?";
        $params[] = $CFG->mnet_all_hosts_id;
    }

    if ($hosts = $DB->get_records_sql($sql, $params)) {
        $choices = array();
        $choices[0] = 'notset';
        foreach ($hosts as $id => $host){
            $choices[$id] = $host->name;
        }    
    } else {
        $choices = array();
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

    // CDN Fonts - 1 = no, 2 = yes.
    $name = 'theme_campus/cdnfonts';
    $title = get_string('cdnfonts', 'theme_campus');
    $description = get_string('cdnfontsdesc', 'theme_campus');
    $default = 1;
    $choices = array(
        1 => new lang_string('no'),   // No.
        2 => new lang_string('yes')   // Yes.
    );
    // No CSS change, so no need to reset caches.
    $settingpage->add(new admin_setting_configselect($name, $title, $description, $default, $choices));

    // Slider position setting.
    $name = 'theme_campus/sliderposition';
    $title = get_string('sliderposition', 'theme_campus');
    $description = get_string('sliderpositiondesc', 'theme_campus');
    $default = 1;
    $choices = array(
        1 => new lang_string('sliderpositionheader', 'theme_campus'),
        2 => new lang_string('sliderpositionpage', 'theme_campus')
    );
    // No CSS change, so no need to reset caches.
    $settingpage->add(new admin_setting_configselect($name, $title, $description, $default, $choices));

    // Custom CSS file.
    $name = 'theme_campus/customcss';
    $title = get_string('customcss', 'theme_campus');
    $description = get_string('customcssdesc', 'theme_campus');
    $default = '';
    $setting = new admin_setting_configtextarea($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settingpage->add($setting);

    $ADMIN->add('theme_campus', $settingpage);

    // Look and feel settings.
    $settingpage = new admin_settingpage('theme_campus_landf', get_string('landfsettings', 'theme_campus'));
    $settingpage->add(new admin_setting_heading('theme_campus_landfheading', get_string('landfheadingsub', 'theme_campus'),
        format_text(get_string('landfheadingdesc', 'theme_campus'), FORMAT_MARKDOWN)));

    // Text colour setting.
    $name = 'theme_campus/textcolour';
    $title = get_string('textcolour', 'theme_campus');
    $description = get_string('textcolourdesc', 'theme_campus');
    $default = '#653CAE';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settingpage->add($setting);

    // Heading colour setting.
    $name = 'theme_campus/headingcolour';
    $title = get_string('headingcolour', 'theme_campus');
    $description = get_string('headingcolourdesc', 'theme_campus');
    $default = '#9057F9';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settingpage->add($setting);

    // Navbar text colour setting.
    $name = 'theme_campus/navbartextcolour';
    $title = get_string('navbartextcolour', 'theme_campus');
    $description = get_string('navbartextcolourdesc', 'theme_campus');
    $default = '#9057F9';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settingpage->add($setting);

    // Block heading colour setting.
    $name = 'theme_campus/blockheadingcolour';
    $title = get_string('blockheadingcolour', 'theme_campus');
    $description = get_string('blockheadingcolourdesc', 'theme_campus');
    $default = '#5600F7';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settingpage->add($setting);

    // Block background colour setting.
    $name = 'theme_campus/blockbackgroundcolour';
    $title = get_string('blockbackgroundcolour', 'theme_campus');
    $description = get_string('blockbackgroundcolourdesc', 'theme_campus');
    $default = '#ffd974';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settingpage->add($setting);

    // Theme colour setting.
    $name = 'theme_campus/themecolour';
    $title = get_string('themecolour', 'theme_campus');
    $description = get_string('themecolourdesc', 'theme_campus');
    $default = '#ffd974';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settingpage->add($setting);

    // Theme background colour setting.
    $name = 'theme_campus/themebackgroundcolour';
    $title = get_string('themebackgroundcolour', 'theme_campus');
    $description = get_string('themebackgroundcolourdesc', 'theme_campus');
    $default = '#FFF4D8';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settingpage->add($setting);

    // Small border radius.
    $name = 'theme_campus/borderradiussmall';
    $title = get_string('borderradiussmall', 'theme_campus');
    $description = get_string('borderradiussmall_desc', 'theme_campus');
    $default = '3px';
    $choices = array(
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
        '25px' => new lang_string('px25', 'theme_campus')
    );
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settingpage->add($setting);

    // Medium border radius.
    $name = 'theme_campus/borderradiusmedium';
    $title = get_string('borderradiusmedium', 'theme_campus');
    $description = get_string('borderradiusmedium_desc', 'theme_campus');
    $default = '4px';
    $choices = array(
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
        '25px' => new lang_string('px25', 'theme_campus')
    );
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settingpage->add($setting);

    // Large border radius.
    $name = 'theme_campus/borderradiuslarge';
    $title = get_string('borderradiuslarge', 'theme_campus');
    $description = get_string('borderradiuslarge_desc', 'theme_campus');
    $default = '6px';
    $choices = array(
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
        '25px' => new lang_string('px25', 'theme_campus')
    );
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settingpage->add($setting);

    $ADMIN->add('theme_campus', $settingpage);

    // Header settings.
    $settingpage = new admin_settingpage('theme_campus_header', get_string('headersettings', 'theme_campus'));
    $settingpage->add(new admin_setting_heading('theme_campus_headerheading', get_string('headerheadingsub', 'theme_campus'),
        format_text(get_string('headerheadingdesc', 'theme_campus'), FORMAT_MARKDOWN)));

    // Show page heading.
    $name = 'theme_campus/showpageheading';
    $title = get_string('showpageheading', 'theme_campus');
    $description = get_string('showpageheadingdesc', 'theme_campus');
    $default = true;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default, true, false);
    // No CSS change, so no need to reset caches.
    $settingpage->add($setting);

    // Invert Navbar to dark background.
    $name = 'theme_campus/invert';
    $title = get_string('invert', 'theme_campus');
    $description = get_string('invertdesc', 'theme_campus');
    $setting = new admin_setting_configcheckbox($name, $title, $description, 0);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settingpage->add($setting);

    // Frontpage header settings.
    $settingpage->add(new admin_setting_heading('theme_campus_frontpage', get_string('frontpagesettings', 'theme_campus'),
            format_text(get_string('frontpagesettings_desc', 'theme_campus'), FORMAT_MARKDOWN)));

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
    $default = 'absolutelayout';
    $choices = array(
        'absolutelayout' => new lang_string('frontpagelayoutontop', 'theme_campus'),
        'flexlayout' => new lang_string('frontpagelayoutonside', 'theme_campus')
    );
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settingpage->add(new admin_setting_configselect($name, $title, $description, $default, $choices));

    // Frontpage header height.
    $name = 'theme_campus/frontpageheaderheight';
    $title = get_string('frontpageheaderheight', 'theme_campus');
    $default = 75;
    $lower = 40;
    $upper = 900;
    $description = get_string('frontpageheaderheightdesc', 'theme_campus', array('lower' => $lower, 'upper' => $upper));
    $setting = new admin_setting_configinteger($name, $title, $description, $default, $lower, $upper);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settingpage->add($setting);

    // Logo file setting.
    $name = 'theme_campus/frontpagelogo';
    $title = get_string('frontpagelogo','theme_campus');
    $description = get_string('frontpagelogodesc', 'theme_campus');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'frontpagelogo');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settingpage->add($setting);

    // Logo position setting.
    $name = 'theme_campus/frontpagelogoposition';
    $title = get_string('frontpagelogoposition', 'theme_campus');
    $description = get_string('frontpagelogopositiondesc', 'theme_campus');
    $default = 1;
    $choices = array(
        1 => new lang_string('imageleft', 'theme_campus'),
        2 => new lang_string('imageright', 'theme_campus')
    );
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settingpage->add(new admin_setting_configselect($name, $title, $description, $default, $choices));

    // Background image file setting.
    $name = 'theme_campus/frontpagebackgroundimage';
    $title = get_string('frontpagebackgroundimage','theme_campus');
    $description = get_string('frontpagebackgroundimagedesc', 'theme_campus');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'frontpagebackgroundimage');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settingpage->add($setting);

    // Background position setting.
    $name = 'theme_campus/frontpagebackgroundposition';
    $title = get_string('frontpagebackgroundposition', 'theme_campus');
    $description = get_string('frontpagebackgroundpositiondesc', 'theme_campus');
    $default = 1;
    $choices = array(
        1 => new lang_string('imageleft', 'theme_campus'),
        2 => new lang_string('imageright', 'theme_campus')
    );
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settingpage->add(new admin_setting_configselect($name, $title, $description, $default, $choices));

    // Course category header settings.
    $settingpage->add(new admin_setting_heading('theme_campus_coursecategory', get_string('coursecategorysettings', 'theme_campus'),
            format_text(get_string('coursecategorysettings_desc', 'theme_campus'), FORMAT_MARKDOWN)));

    global $CFG;
    include_once($CFG->dirroot . '/theme/campus/campus-lib.php');
    $campuscategorytree = theme_campus_get_top_level_categories();
    foreach($campuscategorytree as $key => $value){
        $name = 'theme_campus/coursecategoryheading'.$key;
        $heading = get_string('coursecategoryheading', 'theme_campus', array('categoryname' => $value));
        //$information = get_string('coursecategoryheading_desc', 'theme_campus');
        $information = ''; // TODO: Decide if better without description.
        $setting = new admin_setting_heading($name, $heading, $information);
        $settingpage->add($setting);

        $name = 'theme_campus/coursecategorybgcolour'.$key;
        $title = get_string('coursecategorybgcolour', 'theme_campus');
        $description = get_string('coursecategorybgcolourdesc', 'theme_campus', array('categoryname' => $value));
        $default = '#11847D';
        $previewconfig = NULL;
        $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
        $settingpage->add($setting);
    }

    $ADMIN->add('theme_campus', $settingpage);

    // Footer settings.
    $settingpage = new admin_settingpage('theme_campus_footer', get_string('footersettings', 'theme_campus'));
    $settingpage->add(new admin_setting_heading('theme_campus_footerheading', get_string('footerheadingsub', 'theme_campus'),
        format_text(get_string('footerheadingdesc', 'theme_campus'), FORMAT_MARKDOWN)));

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

    $ADMIN->add('theme_campus', $settingpage);
}
