<?php
/**
 * The Template for displaying all single posts
 *
 * @package WordPress
 * @subpackage MyArcadeTheme
 */

get_header();

if ( have_posts() ) {
  while ( have_posts() ) :
    the_post();

    if ( myarcadetheme_mobile_tag() && ! has_tag( 'mobile' ) ) {
      // We should display mobile games but this game isn't mobile ready!
      get_template_part( "partials/content", "none-mobile" );
    }
    else {
      if ( function_exists('is_game') && is_game() ) {
        // Display game without the landing page
        get_template_part( "partials/game", "play" );
      }
      else {
        // Seems to be a blog entry
        get_template_part( "partials/single", "content" );
      }
    }
  endwhile;
}
else {
  // Nothing found
  get_template_part( "partials/content", "none" );
}

// Do some actions before the content wrap ends
do_action('myarcadetheme_before_content_end');
?>

<?php get_footer(); ?>