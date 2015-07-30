<?php
/**
 * The template part for displaying the home page content.
 *
 * @package WGIki
 */
?>

<div class="cards cards-divisions">

<?php
  /* Get all division post types */
  $divs = getDivisionPostTypes();

  /* Loop through each division */
  foreach ($divs as $div):
    $div_label = $div->label; // Get the name
    $div_type = $div->name; // Get the type
    $div_archive = get_post_type_archive_link($div_type); // Get link to archive
    $div_slug = $div->rewrite['slug']; // Get the slug
?>

  <div class="card-container grid-33 tablet-grid-50 mobile-grid-100">
    <div class="card card-stack card-division">
      <a class="card_link" href="<?php echo $div_archive; ?>">
        <div class="card_top card_top-<?php echo $div_slug; ?>">
          <i class="fa fa-book"></i>

          <?php
            $div_tax = $div_type . "_tax"; // Get the taxonomy
            $div_cats = getDivisionCategories($div_type, $div_tax); // Query the categories for this division
            $cats_count = count($div_cats); // Get the number of categories
          ?>

          <span class="num-items"><i class="fa fa-bookmark"></i><?php echo $cats_count; ?> categor<?php echo $cats_count != 1 ? 'ies' : 'y'; ?></span>
        </div><!-- .card_top -->
        <div class="card_middle">
          <strong class="card_type">Division</strong>
          <h6 class="card_title"><?php echo $div_label; ?></h6>
          <p class="card_description">Looking for resources for the <?php echo $div_label; ?> division? You've come to the right place.</p>
        </div><!-- .card_middle -->
      </a><!-- .card_link -->
      <div class="card_bottom">
        <a href="<?php echo $div_archive; ?>" class="btn btn-<?php echo $div_slug; ?>">View</a>
      </div><!-- .card_bottom -->
    </div><!-- .card.card-division -->
  </div><!-- .card-container -->

<?php
  endforeach;
  wp_reset_postdata();
?>

</div><!-- .cards-divisions -->
