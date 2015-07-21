<?php
/**
 * Load assets for WGIki theme.
 *
 * @package WGIki
 */

/* Load theme assets (scripts and stylesheets) */
add_action('wp_enqueue_scripts', 'wgiki_scripts');
function wgiki_scripts() {

  /* Load the stylesheet: handle name, stylesheet path, dependencies, version, media types */
  wp_enqueue_style('wgiki-style', get_stylesheet_uri(), array(), '0.0.1', 'all');

  /* Load the script (app.js): handle name, script path, dependencies, version, load in footer */
  wp_enqueue_script('wgiki-script', get_stylesheet_directory_uri() . '/app.js', array('jquery'), '0.0.1', true);
}
