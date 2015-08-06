<?php
/**
 * The template part for displaying the Side Nav.
 *
 * @package WGI Informer
 */
?>

<div class="navbar-fixed">
  <nav id="navbar" class="nav-wrapper">

    <?php get_template_part('template-parts/content_wgiki', 'search-form'); ?>

    <ul class="right">
      <li>
        <a href="#" data-activates="search-form" class="search_toggle waves-effect waves-circle">
          <i class="fa fa-search navbar_search-icon" title="Search"></i>
        </a><!-- .side-nav_collapse -->
      </li>
      <li>
        <a href="#" data-activates="main-nav" class="side-nav_collapse waves-effect waves-circle">
          <i class="fa fa-bars navbar_menu-icon" title="Navigation"></i>
        </a><!-- .side-nav_collapse -->
      </li><!-- .right -->
    </ul>
  </nav><!-- #mobile-nav.nav-wrapper -->
</div><!-- .navbar-fixed -->
