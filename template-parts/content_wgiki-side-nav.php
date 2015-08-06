<?php
/**
 * The template part for displaying the Side Nav.
 *
 * @package WGI Informer
 */
?>

<?php
  /* Get the current url */
  $currentURL = getCurrentURL();

  /* Get the division this page belongs to */
  $page_div = getPageDivision();
?>

<nav id="main-nav" class="side-nav main-navigation" role="navigation">

  <div class="site-branding">
  </div><!-- .site-branding -->

  <ul class="site-navigation">

  <?php
    /* Get menu pages based on division post types */
    $menu_pages = getDivisionPostTypes();

    /* For each menu page, do stuff */
    foreach($menu_pages as $menu_page):
      $menu_page_type = $menu_page->name; // Get menu page type
      $menu_page_archive_link = get_post_type_archive_link($menu_page_type); // Get menu page archive link
  ?>

    <li class="side-nav_item side-nav_item-first">

      <a href="<?php echo $menu_page_archive_link; ?>" <?php echo ($menu_page_archive_link == $currentURL || $menu_page_archive_link == $currentURL . '/') ? 'class="active"' : ''; ?>>
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
              $cat_term_link = get_term_link($cat_page); // Get category page link
          ?>

          <li class="side-nav_item side-nav_item-second">
            <a href="<?php echo $cat_term_link; ?>" <?php echo ($cat_term_link == $currentURL || $cat_term_link == $currentURL . '/') ? 'class="active"' : ''; ?>>
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
