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

$THEME->doctype = 'html5';
$THEME->name = 'campus';
$THEME->parents = array('bootstrapbase');
$THEME->sheets = array('font');
$THEME->lessfile = 'moodleallcampus';
$THEME->lessvariablescallback = 'theme_campus_less_variables';
$THEME->extralesscallback = 'theme_campus_extra_less';
$THEME->sheets[] = 'font-awesome';
$THEME->sheets[] = 'custom';
$THEME->supportscssoptimisation = false;
$THEME->yuicssmodules = array();

$THEME->editor_sheets = array('editor');

$THEME->parents_exclude_sheets = array(
    'bootstrapbase' => array(
        'moodle',
        'editor'
    )
);

$THEME->plugins_exclude_sheets = array(
    'block' => array(
        'html'
    )
);

$THEME->rendererfactory = 'theme_overridden_renderer_factory';

$empty = array();
$col1regions = array('footer');
$col2regions = array('side-pre', 'footer');
$col3regions = array('side-pre', 'side-post', 'footer');

$themelayout = (!empty($THEME->settings->themelayout)) ? $THEME->settings->themelayout : 1;

switch ($themelayout) {
    case 1: // Three columns.
        $fpfile = 'frontpage3.php';
        $fpregions = $col3regions;
        $sitefile = 'columns3.php';
        $siteregions = $col3regions;
        $securefile = 'secure3.php';
    break;
    case 2: // Three column front page and two columns with blocks left elsewhere.
        $fpfile = 'frontpage3.php';
        $fpregions = $col3regions;
        $sitefile = 'columns2l.php';
        $siteregions = $col2regions;
        $securefile = 'secure2l.php';
    break;
    case 3: // Three column front page and two columns with blocks right elsewhere.
        $fpfile = 'frontpage3.php';
        $fpregions = $col3regions;
        $sitefile = 'columns2r.php';
        $siteregions = $col2regions;
        $securefile = 'secure2r.php';
    break;
    case 4: // Two columns with blocks on the left.
        $fpfile = 'frontpage2l.php';
        $fpregions = $col2regions;
        $sitefile = 'columns2l.php';
        $siteregions = $col2regions;
        $securefile = 'secure2l.php';
    break;
    case 5: // Two columns with blocks on the right.
        $fpfile = 'frontpage2r.php';
        $fpregions = $col2regions;
        $sitefile = 'columns2r.php';
        $siteregions = $col2regions;
        $securefile = 'secure2r.php';
    break;
}

$THEME->layouts = array(
    // Most backwards compatible layout without the blocks - this is the layout used by default.
    'base' => array(
        'file' => 'columns1.php',
        'regions' => $empty,
        'defaultregion' => 'footer'
    ),
    // Standard layout with blocks, this is recommended for most pages with general information.
    'standard' => array(
        'file' => $sitefile,
        'regions' => $siteregions,
        'defaultregion' => 'side-pre'
    ),
    // Main course page.
    'course' => array(
        'file' => $sitefile,
        'regions' => $siteregions,
        'defaultregion' => 'side-pre',
        'options' => array('langmenu'=>true)
    ),
    'coursecategory' => array(
        'file' => $sitefile,
        'regions' => $siteregions,
        'defaultregion' => 'side-pre'
    ),
    // part of course, typical for modules - default page layout if $cm specified in require_login()
    'incourse' => array(
        'file' => $sitefile,
        'regions' => $siteregions,
        'defaultregion' => 'side-pre'
    ),
    // The site home page.
    'frontpage' => array(
        'file' => $fpfile,
        'regions' => $fpregions,
        'defaultregion' => 'side-pre'
    ),
    // Server administration scripts.
    'admin' => array(
        'file' => $sitefile,
        'regions' => $col3regions,  // On purpose for when changing columns from 2r to 3 on General settings page of theme.
        'defaultregion' => 'side-pre'
    ),
    // My dashboard page.
    'mydashboard' => array(
        'file' => $sitefile,
        'regions' => $siteregions,
        'defaultregion' => 'side-pre',
        'options' => array('langmenu'=>true)
    ),
    // My public page.
    'mypublic' => array(
        'file' => $sitefile,
        'regions' => $siteregions,
        'defaultregion' => 'side-pre'
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
        'file' => $sitefile,
        'regions' => $siteregions,
        'defaultregion' => 'side-pre'
    ),
    // The pagelayout used for safebrowser and securewindow.
    'secure' => array(
        'file' => $securefile,
        'regions' => $siteregions,
        'defaultregion' => 'side-pre'
    ),
);

$THEME->javascripts_footer = array(
    'campus'
);

if (core_useragent::is_ie() && !core_useragent::check_ie_version('9.0')) {
    $THEME->javascripts[] = 'html5shiv';
}

$THEME->csspostprocess = 'theme_campus_process_css';
