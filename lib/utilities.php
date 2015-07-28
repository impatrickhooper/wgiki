<?php
/**
 * Utility functions for WGIki
 *
 * @package WGIki
 */

/**
 * Return the division corresponding to the current page.
 *
 */
function getPageDivision() {
  /* Initialize empty array and division variable to hold uri matches */
  $page_uri = array();
  $page_division = '';

  /* Grab the first part of the URL after the first / and store in page_uri */
  preg_match('/\/{1}([\w-_.]+)\/?/i', $_SERVER['REQUEST_URI'], $page_uri);

  /* If the match was not empty, set the division to the matched part */
  if (count($page_uri) > 1) {
    $page_division = $page_uri[1];
  }

  return $page_division;
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
