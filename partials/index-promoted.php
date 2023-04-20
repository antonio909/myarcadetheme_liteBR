<?php
/**
 * Template for displaying promoted games box and Friv-Style layout
 */

$box_design = myarcadetheme_get_option('box_design' );

if ( myarcadetheme_get_option('promoted_games', 1 ) || strpos( $box_design, 'friv' ) !== false ) :

$promoted_order = filter_input( INPUT_COOKIE, 'promoted_order', FILTER_VALIDATE_INT, array("options" => array( "default" => myarcadetheme_get_option('promoted_order', 1 ) ) ) );

$title = false;

if ( myarcadetheme_get_option('promoted_games', 1 ) ) {
  $title = myarcadetheme_get_option( 'promoted_title' );
}

if ( strpos( $box_design, 'friv' ) !== false ) {
  $title = myarcadetheme_get_option( 'friv_style_title' );
}
?>
<div class="titl">
  <div>
    <?php echo $title; ?>
  </div>

  <?php
  if ( strpos( $box_design, 'friv') !== false ) {
    $id = 'friv_style_games';
  }
  else {
    $id = 'promoted_games';
  }
  ?>

  <div class="mt-slct-cn game_sorting">
    <label for="<?php echo $id; ?>"><?php _e('Sort:', 'myarcadetheme'); ?></label>
    <select id="<?php echo $id ?>">
      <option value="1" <?php selected($promoted_order, 1 ); ?>><?php _e('Newest First', 'myarcadetheme'); ?></option>
      <option value="2" <?php selected($promoted_order, 2 ); ?>><?php _e('Oldest First', 'myarcadetheme'); ?></option>
      <?php if( function_exists('the_ratings') ) : ?>
        <option value="3" <?php selected($promoted_order, 3 ); ?>><?php _e('Highest Rated', 'myarcadetheme'); ?></option>
      <?php endif; ?>
      <?php if ( function_exists('the_views') ) : ?>
        <option value="4" <?php selected($promoted_order, 4 ); ?>><?php _e('Most Played', 'myarcadetheme'); ?></option>
      <?php endif; ?>
      <option value="5" <?php selected($promoted_order, 5 ); ?>><?php _e('Most Discussed', 'myarcadetheme'); ?></option>
      <option value="6" <?php selected($promoted_order, 6 ); ?>><?php _e('Alphabetically (A-Z)', 'myarcadetheme'); ?></option>
      <option value="7" <?php selected($promoted_order, 7 ); ?>><?php _e('Alphabetically (Z-A)', 'myarcadetheme'); ?></option>
    </select>
  </div>
</div>

<div id="cntpromotedgames">
  <?php
  switch ( $box_design ) {
    case 'friv':          $class = 'lst-gams-friv'; break;
    case 'friv-sidebar':  $class = 'lst-gams-sidebar-friv'; break;
    default:              $class = 'lst-gams'; break;
  }
  ?>
  <ul class="<?php echo $class; ?>">
    <?php
    if ( strpos( $box_design, 'friv' ) !== false ) {
      // Display banner only on friv style view
      if ( myarcadetheme_get_option( 'promo_banner' ) ) { ?>
        <li class="frivbn">
          <div class="bnr-cnt">
            <div class="bnr300">
              <?php echo myarcadetheme_get_option( 'promo_banner' ); ?>
            </div>
          </div>
        </li>
        <?php
      }
    }

    include( locate_template( "partials/index-promoted-loop.php" ) );
    ?>
  </ul>

  <?php
  if ( strpos( $box_design, 'friv' ) !== false ) {
    myarcadetheme_navigation();
  }
  else {
    wp_reset_postdata();
  } ?>
</div>
<?php endif; ?>