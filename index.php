<?php get_header(); ?>

<div class="cont">

  <?php get_template_part( "partials/slider", "bx" ); ?>

  <div class="cntcls <?php echo 'sidebar_' . myarcadetheme_get_option( 'sidebar_position', 'right' ); ?>">
    <?php
    $main_class = myarcadetheme_get_option( 'box_design' ) == 'friv' ? 'cols-n12' : 'cols-n9';
    ?>
    <main class="main-cn <?php echo $main_class ?>">
      <?php
      // Display promoted games box. This file is used for the Friv-Layout, too.
      get_template_part( "partials/index", "promoted" );

      if ( myarcadetheme_get_option( 'box_design' ) == 'builder' ) {
          ?>
          <div id="message">
            <div class="warning"><?php printf( __("There are no widgets in your 'Front Page Sidebar'. Navigate to %sAppearance -> Widgets%s and add some widgets to this sidebar.", 'myarcadetheme' ), '<a href="'.admin_url( "widgets.php" ).'"><strong>', '</strong></a>'); ?></div>
          </div>
          <?php
      }
      else {
        // Display the front page text for SEO purpose
        get_template_part( "partials/index", "front-page-text" );

        // Display Hall Of Fame box
        get_template_part( "partials/index", "hall-of-fame" );

        // Display category boxes but not on the friv view
        if ( strpos( myarcadetheme_get_option( 'box_design' ), 'friv' ) === false ) {
          get_template_part( "partials/index", "boxes" );
        }
      }

      if ( function_exists('get_game_list') && ! ( myarcadetheme_get_option( 'mobile_game_list', 0 ) && wp_is_mobile() ) ) { get_game_list(); }
      ?>
    </main>

    <?php if ( myarcadetheme_get_option( 'box_design' ) != 'friv' && is_front_page() ) { get_sidebar(); } ?>
  </div>
</div>
<?php get_footer(); ?>