<?php
/**
 * The template for displaying search results pages.
 *
 * @package WGIki
 */

get_header(); ?>

  <section id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

    <?php if ( have_posts() ) : ?>

      <header class="page-header">
        <h5 class="search-title"><?php printf( esc_html__( 'Search results for: %s', 'wgiki' ), '<span class="search-terms">' . get_search_query() . '</span>' ); ?></h5>
      </header><!-- .page-header -->

      <?php /* Start the Loop */ ?>
      <?php while ( have_posts() ) : the_post(); ?>

        <?php
        /**
         * Run the loop for the search to output the results.
         * If you want to overload this in a child theme then include a file
         * called content-search.php and that will be used instead.
         */
        get_template_part( 'template-parts/content', 'search' );
        ?>

      <?php endwhile; ?>

    <?php else : ?>

      <?php get_template_part( 'template-parts/content', 'none' ); ?>

    <?php endif; ?>

    </main><!-- #main -->
  </section><!-- #primary -->

<?php get_footer(); ?>
