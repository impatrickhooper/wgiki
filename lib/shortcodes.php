<?php
/**
 * WGIki shortcodes
 *
 * @package WGIki
 */

/**
 * Grid system shortcode
 *
 * 1. Gets value of "classes" attribute used in shortcode
 * 2. Replaces the shortcode with a div with the classes provided
 * 3. Returns the html
 */
add_shortcode('grid', 'grid_shortcode');
function grid_shortcode($atts, $content, $tag) {
  $values = shortcode_atts(array('classes' => ''), $atts);
  $output = '<div class="' . $values['classes'] . '">' . $content . '</div>';
  return $output;
}
