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
 * Settings block renderers
 *
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace theme_campus\output\mod_forum\email;

/**
 * Forum post renderable.
 *
 * @since      Moodle 3.0
 * @package    theme_campus
 * @copyright  2017 David Bogner <info@edulabs.org> and Gareth Barnard
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class renderer_htmlemail extends \mod_forum\output\email\renderer {
    /**
     * Display a forum post in the relevant context.
     *
     * @param \mod_forum\output\forum_post $post The post to display.
     * @return string
     */
    public function render_forum_post_email(\mod_forum\output\forum_post_email $post) {
        // Was ($this, $this->target === RENDERER_TARGET_TEXTEMAIL) and as we are already 'htmlemail' it will always be false.
        $data = $post->export_for_template($this, false);
        // Add our new data.
        $data['enabletemplate'] = \theme_campus\toolbox::get_setting('forumcustomtemplate');
        $forumhtmlemailheader = \theme_campus\toolbox::get_setting('forumhtmlemailheader', 'format_html');
        if ($forumhtmlemailheader) {
            $data['messageheader'] = $forumhtmlemailheader;
        }
        $forumhtmlemailfooter = \theme_campus\toolbox::get_setting('forumhtmlemailfooter', 'format_html');
        if ($forumhtmlemailfooter) {
            $data['messagefooter'] = $forumhtmlemailfooter;
        }

        return $this->render_from_template('mod_forum/' . $this->forum_post_template(), $data);
    }
}
