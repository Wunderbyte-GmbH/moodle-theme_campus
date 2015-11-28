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
 * @copyright  &copy; 2015-onwards G J Barnard.
 * @copyright  &copy; 2015-onwards Work undertaken for David Bogner of Edulabs.org.
 * @author     G J Barnard - gjbarnard at gmail dot com and {@link http://moodle.org/user/profile.php?id=442195}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$numberofsociallinks = (empty($PAGE->theme->settings->numberofsociallinks)) ? false : $PAGE->theme->settings->numberofsociallinks;
$haveicons = false; // Define here for footer.php scope.

// If there are social links then they are displayed.
if ($numberofsociallinks) {
    $choices = array(
        'dropbox' => 'Dropbox', 'facebook-square' => 'Facebook', 'flickr' => 'Flickr', 'github' => 'Github',
        'google-plus-square' => 'Google Plus', 'instagram' => 'Instagram', 'linkedin-square' => 'Linkedin',
        'pinterest-square' => 'Pinterest', 'skype' => 'Skype', 'tumblr-square' => 'Tumblr', 'twitter-square' => 'Twitter',
        'users' => 'Unlisted', 'vimeo-square' => 'Vimeo', 'vk' => 'Vk', 'globe' => 'Website', 'youtube-square' => 'YouTube'
    );
    for ($i = 1; $i <= $numberofsociallinks; $i++) {
        $name = 'social'.$i;
        if (!empty($PAGE->theme->settings->$name)) {
            if (!$haveicons) {
                $haveicons = true;
                $icons = '<div class="row-fluid">';
                $icons .= '<div class="span12 socialnetworkscontainer">';
                $icons .= '<ul class="socialnetworks">';
            }
            $iconname = 'socialicon'.$i;
            $icons .= '<li><a href="'.$PAGE->theme->settings->$name.'" target="_blank">';
            $icons .= '<span class="sr-only">'.$choices[$PAGE->theme->settings->$iconname].'</span>';
            $icons .= '<span class="fa fa-2x fa-'.$PAGE->theme->settings->$iconname.'"></span>';  // Use of 'fa-' class here for custom Campus colours in campuscustom.less.
            $icons .= '</a></li>';
        }
    }
    if ($haveicons) {
        $icons .= '</ul>';
        $icons .= '</div></div>';
    }
}
