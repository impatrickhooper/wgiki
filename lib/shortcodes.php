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
//add_shortcode('grid_col', 'grid_col_shortcode');
//function grid_col_shortcode($atts, $content, $tag) {
//  $values = shortcode_atts(array('l' => '', 'm' =), $atts);
//  $output = '<div class="' . $values['classes'] . '">' . $content . '</div>';
//  return $output;
//}

/**
 * Collapsible shortcode
 *
 * 1. Begins building html for Materialize collapsible accordion
 * 2. Gets the type provided in the shortcode attributes
 * 3. Does the shortcode (if any, like a collapsible item) nested inside this one
 * 4. Returns the html
 */
add_shortcode('collapsible', 'collapsible_shortcode');
function collapsible_shortcode($atts, $content, $tag) {
  $values = shortcode_atts(array('type' => 'accordion'), $atts);

  $output = '<ul class="collapsible" data-collapsible="' . strtolower($values['type']) . '">';
  $output .= do_shortcode($content);
  $output .= '</ul>';

  return $output;
}

/**
 * Collapsible item shortcode
 *
 * 1. Get the title provided for this item in the shortcode attributes
 * 2. Begins building html for Materialize collapsible item using title and content
 * 3. Returns the html
 */
add_shortcode('collapsible_item', 'collapsible_item_shortcode');
function collapsible_item_shortcode($atts, $content, $tag) {
  $values = shortcode_atts(array('title' => ''), $atts);

  $output = '<li>';
  $output .= '<div class="collapsible-header"><i class="mdi-hardware-keyboard-arrow-right"></i>' . $values['title'] . '</div>';
  $output .= '<div class="collapsible-body">' . $content . '</div>';
  $output .= '</li>';

  return $output;
}

/**
 * Tabs shortcode
 *
 * 1. Begins building html for Materialize tabs
 * 2. Does the shortcode (if any, like a tab item) nested inside this one
 * 3. Returns the html
 */
add_shortcode('tabs', 'tabs_shortcode');
function tabs_shortcode($atts, $content, $tag) {
  $tabs_html = '<div class="tabs_container">';
  $tabs_html .= do_shortcode($content);
  $tabs_html .= '</div>';

  return $tabs_html;
}

/**
 * Tabs Navigation shortcode
 *
 * 1. Begins building html for Materialize tabs navigation
 * 2. Does the shortcode (if any, like a tab item) nested inside this one
 * 3. Returns the html
 */
add_shortcode('tabs_nav', 'tabs_nav_shortcode');
function tabs_nav_shortcode($atts, $content, $tag) {
  $tabs_nav_html = '<ul class="tabs z-depth-1">';
  $tabs_nav_html .= do_shortcode($content);
  $tabs_nav_html .= '</ul>';

  return $tabs_nav_html;
}

/**
 * Tabs Navigation Item shortcode
 *
 * 1. Get the id and width for this shortcode
 * 2. Begins building html for Materialize tabs navigation item
 * 3. Returns the html
 */
add_shortcode('tabs_nav_item', 'tabs_nav_item_shortcode');
function tabs_nav_item_shortcode($atts, $content, $tag) {
  $values = shortcode_atts(array('id' => '', 'width' => '100'), $atts);

  return '<li class="tab" style="width: ' . $values['width'] . '%"><a href="#' . $values['id'] . '">' . $content . '</a></li>';
}

/**
 * Tabs Item shortcode
 *
 * 1. Get the id for this shortcode
 * 2. Begins building html for Materialize tab item
 * 3. Returns the html
 */
add_shortcode('tabs_item', 'tabs_item_shortcode');
function tabs_item_shortcode($atts, $content, $tag) {
  $values = shortcode_atts(array('id' => ''), $atts);

  return '<div class="tab_content" id="' . $values['id'] . '">' . $content . '</div>';
}
