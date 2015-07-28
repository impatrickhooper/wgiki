<?php
/**
 * The template part for displaying the Side Nav.
 *
 * @package WGI Informer
 */
?>

<?php
  $page_division = getPageDivision();
?>

<a href="#" data-activates="main-nav" class="right side-nav_collapse hide-on-large-only waves-effect waves-circle">
  <i class="fa fa-bars" title="Navigation"></i>
</a><!-- .side-nav_collapse -->

<nav id="main-nav" class="side-nav fixed main-navigation" role="navigation">

  <div class="site-branding">
  </div><!-- .site-branding -->

  <ul class="site-navigation">

  <?php
    /* Get menu pages, excluding Home and Protected */
    $menu_pages = getDivisionPages('768, 770');

    /* For each menu page, do stuff */
    foreach($menu_pages as $menu_page):
  ?>

    <li class="side-nav_item side-nav_item-first">
      <a href="<?php echo get_permalink($menu_page->ID) ?>">
        <i class="fa fa-book"></i><?php echo $menu_page->post_title; ?>
      </a>

      <?php
        /* Get the name of the current menu page */
        $menu_page_name = $menu_page->post_name;

        /* If the menu page name is the same as the current division, do stuff */
        if ($menu_page_name == $page_division) :

          /* Replace hypens with underscores to get taxonomy type */
          $category_type = preg_replace('/-/i', '_', $page_division);

          /* Append _tax to create taxonomy name */
          $category_name = $category_type . '_tax';

          /* Get category pages */
          $category_pages = getDivisionCategories($category_type, $category_name);

          /* If the categories query is not empty, do stuff */
          if (!empty($category_pages)):
      ?>

        <ul class="site-navigation_categories">

      <?php
            /* For each category, do stuff */
            foreach ($category_pages as $category_page):
      ?>

          <li class="side-nav_item side-nav_item-second">
            <a href="<?php echo get_term_link($category_page); ?>">
              <i class="fa fa-bookmark"></i><?php echo $category_page->cat_name; ?>
            </a>
          </li>

      <?php endforeach; ?>

        </ul>

      <?php
          endif;
        endif;
      ?>

    </li>

  <?php endforeach; ?>

  </ul>

</nav><!-- #site-navigation -->
