<?php
/**
 * WGIki custom post types
 *
 * @package WGIki
 */

/*
 * Resources post type
 *
 * Supports a title and the editor by default
 * Is not public (so no link to page created)
 */
add_action('init', 'resources_post_type', 0);
function resources_post_type() {
  $labels = array(
    'name'                => __('Resources', 'Post Type General Name', 'twentyfifteen'),
    'singular_name'       => __('Division', 'Post Type Singular Name', 'twentyfifteen'),
    'menu_name'           => __('Resources', 'twentyfifteen'),
    'parent_item_colon'   => __('Parent Division', 'twentyfifteen'),
    'all_items'           => __('All Resources', 'twentyfifteen'),
    'view_item'           => __('View Division', 'twentyfifteen'),
    'add_new_item'        => __('Add New Division', 'twentyfifteen'),
    'add_new'             => __('Add New Division', 'twentyfifteen'),
    'edit_item'           => __('Edit Division', 'twentyfifteen'),
    'update_item'         => __('Update Division', 'twentyfifteen'),
    'search_items'        => __('Search Resources', 'twentyfifteen'),
    'not_found'           => __('Not Found', 'twentyfifteen'),
    'not_found_in_trash'  => __('Not found in Trash', 'twentyfifteen'),
  );

  $args = array(
    'labels'              => $labels,
    'supports'            => array('title', 'editor'),
    'public'              => false,
    'show_ui'             => true,
    'menu_position'       => 35,
    'menu_icon'           => 'dashicons-info',
  );

  register_post_type('resources', $args);
}
