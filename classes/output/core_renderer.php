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

namespace theme_campus\output;

use block_contents;
use block_move_target;
use coding_exception;
use context_course;
use custom_menu;
use html_writer;
use moodle_url;

class core_renderer extends \theme_boost\output\core_renderer {

    private $hasspecificheader = false;  // States if we have a specific header and therefore header toggle functionality is needed.
    private $navdraweropen = false;

    /**
     * Constructor
     *
     * @param moodle_page $page the page we are doing output for.
     * @param string $target one of rendering target constants
     */
    public function __construct(\moodle_page $page, $target) {
        parent::__construct($page, $target);

        // Nav drawer init.
        user_preference_allow_ajax_update('drawer-open-nav', PARAM_ALPHA);

        if (isloggedin()) {
            $this->navdraweropen = (get_user_preferences('drawer-open-nav', 'true') == 'true');
        } else {
            $this->navdraweropen = false;
        }
    }

    /**
     * Renders the "breadcrumb".
     * Uses bootstrap compatible html.
     *
     * @return string the HTML for the navbar.
     */
    public function navbar(): string {
        $items = $this->page->navbar->get_items();
        if (right_to_left()) {
            $dividericon = 'fa-angle-left';
        } else {
            $dividericon = 'fa-angle-right';
        }
        $divider = html_writer::tag('span',
            html_writer::start_tag('span', array('class' => 'fa ' . $dividericon . ' fa-lg')) .
            html_writer::end_tag('span'), array('class' => 'divider'));
        $breadcrumbs = array();
        foreach ($items as $item) {
            if ((empty($this->page->theme->settings->showsectioninbreadcrumb)) && ($item->type == 30)) {
                continue;
            }
            if ((empty($this->page->theme->settings->showsysteminbreadcrumb)) && ($item->type == 0)) {
                continue;
            }
            $item->hideicon = true;
            $breadcrumbs[] = $this->render($item);
        }
        $glue = "$divider".html_writer::end_tag('li').html_writer::start_tag('li', array('class' => 'breadcrumb-item'));
        $listitems = html_writer::start_tag('li', array('class' => 'breadcrumb-item')) . implode($glue, $breadcrumbs).html_writer::end_tag('li');
        $title = html_writer::tag('span', get_string('pagepath'), array('class' => 'accesshide'));
        return $title . html_writer::tag('ul', "$listitems", array('class' => 'breadcrumb'));
    }

    /**
     * This code renders the navbar button to control the display of the custom menu
     * on smaller screens.
     *
     * Do not display the button if the menu is empty.
     *
     * @return string HTML fragment
     */
    protected function navbar_button() {
        $iconbar = '<i class="icon fa fa-bars fa-fw " aria-hidden="true"><span class="sr-only">'.get_string('campusnav', 'theme_campus').'</span></i>';
        $button = html_writer::tag('li',
            html_writer::tag('a', $iconbar, array(
                'class'       => 'btn btn-navbar nav-link',
                'data-toggle' => 'collapse',
                'data-target' => '.campusnav',
                'type' => 'button'
            ))
        );

        return $button;
    }

    /**
     * Allow plugins to provide some content to be rendered in the navbar.
     * The plugin must define a PLUGIN_render_navbar_output function that returns
     * the HTML they wish to add to the navbar.
     *
     * @return string HTML for the navbar
     */
    public function navbar_plugin_output() {
        $output = parent::navbar_plugin_output();

        if (!empty($output)) {
            $output = '<li class="nav-item">'.$output.'</li>';
        }

        return $output;
    }

    /**
     * Returns HTML to display a "Turn editing on/off" button in a form.
     *
     * @param moodle_url $url The URL + params to send through when clicking the button
     * @param string $method
     * @return string HTML the button
     */
    public function edit_button(moodle_url $url, string $method = 'post') {
        $url->param('sesskey', sesskey());
        if ($this->page->user_is_editing()) {
            $url->param('edit', 'off');
            $btn = 'btn-danger';
            $title = get_string('turneditingoff');
            $icon = 'fa-power-off';
        } else {
            $url->param('edit', 'on');
            $btn = 'btn-success';
            $title = get_string('turneditingon');
            $icon = 'fa-edit';
        }
        return html_writer::tag('a', html_writer::tag('i', '', array('class' => $icon.' fa fa-fw')),
            array('href' => $url, 'class' => 'btn '.$btn, 'title' => $title));
    }

    /**
     * Gets the secondary navigation if any.
     *
     * @return null or an array containing the secondary navigation and if there, overflow entries.
     */
    public function secondarynavigation() {
        $retr = null;

        if ($this->page->has_secondary_navigation()) {
            $tablistnav = $this->page->has_tablist_secondary_navigation();
            $moremenu = new \core\navigation\output\more_menu($this->page->secondarynav, 'nav-tabs', true, $tablistnav);
            $retr['secondarynavigation'] = $moremenu->export_for_template($this);
            $overflowdata = $this->page->secondarynav->get_overflow_menu_data();
            if (!is_null($overflowdata)) {
                $retr['overflow'] = $overflowdata->export_for_template($this);
            }
        }

        return $retr;
    }

    /**
     * Returns HTML to show the course settings in the course.
     *
     * @param moodle_url $url The URL + params to send through when clicking the button
     * @return string HTML the button
     */
    public function incourse_settings() {
        $output = '';

        $node = \theme_campus\toolbox::get_incourse_settings();
        if (!empty($node)) {
            $templatecontext = new \stdClass;
            $templatecontext->node = $node;
            $output = $this->render_from_template('theme_campus/course_settings_incourse', $templatecontext);
        }

        return $output;
    }

    /**
     * Returns course-specific information to be output immediately above content on any course page
     * (for the current course).
     *
     * @param bool $onlyifnotcalledbefore output content only if it has not been output before.
     * @return string.
     */
    public function course_content_header($onlyifnotcalledbefore = false) {
        $output = '';

        $activitynode = \theme_campus\toolbox::get_incourse_activity_settings();
        if (!empty($activitynode)) {
            $output .= '<div id="campus-activity-settings-wrapper">';

            $actionsmenustr = get_string('actionsmenu');
            $output .= '<div id="campus-activity-settings-toggle" class="ml-2">';
            $output .= '<i class="icon fa fa-cog fa-fw fa-lg" title="'.$actionsmenustr.'" aria-label="'.$actionsmenustr.'">';
            $output .= '<span class="sr-only">'.$actionsmenustr.'</span></i></div>';

            $templatecontext = new \stdClass;
            $templatecontext->activitynode = $activitynode;
            $output .= $this->render_from_template('theme_campus/activity_settings_incourse', $templatecontext);

            $output .= '</div>';
        } else {
            $settingsmenu = $this->region_main_settings_menu();
            if (!empty($settingsmenu)) {
                $output .= \html_writer::div(
                    $settingsmenu,
                    'd-print-none',
                    ['id' => 'region-main-settings-menu']
                );
            }
        }

        $output .= parent::course_content_header($onlyifnotcalledbefore);

        return $output;
    }

    /**
     * Override to display course settings on every course site for permanent access.
     *
     * Adapted from the Boost_Campus theme.
     *
     * @copyright 2017 Kathrin Osswald, Ulm University kathrin.osswald@uni-ulm.de
     * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
     *
     * This is an optional menu that can be added to a layout by a theme. It contains the
     * menu for the course administration, only on the course main page.
     *
     * MODIFICATION: This renderer function is copied and modified from /lib/outputrenderers.php.
     *
     * @return string
     */
    public function context_header_settings_menu() {
        $context = $this->page->context;
        $menu = new \action_menu();

        $items = $this->page->navbar->get_items();
        $currentnode = end($items);

        $showcoursemenu = false;
        $showfrontpagemenu = false;
        $showusermenu = false;

        // We are on the course home page.
        // MODIFICATION START.
        // REASON: With the original code, the course settings icon will only appear on the course main page.
        // Therefore the access to the course settings and related functions is not possible on other
        // course pages as there is no omnipresent block anymore. We want these to be accessible
        // on each course page.
        if (($context->contextlevel == CONTEXT_COURSE || $context->contextlevel == CONTEXT_MODULE) && !empty($currentnode)) {
            $showcoursemenu = true;
        }
        // MODIFICATION END.
        // @codingStandardsIgnoreStart
        /* ORIGINAL START.
        if (($context->contextlevel == CONTEXT_COURSE) &&
                !empty($currentnode) &&
                ($currentnode->type == navigation_node::TYPE_COURSE || $currentnode->type == navigation_node::TYPE_SECTION)) {
            $showcoursemenu = true;
        }
        ORIGINAL END. */
        // @codingStandardsIgnoreEnd

        $courseformat = course_get_format($this->page->course);
        // This is a single activity course format, always show the course menu on the activity main page.
        if ($context->contextlevel == CONTEXT_MODULE &&
                !$courseformat->has_view_page()) {

            $this->page->navigation->initialise();
            $activenode = $this->page->navigation->find_active_node();
            // If the settings menu has been forced then show the menu.
            if ($this->page->is_settings_menu_forced()) {
                $showcoursemenu = true;
            } else if (!empty($activenode) && ($activenode->type == \navigation_node::TYPE_ACTIVITY ||
                        $activenode->type == \navigation_node::TYPE_RESOURCE)) {

                // We only want to show the menu on the first page of the activity. This means
                // the breadcrumb has no additional nodes.
                if ($currentnode && ($currentnode->key == $activenode->key && $currentnode->type == $activenode->type)) {
                    $showcoursemenu = true;
                }
            }
        }

        // This is the site front page.
        if ($context->contextlevel == CONTEXT_COURSE &&
                !empty($currentnode) &&
                $currentnode->key === 'home') {
            $showfrontpagemenu = true;
        }

        // This is the user profile page.
        if ($context->contextlevel == CONTEXT_USER &&
                !empty($currentnode) &&
                ($currentnode->key === 'myprofile')) {
            $showusermenu = true;
        }

        if ($showfrontpagemenu) {
            $settingsnode = $this->page->settingsnav->find('frontpage', \navigation_node::TYPE_SETTING);
            if ($settingsnode) {
                // Build an action menu based on the visible nodes from this navigation tree.
                $skipped = $this->build_action_menu_from_navigation($menu, $settingsnode, false, true);

                // We only add a list to the full settings menu if we didn't include every node in the short menu.
                if ($skipped) {
                    $text = get_string('morenavigationlinks');
                    $url = new moodle_url('/course/admin.php', array('courseid' => $this->page->course->id));
                    $link = new \action_link($url, $text, null, null, new \pix_icon('t/edit', $text));
                    $menu->add_secondary_action($link);
                }
            }
        } else if ($showcoursemenu) {
            $settingsnode = $this->page->settingsnav->find('courseadmin', \navigation_node::TYPE_COURSE);
            if ($settingsnode) {
                // Build an action menu based on the visible nodes from this navigation tree.
                $skipped = $this->build_action_menu_from_navigation($menu, $settingsnode, false, true);

                // We only add a list to the full settings menu if we didn't include every node in the short menu.
                if ($skipped) {
                    $text = get_string('morenavigationlinks');
                    $url = new moodle_url('/course/admin.php', array('courseid' => $this->page->course->id));
                    $link = new \action_link($url, $text, null, null, new \pix_icon('t/edit', $text));
                    $menu->add_secondary_action($link);
                }
            }
        } else if ($showusermenu) {
            // Get the course admin node from the settings navigation.
            $settingsnode = $this->page->settingsnav->find('useraccount', \navigation_node::TYPE_CONTAINER);
            if ($settingsnode) {
                // Build an action menu based on the visible nodes from this navigation tree.
                $this->build_action_menu_from_navigation($menu, $settingsnode);
            }
        }

        return $this->render($menu);
    }

    /**
     * Returns the URL for the favicon.
     *
     * @since Moodle 2.5.1 2.6
     * @return string The favicon URL
     */
    public function favicon() {
        if (!empty($this->page->theme->settings->favicon)) {
            return $this->page->theme->setting_file_url('favicon', 'favicon');
        }
        return parent::favicon();
    }

    /**
     * Get the HTML for blocks in the given region.
     *
     * @since 2.5.1 2.6
     * @param string $region The region to get HTML for.
     * @param array $classes array of classes for the tag.
     * @param string $tag Tag to use.
     * @param int $blocksperrow if > 0 then this is a footer block specifying the number of blocks per row, max of '4'.
     * @return string HTML.
     */
    public function campusblocks($region, $classes = array(), $tag = 'aside', $blocksperrow = 0) {
        $classes = (array)$classes;
        $classes[] = 'block-region';
        $editing = $this->page->user_is_editing();

        if ($blocksperrow) {
            $classes[] = 'hblocks';
            if ($editing) {
                $classes[] = 'hblocks-container editing bpr-'.$blocksperrow;
            }
            if (($blocksperrow > 6) || ($blocksperrow < 1)) {
                $blocksperrow = 4;
            }
        }

        $attributes = array(
            'id' => 'block-region-'.preg_replace('#[^a-zA-Z0-9_\-]+#', '-', $region),
            'class' => join(' ', $classes),
            'data-blockregion' => $region,
            'data-droptarget' => '1'
        );
        if ($this->page->blocks->region_has_content($region, $this)) {
            if ($blocksperrow) {
                $content = $this->campus_blocks_for_region($region, $blocksperrow, $editing);
            } else {
                $content = $this->blocks_for_region($region);
            }
        } else {
            $content = '';
        }
        return html_writer::tag($tag, $content, $attributes);
    }

    // Nav drawer split blocks.
    /**
     * Get the HTML for blocks in the given region.
     *
     * @param string $region The region to get HTML for.
     * @param boolean $fakeblock Fake blocks or without fake blocks.
     * @return string HTML.
     */
    public function splitblocks($region, $fakeblock, $classes = array(), $tag = 'aside') {
        $displayregion = $this->page->apply_theme_region_manipulations($region);
        $classes = (array)$classes;
        $attributes = array();

        if ($fakeblock) {
            $classes[] = 'fake-block-region';
            $attributes['id'] = 'fakeblock-region-'.preg_replace('#[^a-zA-Z0-9_\-]+#', '-', $displayregion).'-fake';
        } else {
            $classes[] = 'block-region';
            $attributes['id'] = 'block-region-'.preg_replace('#[^a-zA-Z0-9_\-]+#', '-', $displayregion);
            $attributes['data-blockregion'] = $displayregion;
            $attributes['data-droptarget'] = '1';
        }
        $attributes['class'] = join(' ', $classes);

        if ($this->page->blocks->region_has_content($displayregion, $this)) {
            $content = $this->splitblocks_for_region($displayregion, $fakeblock);
        } else {
            $content = '';
        }
        $output = html_writer::tag($tag, $content, $attributes);

        return $output;
    }

    /**
     * Output all the blocks in a particular region.
     *
     * @param string $region the name of a region on this page.
     * @param boolean $fakeblock Fake blocks or without fake blocks.
     * @return string the HTML to be output.
     */
    public function splitblocks_for_region($region, $fakeblock) {
        $blockcontents = $this->page->blocks->get_content_for_region($region, $this);
        $lastblock = null;
        $zones = array();
        foreach ($blockcontents as $bc) {
            if ($bc instanceof block_contents) {
                $zones[] = $bc->title; // MDL-64818.
            }
        }
        $output = '';

        foreach ($blockcontents as $bc) {
            if ($bc instanceof block_contents) {
                if ($fakeblock) {
                    if ($bc->attributes['data-block'] == '_fake') {
                        $output .= $this->block($bc, $region);
                    }
                } else {
                    if ($bc->attributes['data-block'] != '_fake') {
                        $output .= $this->block($bc, $region);
                    }
                }
                $lastblock = $bc->title;
            } else if ($bc instanceof block_move_target) {
                $output .= $this->block_move_target($bc, $zones, $lastblock, $region);
            } else {
                throw new coding_exception('Unexpected type of thing (' . get_class($bc) . ') found in list of block contents.');
            }
        }
        return $output;
    }

    /**
     * Output all the blocks in a particular region.
     *
     * @param string $region the name of a region on this page.
     * @param boolean $fakeblocksonly Output fake block only.
     * @return string the HTML to be output.
     */
    public function blocks_for_region($region, $fakeblocksonly = false) {
        $blockcontents = $this->page->blocks->get_content_for_region($region, $this);
        $blocks = $this->page->blocks->get_blocks_for_region($region);

        $lastblock = null;
        $zones = array();
        foreach ($blocks as $block) {
            $zones[] = $block->title;
        }
        $output = '';

        foreach ($blockcontents as $bc) {
            if ($bc instanceof block_contents) {
                if ($fakeblocksonly && !$bc->is_fake()) {
                    // Skip rendering real blocks if we only want to show fake blocks.
                    continue;
                }
                $output .= $this->block($bc, $region);
                $lastblock = $bc->title;
            } else if ($bc instanceof block_move_target) {
                if (!$fakeblocksonly) {
                    $output .= $this->block_move_target($bc, $zones, $lastblock, $region);
                }
            } else {
                throw new coding_exception('Unexpected type of thing (' . get_class($bc) . ') found in list of block contents.');
            }
        }
        return $output;
    }

    /**
     * Output all the blocks in a particular region.
     *
     * Note: Assumes will never be used for region with the navigation block.
     *
     * @param string $region the name of a region on this page.
     * @param int $blocksperrow Number of blocks per row, if > 4 will be set at 4.
     * @param boolean $editing If we are editing.
     * @return string the HTML to be output.
     */
    protected function campus_blocks_for_region($region, $blocksperrow, $editing) {
        $blockcontents = $this->page->blocks->get_content_for_region($region, $this);
        $blocks = $this->page->blocks->get_blocks_for_region($region);
        $lastblock = null;
        $zones = array();
        foreach ($blocks as $block) {
            $zones[] = $block->title;
        }
        $output = '';

        $blockcount = count($blockcontents);

        if ($blockcount >= 1) {
            $rows = $blockcount / $blocksperrow; // Maximum blocks per row.

            if (!$editing) {
                if ($rows <= 1) {
                    $col = $blockcount;
                    if ($col < 1) {
                        // Should not happen but a fail safe.  Will look intentionally odd.
                        $col = 4;
                    }
                } else {
                    $col = $blocksperrow;
                }
                $output .= html_writer::start_tag('div', array('class' => 'hblocks-container'));
            }

            $currentblockcount = 0;
            $currentrow = 0;
            $currentrequiredrow = 1;

            foreach ($blockcontents as $bc) {
                if (!$editing) { // Using CSS when editing.
                    $currentblockcount++;
                    if ($currentblockcount > ($currentrequiredrow * $blocksperrow)) {
                        // Tripping point.
                        $currentrequiredrow++;
                        // Break...
                        $output .= html_writer::end_tag('div');
                        $output .= html_writer::start_tag('div', array('class' => 'hblocks-container'));
                        // Recalculate col if needed...
                        $remainingblocks = $blockcount - ($currentblockcount - 1);
                        if ($remainingblocks < $blocksperrow) {
                            $col = $remainingblocks;
                            if ($col < 1) {
                                // Should not happen but a fail safe.  Will look intentionally odd.
                                $col = 4;
                            }
                        }
                    }

                    if ($currentrow < $currentrequiredrow) {
                        $currentrow = $currentrequiredrow;
                    }

                    $bc->attributes['width'] = 'hblocks-col hblocks-col-'.$col;
                }

                if ($bc instanceof block_contents) {
                    $output .= $this->block($bc, $region);
                    $lastblock = $bc->title;
                } else if ($bc instanceof block_move_target) {
                    $output .= $this->block_move_target($bc, $zones, $lastblock, $region);
                } else {
                    throw new coding_exception('Unexpected type of thing ('.get_class($bc).') found in list of block contents.');
                }
            }
            if (!$editing) {
                $output .= html_writer::end_tag('div');
            }
        }

        return $output;
    }

    /**
     * Prints a nice side block with an optional header.
     *
     * @param block_contents $bc HTML for the content
     * @param string $region the region the block is appearing in.
     * @return string the HTML to be output.
     */
    public function block(block_contents $bc, $region) {
        $bc = clone($bc); // Avoid messing up the object passed in.
        if (empty($bc->blockinstanceid) || !strip_tags($bc->title)) {
            $bc->collapsible = block_contents::NOT_HIDEABLE;
        } else {
            user_preference_allow_ajax_update('block'.$bc->blockinstanceid.'hidden', PARAM_INT);
        }
        $id = !empty($bc->attributes['id']) ? $bc->attributes['id'] : uniqid('block-');
        $context = new \stdClass();
        $context->skipid = $bc->skipid;
        $context->blockinstanceid = $bc->blockinstanceid;
        $context->dockable = $bc->dockable;
        $context->collapsible = $bc->collapsible;
        $context->id = $id;
        $context->hidden = $bc->collapsible == block_contents::HIDDEN;
        $context->skiptitle = strip_tags($bc->title);
        $context->showskiplink = !empty($context->skiptitle);
        $context->arialabel = $bc->arialabel;
        $context->ariarole = !empty($bc->attributes['role']) ? $bc->attributes['role'] : 'complementary';
        $context->type = $bc->attributes['data-block'];
        $context->title = $bc->title;
        $context->content = $bc->content;
        $context->annotation = $bc->annotation;
        $context->footer = $bc->footer;
        $context->hascontrols = !empty($bc->controls);
        if (!empty($bc->attributes['width'])) {
            $context->haswidth = true;
            $context->width = $bc->attributes['width'];
        } else {
            $context->haswidth = false;
            $context->width = '';
        }
        if ($context->hascontrols) {
            $context->controls = $this->block_controls($bc->controls, $id);
        }
        if ($region == 'side-nav') {
            $context->sidenav = true;
        }

        return $this->render_from_template('core/block', $context);
    }

    public function gotobottom_menu() {
        $gotobottom = '';
        if (($this->page->pagelayout == 'course') || ($this->page->pagelayout == 'incourse') ||
            ($this->page->pagelayout == 'admin')) { // Go to bottom.
            $icon = html_writer::start_tag('span', array('class' => 'fa fa-arrow-circle-o-down slgotobottom')) . html_writer::end_tag('span');
            $gotobottom = html_writer::tag('li', $icon,
                array('class' => 'nav-item gotoBottom', 'title' => get_string('gotobottom', 'theme_campus')));

        }
        return $gotobottom;
    }

    public function anti_gravity() {
        $icon = html_writer::start_tag('span', array('class' => 'fa fa-arrow-circle-o-up')) . html_writer::end_tag('span');
        $antigravity = html_writer::tag('span', $icon,
            array('class' => 'antiGravity', 'title' => get_string('antigravity', 'theme_campus')));

        return $antigravity;
    }

    /**
     * Returns a search box.
     *
     * @param  string $id     The search box wrapper div id, defaults to an autogenerated one.
     * @return string         HTML with the search form hidden by default.
     */
    public function search_box($id = false) {
        global $CFG;

        // Accessing $CFG directly as using \core_search::is_global_search_enabled would
        // result in an extra included file for each site, even the ones where global search
        // is disabled.
        if (empty($CFG->enableglobalsearch) || !has_capability('moodle/search:query', \context_system::instance())) {
            return '';
        }

        if ($id == false) {
            $id = uniqid();
        } else {
            // Needs to be cleaned, we use it for the input id.
            $id = clean_param($id, PARAM_ALPHANUMEXT);
        }

        // JS to animate the form.
        $this->page->requires->js_call_amd('core/search-input', 'init', array($id));

        $searchicon = html_writer::tag('span', '',
            array('class' => 'fa fa-search', 'aria-hidden' => 'true', 'title' => get_string('search', 'search')));
        $searchicon = html_writer::tag('div', $searchicon, array('role' => 'button', 'tabindex' => 0));
        $formattrs = array('class' => 'search-input-form', 'action' => $CFG->wwwroot . '/search/index.php');
        $inputattrs = array('type' => 'text', 'name' => 'q', 'placeholder' => get_string('search', 'search'),
            'size' => 13, 'tabindex' => -1, 'id' => 'id_q_' . $id);

        $contents = html_writer::tag('label', get_string('enteryoursearchquery', 'search'),
            array('for' => 'id_q_' . $id, 'class' => 'accesshide')) . html_writer::tag('input', '', $inputattrs);
        $searchinput = html_writer::tag('form', $contents, $formattrs);

        return html_writer::tag('div', $searchicon . $searchinput, array('class' => 'search-input-wrapper', 'id' => $id));
    }

    /**
     * Return the standard string that says whether you are logged in (and switched
     * roles/logged in as another user).
     * @param bool $withlinks if false, then don't include any links in the HTML produced.
     * If not set, the default is the nologinlinks option from the theme config.php file,
     * and if that is not set, then links are included.
     * @return string HTML fragment.
     */
    public function login_info($withlinks = null) {
        global $USER, $CFG, $DB, $SESSION;

        if (during_initial_install()) {
            return '';
        }

        if (is_null($withlinks)) {
            $withlinks = empty($this->page->layout_options['nologinlinks']);
        }

        $loginurl = $this->campus_get_login_url();
        $loginpage = ((string) $this->page->url === $loginurl);
        $course = $this->page->course;
        if (\core\session\manager::is_loggedinas()) {
            $realuser = \core\session\manager::get_realuser();
            $fullname = fullname($realuser, true);
            if ($withlinks) {
                $loginastitle = get_string('loginas');
                $realuserinfo = " [<a href=\"$CFG->wwwroot/course/loginas.php?id=$course->id&amp;sesskey=" . sesskey() . "\"";
                $realuserinfo .= "title =\"" . $loginastitle . "\">$fullname</a>] ";
            } else {
                $realuserinfo = " [$fullname] ";
            }
        } else {
            $realuserinfo = '';
        }

        $subscribeurl = preg_replace('/login\/index\.php/i', 'login/signup.php', $loginurl);

        if (empty($course->id)) {
            // $course->id is not defined during installation
            return '';
        } else if (isloggedin()) {
            $context = context_course::instance($course->id);

            $fullname = fullname($USER, true);
            // Since Moodle 2.0 this link always goes to the public profile page (not the course profile page)
            if ($withlinks) {
                $linktitle = get_string('viewprofile');
                $username = "<a href=\"$CFG->wwwroot/user/profile.php?id=$USER->id\" title=\"$linktitle\">$fullname</a>";
            } else {
                $username = $fullname;
            }
            if (is_mnet_remote_user($USER) and $idprovider = $DB->get_record('mnet_host',
                    array('id' => $USER->mnethostid))) {
                if ($withlinks) {
                    $username .= " from <a href=\"{$idprovider->wwwroot}\">{$idprovider->name}</a>";
                } else {
                    $username .= " from {$idprovider->name}";
                }
            }
            if (isguestuser()) {
                if (!$loginpage && $withlinks) {
                    $loggedinas = " <a class=\"standardbutton plainlogin btn\" href=\"$loginurl\">" . get_string('login') . '</a>';
                }
            } else if (is_role_switched($course->id)) { // Has switched roles
                $rolename = '';
                if ($role = $DB->get_record('role', array('id' => $USER->access['rsw'][$context->path]))) {
                    $rolename = ': ' . role_get_name($role, $context);
                }
                $loggedinas = '<span class="loggedintext">' . get_string('loggedinas', 'moodle', $username) . $rolename . '</span>';
                if ($withlinks) {
                    $url = new moodle_url('/course/switchrole.php',
                            array('id' => $course->id, 'sesskey' => sesskey(), 'switchrole' => 0, 'returnurl' => $this->page->url->out_as_local_url(false)));
                    $loggedinas .= '(' . html_writer::tag('a', get_string('switchrolereturn'),
                                    array('href' => $url, 'class' => 'btn switchrolereturn')) . ')';
                }
            } else {
                $loggedinas = '<span class="loggedintext">' . $realuserinfo . get_string('loggedinas', 'moodle',
                                $username) . '</span>';
                if ($withlinks) {
                    $loggedinas .= html_writer::tag('div',
                                    html_writer::link(new moodle_url('/login/logout.php?sesskey=' . sesskey()),
                                            '<em><span class="fa fa-sign-out"></span>' . get_string('logout') . '</em>'));
                }
            }
        } else {
            if (!$loginpage && $withlinks) {
                $loggedinas = "<a class=\"standardbutton plainlogin btn\" href=\"$loginurl\">" . get_string('login') . '</a>';
            }
        }

        if (!empty($loggedinas)) {
            $loggedinas = '<div class="logininfo">' . $loggedinas . '</div>';
        } else {
            $loggedinas = '';
        }

        if (isset($SESSION->justloggedin)) {
            unset($SESSION->justloggedin);
            if (!empty($CFG->displayloginfailures)) {
                if (!isguestuser()) {
                    if ($count = \user_count_login_failures($USER)) {
                        $loggedinas .= '<div class="loginfailures">';
                        $loggedinas .= get_string('failedloginattempts', '', array('attempts' => $count));
                        if (file_exists("$CFG->dirroot/report/log/index.php") and has_capability('report/log:view', context_system::instance())) {
                            $loggedinas .= ' ('.html_writer::link(new moodle_url('/report/log/index.php', array('chooselog' => 1,
                                'id' => 0 , 'modid' => 'site_errors')), get_string('logs')).')';
                        }
                        $loggedinas .= '</div>';
                    }
                }
            }
        }

        return $loggedinas;
    }

    /**
     * Returns MNET Login URL instead of standard login URL. Checks the wanted url
     * of user in order to provide correct redirect url for the identity provider
     *
     * @return string login url
     */
    private function campus_get_login_url() {
        global $DB, $SESSION, $CFG;
        if (empty($this->page->theme->settings->alternateloginurl)) {
            return get_login_url();
        }
        if ($this->page->url->out() === $CFG->wwwroot . "/login/index.php") {
            $urltogo = $SESSION->wantsurl;
        } else {
            $urltogo = $this->page->url->out();
        }
        $authplugin = get_auth_plugin('mnet');
        $authurl = $authplugin->loginpage_idp_list($urltogo);

        // Check the id of the MNET host for the idp
        $host = $DB->get_field('mnet_host', 'name', array('id' => $this->page->theme->settings->alternateloginurl));
        if (!empty($authurl)) {
            foreach ($authurl as $key => $urlarray) {
                if ($urlarray['name'] == $host) {
                    $loginurl = $authurl[$key]['url'];
                    return $loginurl;
                } else {
                    $loginurl = "$CFG->wwwroot/login/index.php";
                    if (!empty($CFG->loginhttps)) {
                        $loginurl = str_replace('http:', 'https:', $loginurl);
                    }
                }
            }
        } else {
            $loginurl = "$CFG->wwwroot/login/index.php";
            if (!empty($CFG->loginhttps)) {
                $loginurl = str_replace('http:', 'https:', $loginurl);
            }
        }
        return $loginurl;
    }

    /**
     * Returns HTML attributes to use within the body tag. This includes an ID and classes.
     *
     * @since Moodle 2.5.1 2.6
     * @param string|array $additionalclasses Any additional classes to give the body tag,
     * @return string
     */
    public function body_attributes($additionalclasses = array()) {
        if ($this->page->pagelayout == 'login') {
            $hidelocallogin = (!isset($this->page->theme->settings->hidelocallogin)) ? false : $this->page->theme->settings->hidelocallogin;
            if ($hidelocallogin) {
                if (is_array($additionalclasses)) {
                    $additionalclasses[] = 'hidelocallogin';
                } else {
                    $additionalclasses .= ' hidelocallogin';
                }
            }
        }
        if (!$this->page->user_is_editing()) {
            if (is_array($additionalclasses)) {
                $additionalclasses[] = 'notediting';
            } else {
                $additionalclasses .= ' notediting';
            }
        }

        if ($this->navdraweropen) {
            if (is_array($additionalclasses)) {
                $additionalclasses[] = 'drawer-open-left';
            } else {
                $additionalclasses .= ' drawer-open-left';
            }
        }

        return parent::body_attributes($additionalclasses);
    }

    /**
     * States if the frontpage header is being used on another page than the frontpage itself.
     * If logic in optional_jquery() / course_category_header() changes, then change this too.
     */
    public function using_frontpage_header_on_another_page() {
        $usingfph = false;

        $pagelayout = $this->page->pagelayout;
        if (($this->page->course->format == 'site') && (($pagelayout == 'incourse') || ($pagelayout == 'report'))) {
            $usingfph = true; // All site modules need to use the front page header as they have no top level category.
        } else if (get_config('theme_campus', 'usefrontpageheader')) {  // If set then use the front page header on all unless specific header set.
            switch ($pagelayout) {
                case 'coursecategory':
                case 'course':
                case 'incourse':
                case 'report':
                    $usingfph = false;
                break;
                default:
                    $usingfph = true;
                break;
            }
        }

        return $usingfph;
    }

    /**
     * Returns the header file name in the 'tiles' folder to use for the current page.
     * If logic in optional_jquery() / course_category_header() changes, then change this
     * and using_frontpage_header_on_another_page() too.
     */
    public function get_header_file() {
        $thefile = 'header'; // Default if not a specific header.

        if ($this->using_frontpage_header_on_another_page()) {
            $thefile = 'frontpage-header';
        } else {
            $pagelayout = $this->page->pagelayout;
            switch ($pagelayout) {
                case 'frontpage':
                    $thefile = 'frontpage-header';
                    break;
                case 'coursecategory':
                case 'course':
                case 'incourse':
                case 'report':
                    $thefile = 'coursecategory-header';
                    break;
            }
        }

        return $thefile.'.php';
    }

    /**
     * Works out and adds optional jQuery on the page if needed by criteria.
     * If logic in get_header_file() / course_category_header() changes, then change this
     * and using_frontpage_header_on_another_page() too.
     *
     * MUST be called before any page output happens.
     */
    public function optional_jquery() {
        $stickynavbar = false;

        $pagelayout = $this->page->pagelayout;
        if ($pagelayout == 'frontpage') {
            /*$autoplay = (!empty($this->page->theme->settings->carouselautoplay)) ? $this->page->theme->settings->carouselautoplay : 2;  // Default of 'Yes'.
            if ($autoplay == 2) {
                $slideinterval = (!empty($this->page->theme->settings->slideinterval)) ? $this->page->theme->settings->slideinterval : 5000;
            } else {
                $slideinterval = 0;
            }
            $data = array('data' => array('slideinterval' => $slideinterval));
            $this->page->requires->js_call_amd('theme_campus/carousel', 'init', $data); // Carousel can only exist on front page or top level category pages.*/
            // We are the front page setting enforce the intent.
            if (!empty($this->page->theme->settings->frontpagestickynavbar)) {
                $stickynavbar = true;
            }
            $this->hasspecificheader = true;
        } else {
            if ($this->using_frontpage_header_on_another_page()) {
                if (!empty($this->page->theme->settings->frontpagestickynavbar)) {
                    $stickynavbar = true;
                }
                $this->hasspecificheader = true;
            } else {
                if (!empty($this->page->theme->settings->stickynavbar)) {
                    $stickynavbar = true;
                }
                switch ($pagelayout) {
                    case 'coursecategory':
                        $currentcategory = $this->get_current_top_level_catetgory();
                        /*$autoplay = (!empty($this->page->theme->settings->carouselautoplay)) ? $this->page->theme->settings->carouselautoplay : 2;  // Default of 'Yes'.
                        if ($autoplay == 2) {
                            $slideinterval = (!empty($this->page->theme->settings->slideinterval)) ? $this->page->theme->settings->slideinterval : 5000;
                        } else {
                            $slideinterval = 0;
                        }
                        $data = array('data' => array('slideinterval' => $slideinterval));
                        $this->page->requires->js_call_amd('theme_campus/carousel', 'init', $data); // Carousel can only exist on front page or top level category pages.*/
                        $this->hasspecificheader = true;
                        $cchavecustomsetting = 'coursecategoryhavecustomheader' . $currentcategory;
                        if (!empty($this->page->theme->settings->$cchavecustomsetting)) {
                            // We have a custom setting so enforce the intent.
                            $cchavestickysetting = 'coursecategorystickynavbar' . $currentcategory;
                            if (!empty($this->page->theme->settings->$cchavestickysetting)) {
                                $stickynavbar = true;
                            } else {
                                $stickynavbar = false;
                            }
                        }
                        break;
                    case 'course':
                    case 'incourse':
                    case 'report':
                        // From our point of view, the same as is_course_page().
                        $this->hasspecificheader = true;
                        $currentcategory = $this->get_current_top_level_catetgory();
                        $cchavecustomsetting = 'coursecategoryhavecustomheader' . $currentcategory;
                        if (!empty($this->page->theme->settings->$cchavecustomsetting)) {
                            // We have a custom setting so enforce the intent.
                            $cchavestickysetting = 'coursecategorystickynavbar' . $currentcategory;
                            if (!empty($this->page->theme->settings->$cchavestickysetting)) {
                                $stickynavbar = true;
                            } else {
                                $stickynavbar = false;
                            }
                        }
                        break;
                }
            }
        }

        if ($stickynavbar) {
            $this->page->requires->js_call_amd('theme_campus/affix', 'init');
            if ($pagelayout == 'course') {
                $this->page->requires->js_call_amd('theme_campus/course_navigation', 'init');
            }
        }
    }

    public function render_flatnav() {
        $output = '';

        if ($this->page->blocks->is_known_region('side-nav')) {
            $nav = $this->page->flatnav;

            $blocksnavfakehtml = $this->splitblocks('side-nav', true);
            $hasnavfakeblocks = strpos($blocksnavfakehtml, 'data-block=') !== false;
            $blocksnavhtml = $this->splitblocks('side-nav', false);
            $hasnavblocks = strpos($blocksnavhtml, 'data-block=') !== false;

            $templatecontext = [
                'navdraweropen' => $this->navdraweropen,
                'flatnavigation' => $nav,
                'firstcollectionlabel' => $nav->get_collectionlabel(),
                'sidenavfakeblocks' => $blocksnavfakehtml,
                'hasnavfakeblocks' => $hasnavfakeblocks,
                'sidenavblocks' => $blocksnavhtml,
                'hasnavblocks' => $hasnavblocks
            ];

            $output .= $this->render_from_template('theme_campus/nav-drawer', $templatecontext);
        }

        return $output;
    }

    public function render_flatnav_button() {
        $templatecontext = [
            'navdraweropen' => $this->navdraweropen
        ];

        return $this->render_from_template('theme_campus/nav_drawer_button', $templatecontext);
    }

    /**
     * States if we are in a course or module of a course.
     */
    public function is_course_page() {
        $pagelayout = $this->page->pagelayout;
        switch ($pagelayout) {
            case 'course':
            case 'incourse':
            case 'report':
                $iscourse = true;
                break;
            default:
                $iscourse = false;
        }
        return $iscourse;
    }

    private function is_top_level_category($key = null) {
        global $CFG;
        if (file_exists("{$CFG->dirroot}/theme/campus/campus-lib.php")) {
            include_once($CFG->dirroot . '/theme/campus/campus-lib.php');
        } else if (!empty($CFG->themedir) && file_exists("{$CFG->themedir}/campus/campus-lib.php")) {
            include_once($CFG->themedir . '/campus/campus-lib.php');
        }
        if (empty($key)) {
            $key = $this->get_current_category();
        }
        if ($key) {
            return (array_key_exists($key, theme_campus_get_top_level_categories()));
        } else {
            return false;
        }
    }

    public function get_current_category() {
        $catid = 0;

        if (is_array($this->page->categories)) {
            $catids = array_keys($this->page->categories);
            $catid = reset($catids);
        } else if (!empty($$this->page->course->category)) {
            $catid = $this->page->course->category;
        }

        return $catid;
    }

    public function get_current_top_level_catetgory() {
        $catid = false;

        if (is_array($this->page->categories)) {
            $catids = array_keys($this->page->categories);
            if (!empty($catids)) {
                // The last entry in the array is the top level category.
                $catid = $catids[(count($catids) - 1)];
            }
        } else if (!empty($this->page->course->category)) {
            $catid = $this->page->course->category;
            // See if the course category is a top level one.
            if (!array_key_exists($catid, theme_campus_get_top_level_categories())) {
                $catid = false;
            }
        }

        return $catid;
    }

    /**
     * Gets HTML for the page heading.  Called from navbar.
     *
     * @since Moodle 2.5.1 2.6.
     * @param string $tag The tag to encase the heading in. h1 by default.
     * @return string HTML.
     */
    public function page_heading($tag = 'h1') {
        if (($this->page->pagelayout == 'frontpage') || ($this->using_frontpage_header_on_another_page())) {
            if ((!empty($this->page->theme->settings->frontpagepageheadinglocation)) &&
                ($this->page->theme->settings->frontpagepageheadinglocation == 1)) {
                return $this->get_page_heading();
            } else {
                return '';
            }
        } else if ($this->course_category_header()) {
            if ((!empty($this->page->theme->settings->coursepagepageheadinglocation)) &&
                ($this->page->theme->settings->coursepagepageheadinglocation == 1)) {
                return $this->get_page_heading();
            } else {
                return '';
            }
        } else {
            $heading = $this->page->heading;
        }
        return $this->get_page_heading($heading);
    }

    public function get_page_heading($heading = null) {
        if (empty($heading)) {
            if ($this->page->pagelayout == 'coursecategory') {

                $currentcategory = $this->get_current_category();
                $category = \core_course_category::get($currentcategory);
                $heading = $category->name;
            } else {
                $heading = $this->page->heading;
            }
        }
        return '<h1 class="brand">' . $heading . '</h1>';
    }

    /**
     * States if the layout will have a course category header.
     *
     * If logic in get_header_file() / optional_jquery() changes, then change this
     * and using_frontpage_header_on_another_page() too.
     * @return boolean true or false.
     */
    public function course_category_header() {
        $cch = false;
        $pagelayout = $this->page->pagelayout;
        switch ($pagelayout) {
            case 'coursecategory':
            case 'course':
            case 'incourse':
            case 'report':
                $cch = true;
                break;
        }
        return $cch;
    }

    /**
     * Renders a navigation node object.
     *
     * @param navigation_node $item The navigation node to render.
     * @return string HTML fragment
     */
    protected function render_navigation_node(\navigation_node $item) {
        if ($item->action instanceof \action_link) {
            $action = clone($item->action);
            $item = clone($item);
            $item->action = $action;
        }
        return parent::render_navigation_node($item);
    }
}
