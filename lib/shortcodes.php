<?php
/**
 * WGIki shortcodes
 *
 * @package WGIki
 */

/**
 * Grid shortcode
 *
 * 1. Generates html for a grid container div
 * 2. Runs shortcodes (if any) in the content
 * 3. Returns the html
 */
add_shortcode('grid', 'grid_shortcode');
function grid_shortcode($atts, $content, $tag) {
  $grid_html = '<div class="grid_builder grid-container">';
  $grid_html .= do_shortcode($content);
  $grid_html .= "</div>";

  return $grid_html;
}


/**
 * Grid column shortcode
 *
 * 1. Gets value of "l" (large), "m" (medium), "s" (small) shortcode attributes
 * 2. Generate html for a div with the appropriate screen size classes and widths
 * 3. Returns the html width content included
 */
add_shortcode('grid_col', 'grid_col_shortcode');
function grid_col_shortcode($atts, $content, $tag) {
  $values = shortcode_atts(array('l' => '100', 'm' => '100', 's' => '100', 'gutter' => '0'), $atts);

  return '<div class="grid_col grid-' . $values['l'] . ' tablet-grid-' . $values['m'] . ' mobile-grid-' . $values['s'] . '" style="padding: ' . $values['gutter'] . 'px;">' . $content . '</div>';
}

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

  $collapsible_html = '<ul class="collapsible" data-collapsible="' . strtolower($values['type']) . '">';
  $collapsible_html .= do_shortcode($content);
  $collapsible_html .= '</ul>';

  return $collapsible_html;
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

  $collapsible_item_html = '<li>';
  $collapsible_item_html .= '<div class="collapsible-header"><i class="mdi-hardware-keyboard-arrow-right"></i>' . $values['title'] . '</div>';
  $collapsible_item_html .= '<div class="collapsible-body">' . $content . '</div>';
  $collapsible_item_html .= '</li>';

  return $collapsible_item_html;
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
 * 1. Get the id for this shortcode
 * 2. Begins building html for Materialize tabs navigation item
 * 3. Returns the html
 */
add_shortcode('tabs_nav_item', 'tabs_nav_item_shortcode');
function tabs_nav_item_shortcode($atts, $content, $tag) {
  $values = shortcode_atts(array('id' => ''), $atts);

  return '<li class="tab"><a href="#' . $values['id'] . '">' . $content . '</a></li>';
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
