<?php
/**
 * WGIki custom post types
 *
 * @package WGIki
 */

/*
 * Create custom post types
 *
 * 1. Initialize array of division short and long names
 * 2. Initialize menu position counter
 * 3. Loop through each division in array
 *    a. Call register_custom_post_types function
 *    b. Call register_custom_taxonomies function
 *    c. Call register_custom_roles function
 *    d.
 *    e. Increment menu position counter
 */
add_action('init', 'create_custom_post_types', 0);
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
    register_custom_roles($key, $value);
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
    'labels'          => $cpt_labels,
    'supports'        => array('title', 'editor', 'revisions'),
    'public'          => true,
    'menu_position'   => $menu_position,
    'menu_icon'       => 'dashicons-networking',
    'capability_type' => array($key . '_resource', $key . '_resources'),
    'map_meta_cap'    => true,
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
    'name'                       => _x('Categories', 'taxonomy general name'),
    'singular_name'              => _x('Category', 'taxonomy singular name'),
    'search_items'               => __('Search Categories'),
    'popular_items'              => __('Popular Categories'),
    'all_items'                  => __('All Categories'),
    'edit_item'                  => __('Edit Category'),
    'update_item'                => __('Update Category'),
    'add_new_item'               => __('Add New Category'),
    'new_item_name'              => __('New Category Name'),
    'separate_items_with_commas' => __('Separate categories with commas'),
    'add_or_remove_items'        => __('Add or remove categories'),
    'choose_from_most_used'      => __('Choose from the most used categories'),
    'not_found'                  => __('No categories found.'),
    'menu_name'                  => __('Categories'),
  );

  $tax_args = array(
    'labels'                => $tax_labels,
    'show_ui'               => true,
    'show_admin_column'     => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var'             => false,
    'capabilities'          => array(
      'manage_terms'  =>  'edit_' . $key . '_resources',
      'edit_terms'    =>  'edit_' . $key . '_resources',
      'delete_terms'  =>  'edit_' . $key . '_resources',
      'assign_terms'  =>  'edit_' . $key . '_resources',
    ),
  );

  register_taxonomy($key, $key, $tax_args);
}


/*
 * Register custom roles
 *
 * 1. Add "Manager" role for each division
 *    a. Has basic capabilities to manage media and read
 */
function register_custom_roles($key, $value) {
 add_role('manager_' . $key,
          'Manager: ' . $value,
          array(
            'read'              => true,
            'edit_posts'        => false,
            'delete_posts'      => false,
            'publish_posts'     => false,
            'upload_files'      => true,
          )
  );
}

/*
 * Register custom capabilities
 *
 * 1. Intializes array of division short names
 * 2. Loops through each division short name in array
 *    a. Creates an array of roles containing division specific, editor, and administrator
 *    b. Loops through array of roles
 *      i. Adds capabilities to needed to manage this division
 */
add_action('admin_init','register_custom_capabilities', 999);
function register_custom_capabilities() {

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

  foreach ($division_keys as $division_key) {
    $division_roles = array('manager_' . $division_key, 'editor' , 'administrator');

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
