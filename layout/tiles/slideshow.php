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

// Note: Need $numberofslides and $settingprefix as preloaded variables to determine what the slideshow shows.
if (!empty($numberofslides)) {
    $captionscenter = (theme_campus_get_setting('slidecaptioncentred'))? ' centred' : '';
    ?>
    <div class="row-fluid">
        <div class="span12">
            <div id="campusCarousel" class="carousel slide">
                <ol class="carousel-indicators">
                    <?php
                    for ($indicatorslideindex = 0; $indicatorslideindex < $numberofslides; $indicatorslideindex++) {
                        echo '<li data-target="#campusCarousel" data-slide-to="'.$indicatorslideindex.'"';
                        if ($indicatorslideindex == 0) {
                            echo ' class="active"';
                        }
                        echo '></li>';
                    }
                    ?>
                </ol>
                <div class="carousel-inner<?php echo $captionscenter;?>">
                    <?php for ($slideindex = 1; $slideindex <= $numberofslides; $slideindex++) {
                        echo theme_campus_render_slide($slideindex, $settingprefix);
                    } ?>
                </div>
                <?php echo theme_campus_render_slide_controls(!$rtl); ?>
            </div>
        </div>
    </div>
<?php } ?>
