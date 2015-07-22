<?php
/**
 * WGIki custom post types
 *
 * @package WGIki
 */

/* Hooks into init and adds create_custom_post_types function */
add_action('init', 'create_custom_post_types', 0);

/*
 * Create custom post types
 *
 * 1. Initialize array of division short and long names
 * 2. Initialize menu position counter
 * 3. Loop through each division in array
 *    a. Call register_custom_post_types function
 *    b. Call register_custom_taxonomies function
 *    c. Increment menu position counter
 */
function create_custom_post_types() {
  $divisions = array(
    "accounting_admin"  => "Accounting & Administration",
    "civil"             => "Civil",
    "creative"          => "Creative",
    "environmental"     => "Environmental",
    "hr"                => "Human Resources",
    "it"                => "Information Technology",
    "landscape_arch"    => "Landscape Architecture",
    "planning"          => "Planning",
    "roadway"           => "Roadway",
    "structures"        => "Structures",
    "sue"               => "SUE",
    "survey"            => "Survey",
    "trans_planning"    => "Transportation Planning",
    "utilities"         => "Utilities"
  );

  $menu_position = 30;

  foreach ($divisions as $key => $value) {
    register_custom_post_type($key, $value, $menu_position);
    register_custom_taxonomies($key);
    $menu_position++;
  }
}

/*
 * Register custom post types
 *
 * 1. Initialize array of labels for this division post type
 * 2. Initialize array of arguments for this division post type
 * 3. Register the post type using the division short name and args
 */
function register_custom_post_type($key, $value, $menu_position) {
  $cpt_labels = array(
    'name'                => _x($value, 'Post Type General Name', 'twentyfifteen'),
    'singular_name'       => _x('Resource', 'Post Type Singular Name', 'twentyfifteen'),
    'menu_name'           => __($value, 'twentyfifteen'),
    'all_items'           => __('All Resources', 'twentyfifteen'),
    'view_item'           => __('View Resource', 'twentyfifteen'),
    'add_new_item'        => __('Add New Resource', 'twentyfifteen'),
    'add_new'             => __('Add New Resource', 'twentyfifteen'),
    'edit_item'           => __('Edit Resource', 'twentyfifteen'),
    'update_item'         => __('Update Resource', 'twentyfifteen'),
    'search_items'        => __('Search ' . $value, 'twentyfifteen'),
    'not_found'           => __('Not Found', 'twentyfifteen'),
    'not_found_in_trash'  => __('Not found in Trash', 'twentyfifteen'),
  );

  $cpt_args = array(
    'labels'        => $cpt_labels,
    'supports'      => array('title', 'editor'),
    'public'        => true,
    'menu_position' => $menu_position,
    'menu_icon'     => 'dashicons-networking',
  );

  register_post_type($key, $cpt_args);
}

/*
 * Register custom taxonomies
 *
 * 1. Initialize array of labels for this division taxonomy
 * 2. Initialize array of arguments for this division taxonomy
 * 3. Register the taxnonomy using the division short name and args
 */
function register_custom_taxonomies($key) {
  $tax_labels = array(
    'name'                       => _x( 'Categories', 'taxonomy general name' ),
    'singular_name'              => _x( 'Category', 'taxonomy singular name' ),
    'search_items'               => __( 'Search Categories' ),
    'popular_items'              => __( 'Popular Categories' ),
    'all_items'                  => __( 'All Categories' ),
    'edit_item'                  => __( 'Edit Category' ),
    'update_item'                => __( 'Update Category' ),
    'add_new_item'               => __( 'Add New Category' ),
    'new_item_name'              => __( 'New Category Name' ),
    'separate_items_with_commas' => __( 'Separate categories with commas' ),
    'add_or_remove_items'        => __( 'Add or remove categories' ),
    'choose_from_most_used'      => __( 'Choose from the most used categories' ),
    'not_found'                  => __( 'No categories found.' ),
    'menu_name'                  => __( 'Categories' ),
  );

  $tax_args = array(
    'labels'                => $tax_labels,
    'show_ui'               => true,
    'show_admin_column'     => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var'             => false,
  );

  register_taxonomy($key . "_categories", $key, $tax_args);
}
