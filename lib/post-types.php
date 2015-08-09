<?php
/**
 * WGIki custom post types, taxonomies, and roles
 *
 * @package WGIki
 */

/*
 * Favorites post type
 *
 * Supports a title and page attributes (like menu order) by default
 * Is not public (so link to not page created)
 */
add_action('init', 'favorites_post_type', 0);
function favorites_post_type() {
  $labels = array(
    'name'                => __('Favorites', 'Post Type General Name', 'twentyfifteen'),
    'singular_name'       => __('Favorite', 'Post Type Singular Name', 'twentyfifteen'),
    'menu_name'           => __('Favorites', 'twentyfifteen'),
    'parent_item_colon'   => __('Parent Favorite', 'twentyfifteen'),
    'all_items'           => __('All Favorites', 'twentyfifteen'),
    'view_item'           => __('View Favorite', 'twentyfifteen'),
    'add_new_item'        => __('Add New Favorite', 'twentyfifteen'),
    'add_new'             => __('Add New Favorite', 'twentyfifteen'),
    'edit_item'           => __('Edit Favorite', 'twentyfifteen'),
    'update_item'         => __('Update Favorite', 'twentyfifteen'),
    'search_items'        => __('Search Favorites', 'twentyfifteen'),
    'not_found'           => __('Not Found', 'twentyfifteen'),
    'not_found_in_trash'  => __('Not found in Trash', 'twentyfifteen'),
  );

  $args = array(
    'labels'              => $labels,
    'supports'            => array('title', 'page-attributes'),
    'public'              => false,
    'show_ui'             => true,
    'menu_position'       => 26,
    'menu_icon'           => 'dashicons-star-filled',
    'capability_type'     => array('favorite', 'favorites'),
    'map_meta_cap'        => true,
  );

  register_post_type('favorites', $args);
}

/*
 * Create custom division post types
 */

/* Hook into init and add create_cusotm_post_types */
add_action('init', 'create_custom_post_types', 0);
function create_custom_post_types() {

  /* Initialize array of division short and long names */
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

  /* Loop through divisions as key, value */
  foreach ($divisions as $key => $value) {

    /* Register custom post types using function */
    register_custom_post_type($key, $value, 27);

    /* Register custom taxonomies using function */
    register_custom_taxonomies($key);

    /* Register custom roles using function */
    register_custom_roles($key, $value);
  }
}

/*
 * Register custom post types
 */
function register_custom_post_type($key, $value, $menu_position) {

  /* Create custom post type labels */
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

  /* Create custom post type arguments */
  $cpt_args = array(
    'labels'            => $cpt_labels,
    'supports'          => array('title', 'editor', 'revisions'),
    'public'            => true,
    'menu_position'     => $menu_position,
    'menu_icon'         => 'dashicons-networking',
    'show_in_admin_bar' => false,
    'has_archive'       => true,
    'rewrite'           => array(
      'slug' => preg_replace('/_/i', '-', $key)
    ),
    'capability_type'   => array($key . '_resource', $key . '_resources'),
    'map_meta_cap'      => true,
  );

  /* Register each divison post type */
  register_post_type($key, $cpt_args);
}

/*
 * Register custom taxonomies
 */
function register_custom_taxonomies($key) {

  /* Create custom taxonomy labels */
  $tax_labels = array(
    'name'                       => _x('Categories', 'taxonomy general name'),
    'singular_name'              => _x('Category', 'taxonomy singular name'),
    'search_items'               => __('Search Categories'),
    'popular_items'              => __('Popular Categories'),
    'all_items'                  => __('All Categories'),
    'edit_item'                  => __('Edit Category'),
    'update_item'                => __('Update Category'),
    'add_new_item'               => __('Add New Category'),
    'new_item_name'              => __('New Category Name'),
    'separate_items_with_commas' => __('Separate Categories with commas'),
    'add_or_remove_items'        => __('Add or remove Categories'),
    'choose_from_most_used'      => __('Choose from the most used Categories'),
    'not_found'                  => __('No Categories found.'),
    'menu_name'                  => __('Categories'),
  );

  /* Create custom taxonomy arguments */
  $tax_args = array(
    'labels'                => $tax_labels,
    'show_ui'               => true,
    'show_admin_column'     => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var'             => false,
    'rewrite'               => array(
      'slug'  => preg_replace('/_/i', '-', $key) . '/category'
    ),
    'capabilities'          => array(
      'manage_terms'  =>  'edit_' . $key . '_resources',
      'edit_terms'    =>  'edit_' . $key . '_resources',
      'delete_terms'  =>  'edit_' . $key . '_resources',
      'assign_terms'  =>  'edit_' . $key . '_resources',
    ),
  );

  /* Register custom taxonomy */
  register_taxonomy($key . '_tax', $key, $tax_args);
}

/*
 * Register custom roles
 *
 * 1. Add "Manager" role for each division
 *    a. Has basic capabilities to manage media, delete posts, and read
 */
function register_custom_roles($key, $value) {
 add_role('manager_' . $key,
          'Manager: ' . $value,
          array(
            'read'              => true,
            'edit_posts'        => false,
            'delete_posts'      => true,
            'publish_posts'     => false,
            'upload_files'      => true,
          )
  );
}

/*
 * Register custom capabilities
 */
add_action('admin_init','register_custom_capabilities', 999);
function register_custom_capabilities() {

  /* Let administrator manage Favorites */
  $role = get_role('administrator');
  $role->add_cap('read');
  $role->add_cap('read_favorite');
  $role->add_cap('read_private_favorites');
  $role->add_cap('edit_favorite');
  $role->add_cap('edit_favorites');
  $role->add_cap('edit_others_favorites');
  $role->add_cap('edit_published_favorites');
  $role->add_cap('publish_favorites');
  $role->add_cap('delete_others_favorites');
  $role->add_cap('delete_private_favorites');
  $role->add_cap('delete_published_favorites');

  /* Initialize array of divisions */
  $division_keys = array(
    "accounting_admin",
    "civil",
    "creative",
    "environmental",
    "hr",
    "it",
    "landscape_arch",
    "planning",
    "roadway",
    "structures",
    "sue",
    "survey",
    "trans_planning",
    "utilities"
  );

  /* Loop through each division in the array */
  foreach ($division_keys as $division_key) {

    /* Declare array of roles that should be able to manage this division */
    $division_roles = array('manager_' . $division_key, 'editor' , 'administrator');

    /* Loop through roles and add necessary capabilities */
    foreach($division_roles as $division_role) {
      $role = get_role($division_role);
      $role->add_cap('read');
      $role->add_cap('read_' . $division_key . '_resource');
      $role->add_cap('read_private_' . $division_key . '_resources');
      $role->add_cap('edit_' . $division_key . '_resource');
      $role->add_cap('edit_' . $division_key . '_resources');
      $role->add_cap('edit_others_' . $division_key . '_resources');
      $role->add_cap('edit_published_' . $division_key . '_resources');
      $role->add_cap('publish_' . $division_key . '_resources');
      $role->add_cap('delete_others_' . $division_key . '_resources');
      $role->add_cap('delete_private_' . $division_key . '_resources');
      $role->add_cap('delete_published_' . $division_key . '_resources');
    }
  }
}
