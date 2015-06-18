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
        $divider = html_writer::tag('span', html_writer::start_tag('i', array('class' => 'fa '. $dividericon .' fa-lg')) .
                        html_writer::end_tag('i'), array('class' => 'divider'));
        $breadcrumbs = array();
        foreach ($items as $item) {
            $item->hideicon = true;
            $breadcrumbs[] = $this->render($item);
        }
        $list_items = html_writer::start_tag('li') . implode("$divider" . html_writer::end_tag('li') .
                        html_writer::start_tag('li'), $breadcrumbs) . html_writer::end_tag('li');
        $title = html_writer::tag('span', get_string('pagepath'), array('class' => 'accesshide'));
        return $title . html_writer::tag('ul', "$list_items", array('class' => 'breadcrumb'));
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
        return html_writer::tag('a', html_writer::start_tag('i', array('class' => $icon . ' icon-white')) .
                        html_writer::end_tag('i'), array('href' => $url, 'class' => 'btn ' . $btn, 'title' => $title));
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
                    $attributes['class'] .= ' '.$region.'-edit';
                }
                $output = html_writer::tag($tag, $this->campus_blocks_for_region($displayregion, $blocksperrow, $editing), $attributes);
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
                    $output .= $this->block_move_target($bc, $zones, $lastblock);
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
        $this->render_gotobottom_menu($menu);

        $content = html_writer::start_tag('ul', array('class' => 'nav cpusermenu'));
        foreach ($menu->get_children() as $item) {
            $content .= $this->render_custom_menu_item($item, 1);
        }
        $content .= html_writer::end_tag('ul');

        return $content;
    }

    protected function render_gotobottom_menu(custom_menu $menu) {
        if (($this->page->pagelayout == 'course') || ($this->page->pagelayout == 'incourse') || ($this->page->pagelayout == 'admin')) { // Go to bottom.
            $gotobottom = html_writer::tag('i', '', array('class' => 'fa fa-arrow-circle-o-down slgotobottom'));
            $menu->add($gotobottom, new moodle_url('#page-footer'), get_string('gotobottom', 'theme_campus'), 10001);
        }
    }

    public function anti_gravity() {
        $icon = html_writer::start_tag('i', array('class' => 'fa fa-arrow-circle-o-up')) . html_writer::end_tag('i');
        $anti_gravity = html_writer::tag('a', $icon, array('class' => 'antiGravity', 'title' => get_string('antigravity', 'theme_campus')));

        return $anti_gravity;
    }

    public function header_toggle_menu() {
        if (!empty($this->page->theme->settings->showheadertoggle)) {
            if ($this->hasspecificheader) {
                $usermenu = new custom_menu('', current_language());
                return $this->render_header_toggle_menu($usermenu);
            }
        }
        return '';
    }

    protected function render_header_toggle_menu(custom_menu $menu) {
        $headertoggle = html_writer::tag('i', '', array('class' => 'headertoggle fa fa-expand'));
        $menu->add($headertoggle, new moodle_url('#'), get_string('headertoggle', 'theme_campus'), 10001);

        $content = html_writer::start_tag('ul', array('class' => 'nav headertogglemenu'));
        foreach ($menu->get_children() as $item) {
            $content .= $this->render_custom_menu_item($item, 1);
        }
        $content .= html_writer::end_tag('ul');

        return $content;
    }

    /**
     * Outputs the user menu.
     * @return custom_menu object
     */
    public function custom_menu_user()
    {
        // Die if executed during install.
        if (during_initial_install()) {
            return false;
        }

        if ((!isloggedin()) || (isguestuser())) {
            return $this->login_info();
        }

        global $USER, $CFG, $DB, $SESSION;
        $loginurl = get_login_url();

        $usermenu = html_writer::start_tag('ul', array('class' => 'nav'));
        $usermenu .= html_writer::start_tag('li', array('class' => 'dropdown'));

        $course = $this->page->course;
        $context = context_course::instance($course->id);

        // Output Profile link
        $userurl = new moodle_url('#');
        $userpic = parent::user_picture($USER, array('link' => false));
        $caret = '<i class="fa fa-caret-right"></i>';
        $userclass = array('class' => 'dropdown-toggle', 'data-toggle' => 'dropdown');

        $usermenu .= html_writer::link($userurl, $userpic . $USER->firstname . $caret, $userclass);

        // Start dropdown menu items
        $usermenu .= html_writer::start_tag('ul', array('class' => 'dropdown-menu pull-right'));
        $usermenu .= html_writer::tag('li', $this->login_info());

        // Add preferences submenu
        $usermenu .= $this->theme_campus_render_preferences($context);

        $usermenu .= html_writer::empty_tag('hr', array('class' => 'sep'));

        // Output Calendar link if user is allowed to edit own calendar entries
        if (has_capability('moodle/calendar:manageownentries', $context)) {
            $branchlabel = '<em><i class="fa fa-calendar"></i>' . get_string('pluginname', 'block_calendar_month') . '</em>';
            $branchurl = new moodle_url('/calendar/view.php');
            $usermenu .= html_writer::tag('li', html_writer::link($branchurl, $branchlabel));
        }

        // Check if messaging is enabled.
        if (!empty($CFG->messaging)) {
            $branchlabel = '<em><i class="fa fa-envelope"></i>' . get_string('pluginname', 'block_messages') . '</em>';
            $branchurl = new moodle_url('/message/index.php');
            $usermenu .= html_writer::tag('li', html_writer::link($branchurl, $branchlabel));
        }

        // Check if user is allowed to manage files
        if (has_capability('moodle/user:manageownfiles', $context)) {
            $branchlabel = '<em><i class="fa fa-file"></i>' . get_string('privatefiles', 'block_private_files') . '</em>';
            $branchurl = new moodle_url('/user/files.php');
            $usermenu .= html_writer::tag('li', html_writer::link($branchurl, $branchlabel));
        }

        // Check if user is allowed to view discussions
        if (has_capability('mod/forum:viewdiscussion', $context)) {
            $branchlabel = '<em><i class="fa fa-list-alt"></i>' . get_string('forumposts', 'mod_forum') . '</em>';
            $branchurl = new moodle_url('/mod/forum/user.php', array('id' => $USER->id));
            $usermenu .= html_writer::tag('li', html_writer::link($branchurl, $branchlabel));

            $branchlabel = '<em><i class="fa fa-list"></i>' . get_string('discussions', 'mod_forum') . '</em>';
            $branchurl = new moodle_url('/mod/forum/user.php', array('id' => $USER->id, 'mode' => 'discussions'));
            $usermenu .= html_writer::tag('li', html_writer::link($branchurl, $branchlabel));

            $usermenu .= html_writer::empty_tag('hr', array('class' => 'sep'));
        }

        // Output user grade links course sensitive, workaround for frontpage, selecting first enrolled course
        if ($course->id == 1) {
            $hascourses = enrol_get_my_courses(NULL, 'visible DESC,id ASC', 1);
            foreach ($hascourses as $hascourse) {
                $reportcontext = context_course::instance($hascourse->id);
                if (has_capability('gradereport/user:view', $reportcontext) && $hascourse->visible) {
                    $branchlabel = '<em><i class="fa fa-list-alt"></i>' . get_string('mygrades', 'theme_campus') . '</em>';
                    $branchurl = new moodle_url('/grade/report/overview/index.php' , array('id' => $hascourse->id, 'userid' => $USER->id));
                    $usermenu .= html_writer::tag('li', html_writer::link($branchurl, $branchlabel));
                }
            }
        } else if (has_capability('gradereport/user:view', $context)) {
            $branchlabel = '<em><i class="fa fa-list-alt"></i>' . get_string('mygrades', 'theme_campus') . '</em>';
            $branchurl = new moodle_url('/grade/report/overview/index.php' , array('id' => $course->id, 'userid' => $USER->id));
            $usermenu .= html_writer::tag('li', html_writer::link($branchurl, $branchlabel));

            // In Course also output Course grade links
            $branchlabel = '<em><i class="fa fa-list-alt"></i>' . get_string('coursegrades', 'theme_campus') . '</em>';
            $branchurl = new moodle_url('/grade/report/user/index.php' , array('id' => $course->id, 'userid' => $USER->id));
            $usermenu .= html_writer::tag('li', html_writer::link($branchurl, $branchlabel));
        }

        // Check if badges are enabled.
        if (!empty($CFG->enablebadges) && has_capability('moodle/badges:manageownbadges', $context)) {
            $branchlabel = '<em><i class="fa fa-certificate"></i>' . get_string('badges') . '</em>';
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
        $loginpage = ((string)$this->page->url === $loginurl);
        $course = $this->page->course;
        if (\core\session\manager::is_loggedinas()) {
            $realuser = \core\session\manager::get_realuser();
            $fullname = fullname($realuser, true);
            if ($withlinks) {
                $loginastitle = get_string('loginas');
                $realuserinfo = " [<a href=\"$CFG->wwwroot/course/loginas.php?id=$course->id&amp;sesskey=".sesskey()."\"";
                $realuserinfo .= "title =\"".$loginastitle."\">$fullname</a>] ";
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
            if (is_mnet_remote_user($USER) and $idprovider = $DB->get_record('mnet_host', array('id'=>$USER->mnethostid))) {
                if ($withlinks) {
                    $username .= " from <a href=\"{$idprovider->wwwroot}\">{$idprovider->name}</a>";
                } else {
                    $username .= " from {$idprovider->name}";
                }
            }
            if (isguestuser()) {
                if (!$loginpage && $withlinks) {
                    $loggedinas = " <a class=\"standardbutton plainlogin btn\" href=\"$loginurl\">".get_string('login').'</a>';
                }
            } else if (is_role_switched($course->id)) { // Has switched roles
                $rolename = '';
                if ($role = $DB->get_record('role', array('id'=>$USER->access['rsw'][$context->path]))) {
                    $rolename = ': '.role_get_name($role, $context);
                }
                $loggedinas = '<span class="loggedintext">'. get_string('loggedinas', 'moodle', $username).$rolename.'</span>';
                if ($withlinks) {
                    $url = new moodle_url('/course/switchrole.php', array('id'=>$course->id,'sesskey'=>sesskey(), 'switchrole'=>0, 'returnurl'=>$this->page->url->out_as_local_url(false)));
                    $loggedinas .= '('.html_writer::tag('a', get_string('switchrolereturn'), array('href'=>$url, 'class' => 'btn')).')';
                }
            } else {
                $loggedinas = '<span class="loggedintext">'. $realuserinfo.get_string('loggedinas', 'moodle', $username).'</span>';
                if ($withlinks) {
                    $loggedinas .= html_writer::tag('div', html_writer::link(new moodle_url('/login/logout.php?sesskey=' . sesskey()), '<em><i class="fa fa-sign-out"></i>' . get_string('logout') . '</em>'));
                }
            }
        } else {
            if (!$loginpage && $withlinks) {
                $loggedinas = "<a class=\"standardbutton plainlogin btn\" href=\"$loginurl\">".get_string('login').'</a>';
            }
        }

        if (!empty($loggedinas)) {
            $loggedinas = '<div class="logininfo">'.$loggedinas.'</div>';
        } else {
            $loggedinas = '';
        }

        if (isset($SESSION->justloggedin)) {
            unset($SESSION->justloggedin);
            if (!empty($CFG->displayloginfailures)) {
                if (!isguestuser()) {
                    if ($count = count_login_failures($CFG->displayloginfailures, $USER->username, $USER->lastlogin)) {
                        $loggedinas .= '&nbsp;<div class="loginfailures">';
                        if (empty($count->accounts)) {
                            $loggedinas .= get_string('failedloginattempts', '', $count);
                        } else {
                            $loggedinas .= get_string('failedloginattemptsall', '', $count);
                        }
                        if (file_exists("$CFG->dirroot/report/log/index.php") and has_capability('report/log:view', context_system::instance())) {
                            $loggedinas .= ' (<a href="'.$CFG->wwwroot.'/report/log/index.php'.
                                                 '?chooselog=1&amp;id=1&amp;modid=site_errors">'.get_string('logs').'</a>)';
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
        if ($this->page->url->out() === $CFG->wwwroot."/login/index.php"){
            $urltogo = $SESSION->wantsurl;
        } else {
            $urltogo = $this->page->url->out();
        }
        $authplugin = get_auth_plugin('mnet');
        $authurl = $authplugin->loginpage_idp_list($urltogo);

        // Check the id of the MNET host for the idp
        $host = $DB->get_field('mnet_host', 'name', array('id' => $this->page->theme->settings->alternateloginurl));
        if(!empty($authurl)){
            foreach($authurl as $key => $urlarray){
                if($urlarray['name'] == $host){
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
     * Renders preferences submenu
     *
     * @param integer $context
     * @return string $preferences
     */
    private function theme_campus_render_preferences($context)
    {
        global $USER, $CFG;
        $label = '<em><i class="fa fa-cog"></i>' . get_string('preferences') . '</em>';
        $preferences = html_writer::start_tag('li', array('class' => 'dropdown-submenu preferences'));
        $preferences .= html_writer::link(new moodle_url('#'), $label, array('class' => 'dropdown-toggle', 'data-toggle' => 'dropdown'));
        $preferences .= html_writer::start_tag('ul', array('class' => 'dropdown-menu'));
        // Check if user is allowed to edit profile
        if (has_capability('moodle/user:editownprofile', $context)) {
            $branchlabel = '<em><i class="fa fa-user"></i>' . get_string('editmyprofile') . '</em>';
            $branchurl = new moodle_url('/user/edit.php', array('id' => $USER->id));
            $preferences .= html_writer::tag('li', html_writer::link($branchurl, $branchlabel));
        }
        if (has_capability('moodle/user:changeownpassword', $context)) {
            $branchlabel = '<em><i class="fa fa-key"></i>' . get_string('changepassword') . '</em>';
            $branchurl = new moodle_url('/login/change_password.php');
            $preferences .= html_writer::tag('li', html_writer::link($branchurl, $branchlabel));
        }
        if (has_capability('moodle/user:editownmessageprofile', $context)) {
            $branchlabel = '<em><i class="fa fa-comments"></i>' . get_string('messagepreferences', 'theme_campus') . '</em>';
            $branchurl = new moodle_url('/message/edit.php', array('id' => $USER->id));
            $preferences .= html_writer::tag('li', html_writer::link($branchurl, $branchlabel));
        }
        if ($CFG->enableblogs) {
            $branchlabel = '<em><i class="fa fa-rss-square"></i>' . get_string('blogpreferences', 'theme_campus') . '</em>';
            $branchurl = new moodle_url('/blog/preferences.php');
            $preferences .= html_writer::tag('li', html_writer::link($branchurl, $branchlabel));
        }
        if ($CFG->enablebadges && has_capability('moodle/badges:manageownbadges', $context)) {
            $branchlabel = '<em><i class="fa fa-certificate"></i>' . get_string('badgepreferences', 'theme_campus') . '</em>';
            $branchurl = new moodle_url('/badges/preferences.php');
            $preferences .= html_writer::tag('li', html_writer::link($branchurl, $branchlabel));
        }
        $preferences .= html_writer::end_tag('ul');
        $preferences .= html_writer::end_tag('li');
        return $preferences;
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
                $additionalclasses[] = 'hidelocallogin';
            }
        }
        return parent::body_attributes($additionalclasses);
    }

    /**
     * Returns the header file name in the 'tiles' folder to use for the current page.
     * If logic in optional_jquery() changes, then change this too.
     */
    public function get_header_file() {
        $thefile = 'header'; // Default if not a specific header.
        if (get_config('theme_campus', 'usefrontpageheader')) {  // If set then use the front page header on all unless specific header set.
            $thefile = 'frontpage-header';
        }

        $pagelayout = $this->page->pagelayout;
        if (($this->page->course->format == 'site') && ($pagelayout == 'incourse')) {
            $pagelayout = 'frontpage'; // All site modules need to use the front page header as they have no top level category.
        }

        switch($pagelayout) {
            case 'frontpage':
                $thefile = 'frontpage-header';
            break;
            case 'coursecategory':
                if ($this->is_top_level_category()) {  // Set specific header.
                    $thefile = 'coursecategory-header';
                }
            break;
            case 'course':
            case 'incourse':
                $thefile = 'coursecategory-header';
            break;
        }

        return $thefile.'.php';
    }

    /**
     * Works out and adds optional jQuery on the page if needed by criteria.
     * If logic in get_header_file() changes, then change this too.
     * MUST be called before any page output happens.
     */
    public function optional_jquery() {
        $stickynavbar = false;

        $pagelayout = $this->page->pagelayout;
        if (($this->page->course->format == 'site') && ($pagelayout == 'incourse')) {
            $pagelayout = 'frontpage'; // All site modules need to use the front page header as they have no top level category.
        }

        switch($pagelayout) {
            case 'frontpage':
                $this->page->requires->jquery_plugin('carousel', 'theme_campus'); // Carousel can only exist on front page or top level category pages.
                // We are the front page setting enforce the intent.
                if (!empty($this->page->theme->settings->frontpagestickynavbar)) {
                    $stickynavbar = true;
                }
                $this->hasspecificheader = true;
            break;
            default:
                if (!empty($this->page->theme->settings->usefrontpageheader)) { // If set then the front page header settings apply on all unless specific header set.
                    if (!empty($this->page->theme->settings->frontpagestickynavbar)) {
                        $stickynavbar = true;
                    }
                    $this->hasspecificheader = true;
                } else {
                    if (!empty($this->page->theme->settings->stickynavbar)) {
                        $stickynavbar = true;
                    }
                }
            break;
        }

        switch($pagelayout) {
            case 'coursecategory':
                $currentcategory = $this->get_current_category();
                if ($this->is_top_level_category($currentcategory)) {
                    $this->page->requires->jquery_plugin('carousel', 'theme_campus'); // Carousel can only exist on front page or top level category pages.
                    $this->hasspecificheader = true;
                    $cchavecustomsetting = 'coursecategoryhavecustomheader'.$currentcategory;
                    if (!empty($this->page->theme->settings->$cchavecustomsetting)) {
                        // We have a custom setting so enforce the intent.
                        $cchavestickysetting = 'coursecategorystickynavbar'.$currentcategory;
                        if (!empty($this->page->theme->settings->$cchavestickysetting)) {
                            $stickynavbar = true;
                        } else {
                            $stickynavbar = false;
                        }
                    }
                }
            break;
            case 'course':
            case 'incourse':
                // From our point of view, the same as is_course_page().
                $this->hasspecificheader = true;
                $currentcategory = $this->get_current_top_level_catetgory();
                $cchavecustomsetting = 'coursecategoryhavecustomheader'.$currentcategory;
                if (!empty($this->page->theme->settings->$cchavecustomsetting)) {
                    // We have a custom setting so enforce the intent.
                    $cchavestickysetting = 'coursecategorystickynavbar'.$currentcategory;
                    if (!empty($this->page->theme->settings->$cchavestickysetting)) {
                        $stickynavbar = true;
                    } else {
                        $stickynavbar = false;
                    }
                }
            break;
        }
        if ($stickynavbar) {
            $this->page->requires->jquery_plugin('affix', 'theme_campus');
        }

        if (!empty($this->page->theme->settings->showheadertoggle)) {
            if ($this->hasspecificheader) {
                $this->page->requires->jquery_plugin('headertoggle', 'theme_campus');
            }
        }
    }

    /**
     * States if we are in a course or module of a course.
     */
    public function is_course_page() {
        switch($this->page->pagelayout) {
            case 'course':
            case 'incourse':
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
     * Gets HTML for the page heading.
     *
     * @since Moodle 2.5.1 2.6
     * @param string $tag The tag to encase the heading in. h1 by default.
     * @return string HTML.
     */
    public function page_heading($tag = 'h1') {
        if ($this->page->pagelayout == 'frontpage') {
            return '';
        }
        global $CFG;
        return '<a class="brand" href="'.$CFG->wwwroot.'">'.$this->page->heading.'</a>';
    }
}
