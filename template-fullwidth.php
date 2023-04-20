<?php
/**
 * Template Name: Full Width
 */

get_header(); ?>

<div class="cont">
  <div class="cntcls">
    <main class="main-cn cols-n12">
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
        get_template_part( "partial/content", "none" );
      endif;

      myarcadetheme_comments();
      ?>
    </main>

  </div>
</div>

<?php get_footer(); ?>