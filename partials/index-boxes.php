<?php
// Display a banner if set
if ( myarcadetheme_get_option ( 'content_banner' ) ) : ?>
  <div class="bnr728">
    <?php echo myarcadetheme_get_option( 'content_banner' ); ?>
  </div>
  <?php
endif;

// Generate Game Boxes

// Get categories, hide empty, exclude defined
$categories = get_categories( myarcadetheme_get_exclude_categories() );

// Generate the query string.
$get_post_query = 'numberposts='.myarcadetheme_get_option('posts_per_page_home', 6).myarcadetheme_mobile_tag().myarcadetheme_exclude_blog().'&orderby=desc&category=';

// ***************************************************************************
// Generate Game Boxes... Loop through all categories
// ***************************************************************************

// Define some required global vars
global $myarcadetheme_loop;

$myarcadetheme_loop = array(
  'games'     => false,
  'category'  => false,
  'count'    => 1,
);

// Do some actions before game category boxes
do_action('myarcadetheme_before_boxes');

foreach ( $categories as $myarcadetheme_loop['category'] ) {
  // Get games from this category
  $myarcadetheme_loop['games'] = get_posts( $get_post_query . $myarcadetheme_loop['category']->cat_ID );

  // Check if we have some games in this category
  if ( $myarcadetheme_loop['games'] ) {
    // There are some games.. Create the game box
    get_template_part( 'partials/index', myarcadetheme_get_option( 'box_design', 'full' ) );
  }

  $myarcadetheme_loop['count']++;
}

// Do some actions after game category boxes
do_action('myarcadetheme_after_boxes');