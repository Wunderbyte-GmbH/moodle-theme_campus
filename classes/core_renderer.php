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
class theme_campus_core_renderer extends theme_bootstrapbase_core_renderer {

    private $hasspecificheader = false;  // States if we have a specific header and therefore header toggle functionality is needed.

    /*
     * This renders the navbar.
     * Uses bootstrap compatible html.
     */

    public function navbar() {
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
        $list_items = html_writer::start_tag('li') . implode("$divider" . html_writer::end_tag('li') .
                        html_writer::start_tag('li'), $breadcrumbs) . html_writer::end_tag('li');
        $title = html_writer::tag('span', get_string('pagepath'), array('class' => 'accesshide'));
        return $title . html_writer::tag('ul', "$list_items", array('class' => 'breadcrumb'));
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
        $iconbar = html_writer::tag('span', '', array('class' => 'icon-bar'));
        $button = html_writer::tag('a', $iconbar . "\n" . $iconbar. "\n" . $iconbar. "\n" . $iconbar, array(
            'class'       => 'btn btn-navbar',
            'data-toggle' => 'collapse',
            'data-target' => '.campusnav'
        ));
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
            $output = '<li>'.$output.'</li>';
        }

        return $output;
    }

    /**
     * Returns HTML to display a "Turn editing on/off" button in a form.
     *
     * @param moodle_url $url The URL + params to send through when clicking the button
     * @return string HTML the button
     */
    public function edit_button(moodle_url $url) {
        $url->param('sesskey', sesskey());
        if ($this->page->user_is_editing()) {
            $url->param('edit', 'off');
            $btn = 'btn-danger';
            $title = get_string('turneditingoff');
            $icon = 'icon-off';
        } else {
            $url->param('edit', 'on');
            $btn = 'btn-success';
            $title = get_string('turneditingon');
            $icon = 'icon-edit';
        }
        return html_writer::tag('a',
                        html_writer::start_tag('span', array('class' => $icon . ' icon-white')) .
                        html_writer::end_tag('span'), array('href' => $url, 'class' => 'btn ' . $btn, 'title' => $title));
    }

    /**
     * Renders tabtree
     *
     * @param tabtree $tabtree
     * @return string
     */
    protected function render_tabtree(tabtree $tabtree) {
        if (empty($tabtree->subtree)) {
            return '';
        }
        $firstrow = $secondrow = '';
        foreach ($tabtree->subtree as $tab) {
            $firstrow .= $this->render($tab);
            if (($tab->selected || $tab->activated) && !empty($tab->subtree) && $tab->subtree !== array()) {
                $secondrow = $this->tabtree($tab->subtree);
            }
        }
        return html_writer::tag('ul', $firstrow, array('class' => 'nav nav-pills')) . $secondrow;
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
     * Get the HTML for blocks in side-pre and side-post if available.
     * Use only with two column layout files.
     *
     * @param array $classes array of classes for the tag.
     * @param string $tag Tag to use.
     * @return string HTML.
     */
    public function campussingleblocks($classes = array(), $tag = 'aside') {
        $classes = (array) $classes;
        $classes[] = 'block-region';

        $hassidepre = $this->page->blocks->is_known_region('side-pre');
        $hassidepost = $this->page->blocks->is_known_region('side-post');

        if ($hassidepre) {
            $regionprehascontent = $this->page->blocks->region_has_content('side-pre', $this);
            $displayregion = 'side-pre';
        } else {
            $regionprehascontent = false;
            $displayregion = 'side-post';
        }

        if ($hassidepost) {
            $regionposthascontent = $this->page->blocks->region_has_content('side-post', $this);
        } else {
            $regionposthascontent = false;
        }

        $attributes = array(
            'id' => 'block-region-' . preg_replace('#[^a-zA-Z0-9_\-]+#', '-', $displayregion),
            'class' => join(' ', $classes),
            'data-blockregion' => $displayregion,
            'data-droptarget' => '1'
        );

        if (($regionprehascontent) || ($regionposthascontent)) {
            $content = '';
            if ($regionprehascontent) {
                $content .= $this->blocks_for_region('side-pre');
            }
            if ($regionposthascontent) {
                $content .= $this->blocks_for_region('side-post');
            }
            $output = html_writer::tag($tag, $content, $attributes);
        } else {
            $output = html_writer::tag($tag, '', $attributes);
        }
        return $output;
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
        $displayregion = $this->page->apply_theme_region_manipulations($region);

        $classes = (array) $classes;
        $classes[] = 'block-region';

        $attributes = array(
            'id' => 'block-region-' . preg_replace('#[^a-zA-Z0-9_\-]+#', '-', $displayregion),
            'class' => join(' ', $classes),
            'data-blockregion' => $displayregion,
            'data-droptarget' => '1'
        );

        if ($this->page->blocks->region_has_content($displayregion, $this)) {
            if ($blocksperrow > 0) {
                $editing = $this->page->user_is_editing();
                if ($editing) {
                    $attributes['class'] .= ' ' . $region . '-edit';
                }
                $output = html_writer::tag($tag,
                                $this->campus_blocks_for_region($displayregion, $blocksperrow, $editing), $attributes);
            } else {
                $output = html_writer::tag($tag, $this->blocks_for_region($region), $attributes);
            }
        } else {
            $output = html_writer::tag($tag, '', $attributes);
        }
        return $output;
    }

    /**
     * Output all the blocks in a particular region.
     *
     * @param string $region the name of a region on this page.
     * @param int $blocksperrow Number of blocks per row, if > 4 will be set at 4.
     * @param boolean $editing If we are editing.
     * @return string the HTML to be output.
     */
    protected function campus_blocks_for_region($region, $blocksperrow, $editing) {
        $blockcontents = $this->page->blocks->get_content_for_region($region, $this);
        $output = '';

        $blockcount = count($blockcontents);

        if ($blockcount >= 1) {
            if (!$editing) {
                $output .= html_writer::start_tag('div', array('class' => 'row-fluid'));
            }
            $blocks = $this->page->blocks->get_blocks_for_region($region);
            $lastblock = null;
            $zones = array();
            foreach ($blocks as $block) {
                $zones[] = $block->title;
            }

            /*
             * When editing we want all the blocks to be the same as side-pre / side-post so set by CSS:
             *
             * aside.footer-edit .block {
             *     .footer-fluid-span(3);
             * }
             */
            if (($blocksperrow > 4) || ($editing)) {
                $blocksperrow = 4; // Will result in a 'span3' when more than one row.
            }
            $rows = $blockcount / $blocksperrow; // Maximum blocks per row.

            if (!$editing) {
                if ($rows <= 1) {
                    $span = 12 / $blockcount;
                    if ($span < 1) {
                        // Should not happen but a fail safe - block will be small so good for screen shots when this happens.
                        $span = 1;
                    }
                } else {
                    $span = 12 / $blocksperrow;
                }
            }

            $currentblockcount = 0;
            $currentrow = 0;
            $currentrequiredrow = 1;
            foreach ($blockcontents as $bc) {

                if (!$editing) { // Using CSS and special 'span3' only when editing.
                    $currentblockcount++;
                    if ($currentblockcount > ($currentrequiredrow * $blocksperrow)) {
                        // Tripping point.
                        $currentrequiredrow++;
                        // Break...
                        $output .= html_writer::end_tag('div');
                        $output .= html_writer::start_tag('div', array('class' => 'row-fluid'));
                        // Recalculate span if needed...
                        $remainingblocks = $blockcount - ($currentblockcount - 1);
                        if ($remainingblocks < $blocksperrow) {
                            $span = 12 / $remainingblocks;
                            if ($span < 1) {
                                // Should not happen but a fail safe - block will be small so good for screen shots when this happens.
                                $span = 1;
                            }
                        }
                    }

                    if ($currentrow < $currentrequiredrow) {
                        $currentrow = $currentrequiredrow;
                    }

                    // 'desktop-first-column' done in CSS with ':first-of-type' and ':nth-of-type'.
                    // 'spanX' done in CSS with calculated special width class as fixed at 'span3' for all.
                    $bc->attributes['class'] .= ' span' . $span;
                }

                if ($bc instanceof block_contents) {
                    $output .= $this->block($bc, $region);
                    $lastblock = $bc->title;
                } else if ($bc instanceof block_move_target) {
                    $output .= $this->block_move_target($bc, $zones, $lastblock, $region);
                } else {
                    throw new coding_exception('Unexpected type of thing (' . get_class($bc) . ') found in list of block contents.');
                }
            }
            if (!$editing) {
                $output .= html_writer::end_tag('div');
            }
        }

        return $output;
    }

    public function user_menu($user = NULL, $withlinks = NULL) {
        $usermenu = new custom_menu('', current_language());
        return $this->render_user_menu($usermenu);
    }

    protected function render_user_menu(custom_menu $menu) {
        $content = html_writer::start_tag('ul', array('class' => 'nav cpusermenu'));
        foreach ($menu->get_children() as $item) {
            $content .= $this->render_custom_menu_item($item, 1);
        }
        $content .= html_writer::end_tag('ul');

        return $content;
    }

    public function gotobottom_menu() {
        $gotobottom = '';
        if (($this->page->pagelayout == 'course') || ($this->page->pagelayout == 'incourse') ||
            ($this->page->pagelayout == 'admin')) { // Go to bottom.
            $icon = html_writer::start_tag('span', array('class' => 'fa fa-arrow-circle-o-down slgotobottom')) . html_writer::end_tag('span');
            $gotobottom = html_writer::tag('span', $icon,
                array('class' => 'nav gotoBottom', 'title' => get_string('gotobottom', 'theme_campus')));

        }
        return $gotobottom;
    }

    public function anti_gravity() {
        $icon = html_writer::start_tag('span', array('class' => 'fa fa-arrow-circle-o-up')) . html_writer::end_tag('span');
        $anti_gravity = html_writer::tag('span', $icon,
            array('class' => 'antiGravity', 'title' => get_string('antigravity', 'theme_campus')));

        return $anti_gravity;
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

    public function header_toggle_menu() {
        if (!empty($this->page->theme->settings->showheadertoggle)) {
            if ($this->hasspecificheader) {
                $headertoggle = html_writer::start_tag('li', array('class' => 'nav headertogglemenu'));
                $headertoggle .= html_writer::start_tag('a', array('title' => get_string('fullscreentoggle', 'theme_campus')));
                $headertoggle .= html_writer::tag('span', '',
                    array(
                        'class' => 'headertoggle fa fa-expand',
                        'title' => get_string('fullscreentoggleicon', 'theme_campus')
                    )
                );
                $headertoggle .= html_writer::end_tag('a');
                $headertoggle .= html_writer::end_tag('li');

                return $headertoggle;
            }
        }
        return '';
    }

    /*
     * This code renders the custom menu items for the
     * bootstrap dropdown menu.
     */
    protected function render_custom_menu_item(custom_menu_item $menunode, $level = 0 ) {
        static $submenucount = 0;

        $content = '';
        $title = array();
        // If the title is different to the text, then use it.  E.g. the language menu.
        if (strcmp($menunode->get_title(), $menunode->get_text()) != 0) {
            $title['title'] = $menunode->get_title();
        }
        if ($menunode->has_children()) {

            if ($level == 1) {
                $class = 'dropdown';
            } else {
                $class = 'dropdown-submenu';
            }

            if ($menunode === $this->language) {
                $class .= ' langmenu';
            }
            $content = html_writer::start_tag('li', array('class' => $class));
            // If the child has menus render it as a sub menu.
            $submenucount++;
            if ($menunode->get_url() !== null) {
                $url = $menunode->get_url();
            } else {
                $url = '#cm_submenu_'.$submenucount;
            }
            $attr = array('href'=>$url, 'class'=>'dropdown-toggle', 'data-toggle'=>'dropdown');
            if (!empty($title)) {
                $attr = array_merge($attr, $title);
            }
            $content .= html_writer::start_tag('a', $attr);
            $content .= $menunode->get_text();
            if ($level == 1) {
                $content .= '<strong class="caret"></strong>';
            }
            $content .= '</a>';
            $content .= '<ul class="dropdown-menu">';
            foreach ($menunode->get_children() as $menunode) {
                $content .= $this->render_custom_menu_item($menunode, 0);
            }
            $content .= '</ul>';
        } else {
            // The node doesn't have children so produce a final menuitem.
            // Also, if the node's text matches '####', add a class so we can treat it as a divider.
            if (preg_match("/^#+$/", $menunode->get_text())) {
                // This is a divider.
                $content = '<li class="divider">&nbsp;</li>';
            } else {
                $content = '<li>';
                if ($menunode->get_url() !== null) {
                    $url = $menunode->get_url();
                } else {
                    $url = '#';
                }
                $content .= html_writer::link($url, $menunode->get_text(), $title);
                $content .= '</li>';
            }
        }
        return $content;
    }

    /**
     * Outputs the user menu.
     * @return custom_menu object
     */
    public function custom_menu_user() {
        // Die if executed during install.
        if (during_initial_install()) {
            return false;
        }

        if ((!isloggedin()) || (isguestuser())) {
            return $this->login_info();
        }

        global $USER, $CFG;

        $usermenu = html_writer::start_tag('ul', array('class' => 'nav'));
        $usermenu .= html_writer::start_tag('li', array('class' => 'dropdown'));

        $course = $this->page->course;
        $context = context_course::instance($course->id);

        // Output Profile link.
        $userurl = $this->page->url;
        $userpic = parent::user_picture($USER, array('link' => false));
        $caret = '<span class="fa fa-caret-right"></span>';
        $userclass = array('class' => 'dropdown-toggle', 'data-toggle' => 'dropdown');

        $usermenu .= html_writer::link($userurl, $userpic . $USER->firstname . $caret, $userclass);

        // Start dropdown menu items.
        $usermenu .= html_writer::start_tag('ul', array('class' => 'dropdown-menu pull-right'));
        $usermenu .= html_writer::tag('li', $this->login_info());

        // Add preferences.
        $branchlabel = '<em><span class="fa fa-cog"></span>' . get_string('preferences') . '</em>';
        $branchurl = new moodle_url('/user/preferences.php');
        $usermenu .= html_writer::tag('li', html_writer::link($branchurl, $branchlabel));

        // Switch role to.
        if (!is_role_switched($course->id)) {
            // Build switch role link.
            $roles = get_switchable_roles($context);
            if (is_array($roles) && (count($roles) > 0)) {
                $branchlabel = '<em><span class="fa fa-users"></span>' . get_string('switchroleto') . '</em>';
                $branchurl = new moodle_url('/course/switchrole.php', array(
                    'id' => $course->id,
                    'switchrole' => -1,
                    'returnurl' => $this->page->url->out_as_local_url(false)
                ));
                $usermenu .= html_writer::tag('li', html_writer::link($branchurl, $branchlabel));
            }
        }

        $usermenu .= html_writer::empty_tag('hr', array('class' => 'sep'));

        // Output Calendar link if user is allowed to edit own calendar entries.
        if (has_capability('moodle/calendar:manageownentries', $context)) {
            $branchlabel = '<em><span class="fa fa-calendar"></span>' . get_string('pluginname', 'block_calendar_month') . '</em>';
            $branchurl = new moodle_url('/calendar/view.php');
            $usermenu .= html_writer::tag('li', html_writer::link($branchurl, $branchlabel));
        }

        // Check if messaging is enabled.
        if (!empty($CFG->messaging)) {
            $branchlabel = '<em><span class="fa fa-envelope"></span>' . get_string('pluginname', 'block_messages') . '</em>';
            $branchurl = new moodle_url('/message/index.php');
            $usermenu .= html_writer::tag('li', html_writer::link($branchurl, $branchlabel));
        }

        // Check if user is allowed to manage files.
        if (has_capability('moodle/user:manageownfiles', $context)) {
            $branchlabel = '<em><span class="fa fa-file"></span>' . get_string('privatefiles', 'block_private_files') . '</em>';
            $branchurl = new moodle_url('/user/files.php');
            $usermenu .= html_writer::tag('li', html_writer::link($branchurl, $branchlabel));
        }

        // Check if user is allowed to view discussions.
        if (has_capability('mod/forum:viewdiscussion', $context)) {
            $branchlabel = '<em><span class="fa fa-list-alt"></span>' . get_string('forumposts', 'mod_forum') . '</em>';
            $branchurl = new moodle_url('/mod/forum/user.php', array('id' => $USER->id));
            $usermenu .= html_writer::tag('li', html_writer::link($branchurl, $branchlabel));

            $branchlabel = '<em><span class="fa fa-list"></span>' . get_string('discussions', 'mod_forum') . '</em>';
            $branchurl = new moodle_url('/mod/forum/user.php', array('id' => $USER->id, 'mode' => 'discussions'));
            $usermenu .= html_writer::tag('li', html_writer::link($branchurl, $branchlabel));

            $usermenu .= html_writer::empty_tag('hr', array('class' => 'sep'));
        }

        // Output user grade links course sensitive, workaround for frontpage, selecting first enrolled course.
        if ($course->id == 1) {
            $hascourses = enrol_get_my_courses(NULL, 'visible DESC,id ASC', 1);
            foreach ($hascourses as $hascourse) {
                $reportcontext = context_course::instance($hascourse->id);
                if (has_capability('gradereport/user:view', $reportcontext) && $hascourse->visible) {
                    $branchlabel = '<em><span class="fa fa-list-alt"></span>' . get_string('mygrades', 'theme_campus') . '</em>';
                    $branchurl = new moodle_url('/grade/report/overview/index.php',
                            array('id' => $hascourse->id, 'userid' => $USER->id));
                    $usermenu .= html_writer::tag('li', html_writer::link($branchurl, $branchlabel));
                }
            }
        } else if (has_capability('gradereport/user:view', $context)) {
            $branchlabel = '<em><span class="fa fa-list-alt"></span>' . get_string('mygrades', 'theme_campus') . '</em>';
            $branchurl = new moodle_url('/grade/report/overview/index.php',
                    array('id' => $course->id, 'userid' => $USER->id));
            $usermenu .= html_writer::tag('li', html_writer::link($branchurl, $branchlabel));

            // In Course also output Course grade links.
            $branchlabel = '<em><span class="fa fa-list-alt"></span>' . get_string('coursegrades', 'theme_campus') . '</em>';
            $branchurl = new moodle_url('/grade/report/user/index.php',
                    array('id' => $course->id, 'userid' => $USER->id));
            $usermenu .= html_writer::tag('li', html_writer::link($branchurl, $branchlabel));
        }

        // Check if badges are enabled.
        if (!empty($CFG->enablebadges) && has_capability('moodle/badges:manageownbadges', $context)) {
            $branchlabel = '<em><span class="fa fa-certificate"></span>' . get_string('badges') . '</em>';
            $branchurl = new moodle_url('/badges/mybadges.php');
            $usermenu .= html_writer::tag('li', html_writer::link($branchurl, $branchlabel));
        }

        $usermenu .= html_writer::end_tag('ul');

        $usermenu .= html_writer::end_tag('li');
        $usermenu .= html_writer::end_tag('ul');

        return $usermenu;
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
                                    array('href' => $url, 'class' => 'btn')) . ')';
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
                    if ($count = user_count_login_failures($USER)) {
                        $loggedinas .= '<div class="loginfailures">';
                        $a = new stdClass();
                        $a->attempts = $count;
                        $loggedinas .= get_string('failedloginattempts', '', $a);
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

    /*
    * This code replaces icons in with
    * FontAwesome variants when needed.
    */
    public function render_pix_icon(pix_icon $icon) {
        static $icons = array(
            'i/notifications' => 'bell-o',
            't/message' => 'comment-o'
        );
        if (array_key_exists($icon->pix, $icons)) {
            $pix = $icons[$icon->pix];
            /* Note: MUST have the 'i' tag instead of 'span' if use an icon in the editing action menu otherwise will break! */
            if (empty($icon->attributes['alt'])) {
                return '<span class="fa fa-'.$pix.' icon" aria-hidden="true">'.parent::render_pix_icon($icon).'</span>';
            } else {
                $alt = $icon->attributes['alt'];
                return '<span class="fa fa-'.$pix.' icon" title="'.$alt.'" aria-hidden="true">'.parent::render_pix_icon($icon).'</span>';
            }
        } else {
            return parent::render_pix_icon($icon);
        }
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
            $autoplay = (!empty($this->page->theme->settings->carouselautoplay)) ? $this->page->theme->settings->carouselautoplay : 2;  // Default of 'Yes'.
            if ($autoplay == 2) {
                $slideinterval = (!empty($this->page->theme->settings->slideinterval)) ? $this->page->theme->settings->slideinterval : 5000;
            } else {
                $slideinterval = 0;
            }
            $data = array('data' => array('slideinterval' => $slideinterval));
            $this->page->requires->js_call_amd('theme_campus/carousel', 'init', $data); // Carousel can only exist on front page or top level category pages.
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
                        $autoplay = (!empty($this->page->theme->settings->carouselautoplay)) ? $this->page->theme->settings->carouselautoplay : 2;  // Default of 'Yes'.
                        if ($autoplay == 2) {
                            $slideinterval = (!empty($this->page->theme->settings->slideinterval)) ? $this->page->theme->settings->slideinterval : 5000;
                        } else {
                            $slideinterval = 0;
                        }
                        $data = array('data' => array('slideinterval' => $slideinterval));
                        $this->page->requires->js_call_amd('theme_campus/carousel', 'init', $data); // Carousel can only exist on front page or top level category pages.
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

        if (!empty($this->page->theme->settings->showheadertoggle)) {
            if ($this->hasspecificheader) {
                $this->page->requires->js_call_amd('theme_campus/header_toggle', 'init');
            }
        }
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
        } else if (!empty($$this->page->course->category)) {
            $catid = $this->page->course->category;
            // See if the course category is a top level one.
            if (!array_key_exists($key, theme_campus_get_top_level_categories())) {
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
                global $CFG;
                include_once($CFG->libdir . '/coursecatlib.php');
                $currentcategory = $this->get_current_category();
                $category = coursecat::get($currentcategory);
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
}
