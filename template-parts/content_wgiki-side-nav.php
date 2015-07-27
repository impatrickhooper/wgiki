<?php
/**
 * The template part for displaying the Side Nav.
 *
 * @package WGI Informer
 */
?>

<?php
  $post_name = $post->post_name;
?>

<a href="#" data-activates="main-nav" class="right side-nav_collapse hide-on-large-only waves-effect waves-circle">
  <i class="fa fa-bars" title="Navigation"></i>
</a><!-- .side-nav_collapse -->

<nav id="main-nav" class="side-nav fixed <?php echo $post_name ?> main-navigation" role="navigation">

  <div class="site-branding">
  </div><!-- .site-branding -->

  <ul class="site-navigation">

  <?php
    $menu_args = array(
      'sort_order'  => 'asc',
      'sort_column' => 'post_title',
      'exclude'     => '770, 768'
    );
    $menu_pages = get_pages($menu_args);

    foreach($menu_pages as $menu_page):
  ?>

    <li class="side-nav_item side-nav_item-first">
      <a href="<?php echo get_permalink($menu_page->ID) ?>">
        <i class="fa fa-book"></i><?php echo $menu_page->post_title; ?>
      </a>

      <?php
        $menu_page_name = $menu_page->post_name;

        if (($menu_page_name == $post_name)) :
          $category_type = preg_replace('/-/i', '_', $post_name);
          $category_name = $category_type . '_tax';
          $category_args = array(
            'type'      => $category_type,
            'taxonomy'  => $category_name
          );
          $category_pages = get_categories($category_args);
          if (!empty($category_pages)):
      ?>

        <ul class="site-navigation_categories">

      <?php
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
