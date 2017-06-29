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

namespace theme_campus\output\email;

defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot . "/mod/forum/classes/output/email/renderer.php");


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
     * The HTML version of the e-mail message.
     *
     * @param \stdClass $cm
     * @param \stdClass $post
     * @return string
     */
    public function format_message_text($cm, $post) {
        $message = file_rewrite_pluginfile_urls($post->message, 'pluginfile.php',
                \context_module::instance($cm->id)->id,
                'mod_forum', 'post', $post->id);
                $options = new \stdClass();
                $options->para = true;
                $message = "blablabla";
                mtrace('halllllloooooooooooooooooooooooooooo');
                return format_text($message, $post->messageformat, $options);
    }
}
