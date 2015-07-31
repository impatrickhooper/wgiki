<?php
/**
 * Template part for displaying single posts.
 *
 * @package WGIki
 */

?>

<?php
  $post_type = get_field('resource_type'); // Get the resource type
  $post_class = ''; // Initialize variable for additional post class
  $post_extra = ''; // Initialize variable for extra post content

  /* If this isn't an article or embedded media, it's a resource repository */
  if ($post_type != 'article' && $post_type != 'embedded-media') {
    $post_class = 'repo';
  }

  /* If this is a file, get the path to the file */
  if ($post_type == 'file') {
    $post_extra = get_field('upload-file');
  }
  /* Otherwise if this is an external link, get the URL */
  elseif ($post_type == 'external-link') {
    $post_extra = get_field('link_url');
  }
?>

<article id="post-<?php the_ID(); ?>" <?php post_class($post_class); ?>>
  <header class="entry-header">

    <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

  </header><!-- .entry-header -->

  <div class="entry-edit">

    <?php wgiki_entry_footer(); ?>

  </div><!-- .entry-edit -->

<?php
  /* If this post has extra content (file or external URL), output it here */
  if ($post_extra):
?>

  <div class="entry-extra">

    <a href="<?php echo $post_extra; ?>" target="_blank"><?php the_title(); ?></a>

  </div><!-- .entry-extra -->

<?php endif; ?>

  <div class="entry-content">

    <?php the_content(); ?>

  </div><!-- .entry-content -->
</article><!-- #post-## -->

