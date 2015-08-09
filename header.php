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

<!-- Google Tag Manager -->
<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-TNRGSD"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-TNRGSD');</script>
<!-- End Google Tag Manager -->

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
