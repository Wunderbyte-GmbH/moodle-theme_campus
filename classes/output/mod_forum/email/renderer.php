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

defined('MOODLE_INTERNAL') || die();

//require_once($CFG->dirroot . "/mod/forum/classes/output/email/renderer.php");

/**
 * Forum post renderable.
 *
 * @since      Moodle 3.0
 * @package    theme_campus
 * @copyright  2017 David Bogner <info@edulabs.org>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class renderer extends \mod_forum\output\email\renderer {

    /**
     * Constructor method, calls the parent constructor
     *
     * @param moodle_page $page
     * @param string $target one of rendering target constants
     */
    public function __construct(\moodle_page $page, $target) {
        parent::__construct($page, $target);
        error_log('theme_campus email renderer constructor');
    }

    /**
     * Display a forum post in the relevant context.
     *
     * @param \mod_forum\output\forum_post $post The post to display.
     * @return string
     */
    public function render_forum_post_email(\mod_forum\output\forum_post_email $post) {
        $data = $post->export_for_template($this, $this->target === RENDERER_TARGET_TEXTEMAIL);
		$data['campus_row'] = '<tr><td>Campus theme</td></tr>';
		error_log('theme_campus render_forum_post_email target: '.print_r($this->target, true).' '.get_class($this));
		mtrace('theme_campus render_forum_post_email target: '.print_r($this->target, true).' '.get_class($this));
		error_log('theme_campus render_forum_post_email data: '.print_r($data, true));
        $templated = $this->render_from_template('mod_forum/' . $this->forum_post_template(), $data);
        //$templated = $this->render_from_template('theme_campus/forum_post_email_htmlemail_body_campus', $data);
		error_log('theme_campus render_forum_post_email templated: '.print_r($templated, true));
		mtrace(print_r($templated, true));
        return $templated;
    }

    /**
     * The HTML version of the e-mail message.
     *
     * @param \stdClass $cm
     * @param \stdClass $post
     * @return string
     */
	 /*
    public function format_message_text($cm, $post) {
        $message = file_rewrite_pluginfile_urls($post->message, 'pluginfile.php',
                \context_module::instance($cm->id)->id,
                'mod_forum', 'post', $post->id);
                $options = new \stdClass();
                $options->para = true;
                $message = "blablabla";
                mtrace('halllllloooooooooooooooooooooooooooo');
                return format_text($message, $post->messageformat, $options);
    }*/
}
