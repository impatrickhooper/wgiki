<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package WGIki
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico" />

<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

<?php $page_division = getPageDivision(); ?>

  <div id="page" class="<?php echo $page_division; ?> hfeed site">
    <header id="masthead" class="site-header clearfix" role="banner">

    <?php
      /* Output the navbar */
      get_template_part('template-parts/content_wgiki', 'navbar');

      /* Output side nav if user is logged in */
      if (is_user_logged_in()) {
        get_template_part('template-parts/content_wgiki', 'side-nav');
      }
    ?>

    </header><!-- #masthead -->

    <div id="content" class="site-content grid-container">
