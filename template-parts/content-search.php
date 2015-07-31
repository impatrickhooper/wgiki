<?php
/**
 * The template part for displaying results in search pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WGIki
 */

?>

<div class="cards cards-resources cards-search">

<?php
    $div_obj = get_post_type_object(get_post_type()); // Get division object
    $div_name = $div_obj->rewrite['slug']; // Get division slug
    $div_label = $div_obj->label; // Get division name
    $resrc_link = get_permalink(); // Get the post permalink
    $resrc_targ = ''; // Set the link target to empty
    $resrc_type = get_field('resource_type'); // Get the resource type
    $resrc_file_type = $resrc_type; // Get resource file type
    $resrc_tags = get_the_terms(get_the_ID(), $div_obj->name . '_tax'); // Get tags for this resource

    /* If this is an external link, get the link and open in new window */
    if ($resrc_type == 'external-link') {
      $resrc_link = get_field('link_url');
      $resrc_targ = '_blank';
    }
    /* If this is a file, get the link, file type and open in new window */
    elseif ($resrc_type == 'file') {
      $resrc_link = get_field('upload-file');
      $resrc_targ = '_blank';
      $resrc_file_type = get_field('file_type');
    }
    /* If this is embedded media, get the file type */
    elseif ($resrc_type == 'embedded-media') {
      $resrc_file_type = get_field('file_type');
    }
?>

  <div class="card-container grid-100 tablet-grid-100 mobile-grid-100">
    <div class="card card-resource card-resource-<?php echo $div_name; ?>">
      <a class="card_link" href="<?php echo $resrc_link; ?>" target="<?php echo $resrc_targ; ?>">
        <div class="card_info">
          <div class="card_type">

            <?php
              /* Output the resource type with each word capitalized */
              echo ucwords(preg_replace('/-/i', ' ', $resrc_type));

              /* Output the word "in" then the division name */
              echo ' in ';
              echo $div_label;

              /* If this resource has categories, do stuff */
              if (!empty($resrc_tags)) {

                /* Output an arrow */
                echo ' -> ';
                $tag_count = count($resrc_tags); // Get the number of tags

                /* Loop through each tag */
                for ($i = 0; $i < $tag_count; $i++) {

                  /* Output the tag name */
                  echo $resrc_tags[$i]->name;

                  /* If this is not the last tag, output a comma */
                  if ($i < $tag_count - 1) {
                    echo ', ';
                  }
                }
              }
            ?>

          </div>
          <h6 class="card_name"><i class="fa resrc-type resrc-type-<?php echo $resrc_file_type; ?>"></i><?php the_title(); ?></h6>
          <p class="card_updated">Updated <?php echo get_post_modified_time('F j, Y', false); ?></p>
        </div><!-- .card_info -->
      </a><!-- .card_link -->
      <div class="card_action">
        <a href="<?php echo $resrc_link; ?>" target="<?php echo $resrc_targ; ?>" class="btn">View</a>
      </div><!-- .card_action -->
    </div><!-- .card.card-resource -->
  </div><!-- .card-container -->

</div><!-- .cards-resources -->
