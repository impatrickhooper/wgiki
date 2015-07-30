<?php
/**
 * Utility functions for WGIki
 *
 * @package WGIki
 */

/**
 * Return the division corresponding to the current page.
 */
function getPageDivision() {
  /* Initialize empty array and division variable to hold uri matches */
  $page_uri = array();

  /* Grab the first part of the URL after the first / and store in page_uri */
  preg_match('/\/{1}([\w-_.]+)\/?/i', $_SERVER['REQUEST_URI'], $page_uri);

  /* If the match was not empty, set the division to the matched part */
  if (count($page_uri) > 1) {
    return $page_uri[1];
  }

  return '';
}

/**
 * Return a query of custom post types (divisions).
 *
 * 1. Only public post types
 * 2. Not built in to WordPress core (so, custom types)
 * 3. Query post types and return results as objects
 */
function getDivisionPostTypes() {
  $div_args = array(
    'public' => true,
    '_builtin' => false
  );

  return get_post_types($div_args, 'objects');
}

/**
 * Return a query of categories for a division page.
 *
 * 1. Type is the current division type
 * 2. Name is the current division name + _tax
 * 3. Query categories and return results
 */
function getDivisionCategories($cat_type, $cat_name) {
  $cat_args = array(
    'type'      => $cat_type,
    'taxonomy'  => $cat_name
  );

  return get_categories($cat_args);
}

/**
 * Return a query of posts for a custom taxonomy.
 *
 * 1. Unlimited number of posts
 * 2. Post type is the current division type
 * 3. Order by title, A-Z
 * 4. Query by taxonomy
 *    a. Taxonomy is current division taxonomy
 *    b. Search field is term_id
 *    c. Term ID is current category's ID
 * 5. Query posts and return results
 */
function getCategoryResources($div_type, $div_tax, $cat_term_id) {
  $resrc_args = array(
    'numberposts' => -1,
    'post_type'   => $div_type,
    'orderby'     => 'title',
    'order'       => 'ASC',
    'tax_query'   => array(
      array(
        'taxonomy' => $div_tax,
        'field'    => 'term_id',
        'terms'    => $cat_term_id
      )
    )
  );

  return get_posts($resrc_args);
}

/**
 * Filters the content to remove any extra paragraph or break tags
 * caused by shortcodes.
 *
 * @since 1.0.0
 *
 * @param string $content  String of HTML content.
 * @return string $content Amended string of HTML content.
 */
add_filter( 'the_content', 'tgm_io_shortcode_empty_paragraph_fix' );
function tgm_io_shortcode_empty_paragraph_fix( $content ) {
  $array = array(
    '<p>['    => '[',
    ']</p>'   => ']',
    ']<br />' => ']'
  );
  return strtr( $content, $array );
}
