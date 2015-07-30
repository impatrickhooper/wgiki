<?php
/**
 * WGIki custom rewrite rules
 *
 * @package WGIki
 */

/*
 * Custom rewrite rules for protecting WGI files
 *
 * 1. Add comment to block off this section of rules so it's clearly theme-related
 * 2. Turn on RewriteEngine if module exists
 * 3. For all uploads with provided extensions, redirect to resources page
 * 4. Pass query parameter with file name
 */
add_filter('mod_rewrite_rules', 'wgiki_htaccess_rules');
function wgiki_htaccess_rules($rules) {
  $wgiki_rules = <<<EOD
\n# BEGIN WGIki
<IfModule mod_rewrite.c>
RewriteEngine On
RewriteRule ^wp-content/uploads/(.+)$ https://wgiki.com/protected/?file=$1 [QSA,L]
</IfModule>
# END WGIki\n\n
EOD;
  return $wgiki_rules . $rules;
}

/*
 * Replace taxonomy slug with post type slug in url
 */

/* Add taxonomy_slug_rewrite function to rewrite rules filter */
add_filter('generate_rewrite_rules', 'taxonomy_slug_rewrite');
function taxonomy_slug_rewrite($wp_rewrite) {

  /* Initialize array to hold rules */
  $rules = array();

  /* Get all custom taxonomies */
  $taxonomies = get_taxonomies(array('_builtin' => false), 'objects');

  /* Get all custom post types */
  $post_types = getDivisionPostTypes();

  /* Loop through custom post types */
  foreach ($post_types as $post_type) {

    /* Loop through custom taxonomies */
    foreach ($taxonomies as $taxonomy) {

      /* Loop through objects this taxonomy is assigned to */
      foreach ($taxonomy->object_type as $object_type) {

        /* Replace underscores with hyphens */
        $regex_object_type = preg_replace('/_/i', '-', $object_type);

        /* If the object type (with hyphens) is equal to the slug for a post type, do stuff */
        if ($regex_object_type == $post_type->rewrite['slug']) {

          /* Get all terms for this taxonomy */
          $terms = get_categories(array('type' => $object_type, 'taxonomy' => $taxonomy->name, 'hide_empty' => 0));

          /* For each term, do stuff */
          foreach ($terms as $term) {

            /* Add a rewrite rule for each term that uses the post type slug */
            $rules[$regex_object_type . '/' . $term->slug . '/?$'] = 'index.php?' . 'taxonomy=' . $term->taxonomy . '&term=' . $term->slug;
          }
        }
      }
    }
  }

  /* Add custom rules to WordPress rewrite rules */
  $wp_rewrite->rules = $rules + $wp_rewrite->rules;
}
