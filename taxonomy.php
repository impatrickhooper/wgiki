<?php
/**
 * The template for displaying taxonomy pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WGIki
 */

get_header(); ?>

  <div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

      <div class="cards cards-resources">

      <?php
        $cat_obj = get_queried_object(); // Get the category object
        $cat_name = $cat_obj->name; // Get the category name
        $cat_desc = $cat_obj->description; // Get the category description
      ?>

        <h1 class="entry-title"><?php echo $cat_name; ?></h1>
        <p class="entry-description"><?php echo $cat_desc; ?></p>

        <?php
          $div_tax = $cat_obj->taxonomy; // Get the taxonomy
          $div_type = preg_replace('/_tax/i', '', $div_tax); // Get the division type
          $div_name = preg_replace('/_/i', '-', $div_type); // Get division name
          $resrcs = getCategoryResources($div_type, $div_tax, $cat_obj->term_id); // Get all resources in this category

          /* Loop through all resources for this category */
          foreach ($resrcs as $resrc):
            $resrc_id = $resrc->ID; // Get the ID
            $resrc_link = get_permalink($resrc_id); // Get the post permalink
            $resrc_targ = ''; // Set the link target to empty
            $resrc_type = get_field('resource_type', $resrc_id); // Get the resource type
            $resrc_file_type = $resrc_type; // Get the resource file type

            /* If this is an external link, get the link and open in new window */
            if ($resrc_type == 'external-link') {
              $resrc_link = get_field('link_url', $resrc_id);
              $resrc_targ = '_blank';
            }
            /* If this is a file, get the link, file type and open in new window */
            elseif ($resrc_type == 'file') {
              $resrc_link = get_field('upload-file', $resrc_id);
              $resrc_targ = '_blank';
              $resrc_file_type = get_field('file_type', $resrc_id);
            }
            /* If this is embedded media, get the file type */
            elseif ($resrc_type == 'embedded-media') {
              $resrc_file_type = get_field('file_type', $resrc_id);
            }
        ?>

        <div class="card-container grid-100 tablet-grid-100 mobile-grid-100">
          <div class="card card-resource card-resource-<?php echo $div_name; ?>">
            <a class="card_link" href="<?php echo $resrc_link; ?>" target="<?php echo $resrc_targ; ?>">
              <div class="card_info">
                <div class="card_type"><?php echo ucwords(preg_replace('/-/i', ' ', $resrc_type)); ?></div>
                <h6 class="card_name"><i class="fa resrc-type resrc-type-<?php echo $resrc_file_type; ?>"></i><?php echo $resrc->post_title; ?></h6>
                <p class="card_updated">Updated <?php echo get_post_modified_time('F j, Y', false, $resrc_id); ?></p>
              </div><!-- .card_info -->
            </a><!-- .card_link -->
            <div class="card_action">
              <a href="<?php echo $resrc_link; ?>" target="<?php echo $resrc_targ; ?>" class="btn waves-effect waves-light">View</a>
            </div><!-- .card_action -->
          </div><!-- .card.card-resource -->
        </div><!-- .card-container -->

      <?php
          endforeach;
        wp_reset_postdata();
      ?>

      </div><!-- .cards-resources -->
    </main><!-- #main -->
  </div><!-- #primary -->

<?php get_footer(); ?>
