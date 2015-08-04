<?php
/**
 * The template part for displaying the Side Nav.
 *
 * @package WGI Informer
 */
?>

<?php
  $page_div = getPageDivision();
?>

<div class="navbar-fixed">
  <nav id="mobile-nav" class="nav-wrapper">
    <ul class="right">
      <li>
        <a href="#" data-activates="main-nav" class="side-nav_collapse waves-effect waves-circle">
          <i class="fa fa-bars" title="Navigation"></i>
        </a><!-- .side-nav_collapse -->
      </li><!-- .right -->
    </ul>
  </nav><!-- #mobile-nav.nav-wrapper -->
</div><!-- .navbar-fixed -->

<nav id="main-nav" class="side-nav fixed main-navigation" role="navigation">

  <div class="site-branding">
  </div><!-- .site-branding -->

  <ul class="site-navigation">

  <?php
    /* Get menu pages based on division post types */
    $menu_pages = getDivisionPostTypes();

    /* For each menu page, do stuff */
    foreach($menu_pages as $menu_page):
      $menu_page_type = $menu_page->name;
  ?>

    <li class="side-nav_item side-nav_item-first">
      <a href="<?php echo get_post_type_archive_link($menu_page_type) ?>">
        <i class="fa fa-book"></i><?php echo $menu_page->label; ?>
      </a>

      <?php
        /* Get the name of the current menu page */
        $menu_page_name = $menu_page->rewrite['slug'];

        /* If the menu page name is the same as the current division, do stuff */
        if ($menu_page_name == $page_div) :

          /* Replace hypens with underscores to get taxonomy type */
          $cat_type = $menu_page_type;

          /* Append _tax to create taxonomy name */
          $cat_name = $cat_type . '_tax';

          /* Get category pages */
          $cat_pages = getDivisionCategories($cat_type, $cat_name);

          /* If the categories query is not empty, do stuff */
          if (!empty($cat_pages)):
      ?>

        <ul class="site-navigation_categories">

          <?php
            /* For each category, do stuff */
            foreach ($cat_pages as $cat_page):
          ?>

          <li class="side-nav_item side-nav_item-second">
            <a href="<?php echo get_term_link($cat_page); ?>">
              <i class="fa fa-bookmark"></i><?php echo $cat_page->cat_name; ?>
            </a>
          </li>

          <?php endforeach; ?>

        </ul>

      <?php
          endif;
        endif;
      ?>

    </li>

  <?php
    endforeach;
    wp_reset_postdata();
  ?>

  </ul>

</nav><!-- #site-navigation -->
