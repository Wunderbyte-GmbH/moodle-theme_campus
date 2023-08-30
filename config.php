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
 * @author     G J Barnard - {@link http://moodle.org/user/profile.php?id=442195}
 * @author     Based on code originally written by Mary Evans, Bas Brands, Stuart Lamour and David Scotson.
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$THEME->doctype = 'html5';
$THEME->name = 'campus';
$THEME->parents = array('boost');
$THEME->sheets = array('font');
$THEME->sheets[] = 'custom';
$THEME->prescsscallback = 'theme_campus_get_pre_scss';
$THEME->scss = function(theme_config $theme) {
    return theme_campus_get_main_scss_content($theme);
};
$THEME->extrascsscallback = 'theme_campus_get_extra_scss';
$THEME->usefallback = true;
$THEME->precompiledcsscallback = 'theme_campus_get_precompiled_css';
$THEME->enable_dock = false;
$THEME->supportscssoptimisation = false;
$THEME->yuicssmodules = array();

$THEME->editor_sheets = array('editor');

$THEME->plugins_exclude_sheets = array(
    'block' => array(
        'html'
    )
);

$THEME->rendererfactory = 'theme_overridden_renderer_factory';

$empty = array();
$siteregions = array('side-nav', 'footer');

$THEME->layouts = array(
    // Most backwards compatible layout without the blocks - this is the layout used by default.
    'base' => array(
        'file' => 'columns1.php',
        'regions' => $siteregions,
        'defaultregion' => 'side-nav'
    ),
    // Standard layout with blocks, this is recommended for most pages with general information.
    'standard' => array(
        'file' => 'columns1.php',
        'regions' => $siteregions,
        'defaultregion' => 'side-nav'
    ),
    // Main course page.
    'course' => array(
        'file' => 'columns1.php',
        'regions' => $siteregions,
        'defaultregion' => 'side-nav',
        'options' => array('langmenu'=>true)
    ),
    'coursecategory' => array(
        'file' => 'columns1.php',
        'regions' => $siteregions,
        'defaultregion' => 'side-nav'
    ),
    // part of course, typical for modules - default page layout if $cm specified in require_login()
    'incourse' => array(
        'file' => 'columns1.php',
        'regions' => $siteregions,
        'defaultregion' => 'side-nav'
    ),
    // The site home page.
    'frontpage' => array(
        'file' => 'frontpage1.php',
        'regions' => $siteregions,
        'defaultregion' => 'side-nav'
    ),
    // Server administration scripts.
    'admin' => array(
        'file' => 'columns1.php',
        'regions' => $siteregions,
        'defaultregion' => 'side-nav'
    ),
    // My dashboard page.
    'mydashboard' => array(
        'file' => 'columns1.php',
        'regions' => $siteregions,
        'defaultregion' => 'side-nav',
        'options' => array('langmenu'=>true)
    ),
    // My public page.
    'mypublic' => array(
        'file' => 'columns1.php',
        'regions' => $siteregions,
        'defaultregion' => 'side-nav'
    ),
    'login' => array(
        'file' => 'columns1.php',
        'regions' => $empty,
        'options' => array('langmenu'=>true)
    ),

    // Pages that appear in pop-up windows - no navigation, no blocks, no header.
    'popup' => array(
        'file' => 'popup.php',
        'regions' => array(),
        'options' => array('nofooter'=>true, 'nonavbar'=>true)
    ),
    // No blocks and minimal footer - used for legacy frame layouts only!
    'frametop' => array(
        'file' => 'columns1.php',
        'regions' => $empty,
        'options' => array('nofooter'=>true, 'nocoursefooter'=>true),
    ),
    // Embeded pages, like iframe/object embeded in moodleform - it needs as much space as possible
    'embedded' => array(
        'file' => 'embedded.php',
        'regions' => $empty
    ),
    // Used during upgrade and install, and for the 'This site is undergoing maintenance' message.
    // This must not have any blocks, and it is good idea if it does not have links to
    // other places - for example there should not be a home link in the footer...
    'maintenance' => array(
        'file' => 'maintenance.php',
        'regions' => $empty,
        'options' => array('nofooter'=>true, 'nonavbar'=>true, 'nocoursefooter'=>true, 'nocourseheader'=>true)
    ),
    // Should display the content and basic headers only.
    'print' => array(
        'file' => 'columns1.php',
        'regions' => $empty,
        'options' => array('nofooter'=>true, 'nonavbar'=>false)
    ),
    // The pagelayout used when a redirection is occuring.
    'redirect' => array(
        'file' => 'embedded.php',
        'regions' => $empty
    ),
    // The pagelayout used for reports.
    'report' => array(
        'file' => 'columns1.php',
        'regions' => $siteregions,
        'defaultregion' => 'side-nav'
    ),
    // The pagelayout used for safebrowser and securewindow.
    'secure' => array(
        'file' => 'secure1.php',
        'regions' => $siteregions,
        'defaultregion' => 'side-nav'
    ),
);

$THEME->javascripts_footer = array(
    'campus'
);

if (core_useragent::is_ie() && !core_useragent::check_ie_version('9.0')) {
    $THEME->javascripts[] = 'html5shiv';
}

$THEME->csspostprocess = 'theme_campus_process_css';
$THEME->iconsystem = '\\theme_campus\\output\\icon_system_fontawesome';
$THEME->addblockposition = BLOCK_ADDBLOCK_POSITION_FLATNAV;
