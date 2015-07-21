<?php
/**
 * The template part for displaying the Resources page.
 *
 * @package WGI Informer
 */
?>

<?php
  /**
   * Protected WGI files
   *
   * 1. Check if query parameter with protected filename has been passed with request
   * 2. Check if user is logged in
   * 3. Load code to handle serving of protected files
   */
  if (isset($_GET['wgi-file']) && is_user_logged_in()) {
    get_template_part('template-parts/content_wgiinformer', 'wgi-files');
  }
  /* Else if a request for a protected file was made but the user is not logged in, redirect to login form */
  elseif (isset($_GET['wgi-file']) && !is_user_logged_in()) {
    auth_redirect();
  }
  /* Otherwise, just serve the standard Resources page */
  else {

    /**
     * Resources query arguments
     *
     * 1. Resources post type
     * 2. Use title to sort
     * 3. Ascending (a -> z)
     * 4. Unlimited posts per page
     */
    $args = array(
      'post_type'       => 'resources',
      'orderby'         => 'title',
      'order'           => 'ASC',
      'posts_per_page'  => -1
    );

    /* Execute the query with the provided arguments */
    $resources = new WP_Query($args);

    /* If there are resources, begin building the resources section */
    if($resources->have_posts()) :
?>

<div class="wrapper wrapper-resources">
  <div id="resources" class="grid-container">

    <?php
      /* Output the html to begin the container for the resource cards */
      echo '<div class="card-grid-container clearfix">';
      $resources_count = 0; // Initialize resources count

      /* While resources query still has posts, do stuff */
      while($resources->have_posts()) :
        $resources->the_post(); // Get the current post
    ?>

    <div class="card-grid grid-50 tablet-grid-100 mobile-grid-100">
      <div class="card <?php echo $post->post_name; ?>">
        <h2 class="division-title"><i class="fa fa-book"></i><?php the_title(); ?></h2><!-- .division-title -->
        <div class="card-content">

          <?php the_content(); ?>

        </div><!-- .card-contet -->
      </div><!-- .card -->
    </div><!-- .card-grid -->

    <?php
        $resources_count++; // Increment the resources count
      endwhile;
      echo '</div>'; // Output closing container div
      wp_reset_postdata();
    ?>

  </div><!-- #resources -->
</div><!-- .wrapper.wrapper-resources -->

<?php
    endif;
  }
?>
