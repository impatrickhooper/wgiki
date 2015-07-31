<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WGIki
 */

get_header(); ?>

  <div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

      <div class="cards cards-categories">

      <?php
        $div_obj = get_queried_object(); // Get the division object
        $div_label = $div_obj->label; // Get the name
        $div_type = $div_obj->name; // Get the type
        $div_slug = $div_obj->rewrite['slug']; // Get the slug
      ?>

        <h1 class="entry-title"><?php echo $div_label; ?></h1>

        <?php
          $div_tax = $div_type . "_tax"; // Get the taxonomy
          $cats = getDivisionCategories($div_type, $div_tax); // Query the categories for this division

          /* Loop through each category */
          foreach ($cats as $cat):
            $cat_archive = get_term_link($cat); // Get link to term page
        ?>

        <div class="card-container grid-33 tablet-grid-50 mobile-grid-100">
          <div class="card card-stack card-category">
            <a class="card_link" href="<?php echo $cat_archive; ?>">
              <div class="card_top card_top-<?php echo $div_slug; ?>">
                <i class="fa fa-bookmark"></i>

                <?php
                  $cat_resrc = getCategoryResources($div_type, $div_tax, $cat->term_id); // Get resources in this category
                  $resrc_count = count($cat_resrc); // Get number of resources in this cateogry
                ?>

                <span class="num-items"><i class="fa fa-file-text"></i><?php echo $resrc_count; ?> resource<?php echo $resrc_count != 1 ? 's' : ''; ?></span>
              </div><!-- .card_top -->
              <div class="card_middle">
                <strong class="card_type">Category</strong>
                <h6 class="card_title"><?php echo $cat->name; ?></h6>
                <p class="card_description"><?php echo $cat->description; ?></p>
              </div><!-- .card_middle -->
            </a><!-- .card_link -->
            <div class="card_bottom">
              <a href="<?php echo $cat_archive; ?>" class="btn btn-<?php echo $div_slug; ?> waves-effect waves-light">View</a>
            </div><!-- .card_bottom -->
          </div><!-- .card.card-category-->
        </div><!-- .card-container -->


      <?php
          endforeach;
        wp_reset_postdata();
      ?>
      </div><!-- .cards-categories -->
    </main><!-- #main -->
  </div><!-- #primary -->

<?php get_footer(); ?>
