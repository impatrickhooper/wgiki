<?php
/**
 * The template part for displaying the Favorites.
 *
 * @package WGIki
 */
?>

<?php
  /**
   * Favorites query arguments
   *
   * 1. Favorites post type
   * 2. Use menu order to sort
   * 3. Ascending (lowest numbers first)
   * 4. Unlimited posts per page
   */
  $args = array(
    'post_type'      => 'favorites',
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
    'posts_per_page' => -1
  );

  /* Execute the query with the provided arguments */
  $favorites = new WP_Query($args);

  /* If there are favorites, begin building the favorites dropdown */
  if($favorites->have_posts()) :
?>

<ul id='favorites' class='dropdown-content'>

  <?php
    /* While the favorites query still has posts, do stuff */
    while($favorites->have_posts()) :
      $favorites->the_post(); // Get the favorite
      $favorite_open_new_tab_field = get_field('favorite_open_new_tab'); // Get the open new tab checkbox
      $favorite_open_new_tab = 'no'; // Set open new tab to no by default

      /* If the open new tab checkbox is not empty, set open new tab to its value */
      if (!empty($favorite_open_new_tab_field)) {
        $favorite_open_new_tab = $favorite_open_new_tab_field[0];
      }
      $favorite_file_type_field = get_field('favorite_file_type'); // Get the favorite file type checkbox
      $favorite_file_type = 'img'; // Set file type to img by default

      /* If favorite file type checkbox is not empty, set file type to its value */
      if (!empty($favorite_file_type_field)) {
        $favorite_file_type = $favorite_file_type_field[0];
      }
  ?>

  <li>
    <a href="<?php the_field('favorite_url'); ?>" <?php if ($favorite_open_new_tab == 'yes'){echo 'target="_blank"';}?>>

      <?php if ($favorite_file_type == 'svg') : ?>

      <svg viewBox="0 0 64 64">
        <use xlink:href="<?php the_field('favorite_icon'); ?>"></use>
      </svg>

      <?php else: ?>

      <div class="favorites_img">
        <img src="<?php the_field('favorite_icon'); ?>">
      </div>

      <?php endif; ?>

      <p><?php the_title(); ?></p>
    </a>
  </li>

  <?php endwhile; ?>

</ul><!-- #favorites -->

<?php endif; ?>
