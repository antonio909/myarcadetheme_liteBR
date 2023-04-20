<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 *
 * @package WordPress
 * @subpackage MyArcadeTheme
 */

get_header(); ?>

<div class="cont">
  <div class="cntcls <?php echo 'sidebar_' . myarcadetheme_get_option( 'sidebar_position', 'right' ); ?>">
    <main class="main-cn cols-n9">
      <?php
      // Do some action before the page output
      do_action('myarcadetheme_before_page');

      if ( have_posts() ) :
        while ( have_posts() ) : the_post();
          if ( function_exists('is_bbpress') && is_bbpress() ) {
            get_template_part( "partials/page", "content" );
          }
          else {
            myarcadetheme_breadcrumb();
            ?>
            <article>
              <?php get_template_part( "partials/page", "content" ); ?>
            </article>
            <?php
          }
        endwhile;

        // Do some action after the page output
        do_action('myarcadetheme_after_page');
      else :
        // Nothing found
        get_template_part( "partials/content", "none" );
      endif;

      myarcadetheme_comments();
      ?>
    </main>

    <?php get_sidebar(); ?>
  </div>
</div>

<?php get_footer(); ?>