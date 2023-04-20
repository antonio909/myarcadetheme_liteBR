<?php
/**
 * The Template for displaying the game play page
 *
 * @package WordPress
 * @subpackage MyArcadeTheme
 */

get_header();

if ( have_posts() ) {
  while ( have_posts() ) {
    the_post();

    // Display game and content
    get_template_part( "partials/game", "play" );
  } // end while
}
else {
  // Nothing found
  get_template_part( "partials/content", "none" );
}

// Do some actions before the content wrap ends
do_action( 'myarcadetheme_before_content_end' );

get_footer();