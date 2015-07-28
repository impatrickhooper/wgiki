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
 * Return a query of pages.
 *
 * 1. Sort by title, A-Z
 * 2. Exclude specified pages
 * 3. Query the pages
 */
function getDivisionPages($excluded_pages) {
  $menu_args = array(
    'sort_order'  => 'asc',
    'sort_column' => 'post_title',
    'exclude'     => $excluded_pages
  );

  return get_pages($menu_args);
}

/**
 * Return a query of categories for a division page.
 *
 * 1. Type is the current division type
 * 2. Name is the current division name + _tax
 * 3. Query categories
 */
function getDivisionCategories($category_type, $category_name) {
  $category_args = array(
    'type'      => $category_type,
    'taxonomy'  => $category_name
  );

  return get_categories($category_args);
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
