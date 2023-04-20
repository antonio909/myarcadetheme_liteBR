<?php
/**
 * The Template for displaying the game play
 *
 * @package WordPress
 * @subpackage MyArcadeTheme
 */
?>
<div class="cont">
  <?php myarcadetheme_breadcrumb(); ?>

  <article itemscope="itemscope" itemtype="http://schema.org/VideoGame">
    <div class="post-sngl post-game post-game-play">
      <header>
        <h1 itemprop="name"><?php the_title(); ?></h1>

        <?php if ( function_exists('the_ratings') ) { ?>
          <div class="gm-vote">
            <div><?php the_ratings(); ?></div>
          </div>
        <?php } ?>

        <?php if (
              myarcadetheme_get_option( 'play_meta_category', 1) ||
              myarcadetheme_get_option( 'play_meta_author', 1) ||
              myarcadetheme_get_option( 'play_meta_date', 1) ||
              myarcadetheme_get_option( 'play_meta_comment_count', 1)
            ): ?>
            <p class="game_post_meta_data">
              <?php if ( myarcadetheme_get_option( 'play_meta_category', 1) ): ?>
              <span class="gm-cate"><?php echo get_the_category_list(' '); ?></span>
              <?php endif; ?>

              <?php if ( myarcadetheme_get_option( 'play_meta_author', 1) ): ?>
              <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" title="<?php printf( esc_attr__( 'View all posts by %s', 'myarcadetheme' ), get_the_author() ); ?>" itemscope="itemscope" itemtype="http://schema.org/Person" >
               <span class="fa-user" itemprop="name"> <?php the_author(); ?> </span>
              </a>
              <?php endif; ?>

              <?php if ( myarcadetheme_get_option( 'play_meta_date', 1) ): ?>
              <span class="fa-calendar" itemprop="datePublished"><?php echo get_the_date('d'); ?> <?php echo get_the_date('M'); ?> , <?php echo get_the_date('Y'); ?></span>
              <?php endif; ?>

              <?php if ( myarcadetheme_get_option( 'play_meta_comment_count', 1) ): ?>
              <span class="fa-comments" itemprop="commentCount"><?php echo number_format_i18n( get_comments_number() ); ?></span>
              <?php endif; ?>
            </p>
            <?php endif; ?>

        <figure itemprop="image"><?php myarcade_thumbnail( array( 'width' => 58, 'height' => 58, 'lazy_load' => myarcadetheme_get_option('lazy_load'), 'show_loading' => myarcadetheme_get_option( 'lazy_load_animation' ) ) ); ?></figure>
      </header>

      <?php do_action( 'myarcadetheme_before_game' ); ?>

      <?php
      $layout = myarcadetheme_get_option( 'game_layout' );
      $center_game = ( 1 == $layout ) ? ' flex_center' : '';
      ?>

      <div class="game-cn<?php echo $center_game; ?>">

        <?php
        if ( 2 == $layout || 4 == $layout ) {
          get_template_part( "partials/game", "left-sidebar" );
        }
        ?>

        <div class="myarcade_game_wrap">
          <?php
          if ( myarcadetheme_get_option( 'above_game_banner', 1 ) ) {
            echo '<div class="above_game_banner bnr728">' . myarcadetheme_get_option( 'above_game_banner' ) . '</div>';

            if ( myarcadetheme_get_option( 'above_game_banner_margin', 1 )  ) {
              echo '<div class="bnr_above_game_spacer" style="margin-bottom: 130px;"></div>';
            }
          }

          if ( myarcadetheme_get_option( 'game_preloader_ads', 1 ) ) {
            $display = 'display:none;';
          }
          else {
            $display = '';
          }
          ?>

          <div id="myarcade_game" class="game-play" style="<?php echo $display; ?>">
            <?php if ( function_exists( 'get_game' ) ) {
              global $mypostid; $mypostid = $post->ID;
              echo myarcade_get_leaderboard_code();
              echo get_game();
            } ?>
          </div>

          <div class="lgtbxbg-pofi"></div>

          <?php
          // Include game pre-loader advertisement if enabled
          if ( myarcadetheme_get_option( 'game_preloader_ads', 1 ) ) {
            get_template_part( "partials/game", "default-progressbar" );
          }

          if ( myarcadetheme_get_option( 'below_game_banner', 1 ) ) {
            if ( myarcadetheme_get_option( 'below_game_banner_margin', 1 )  ) {
              echo '<div class="bnr_below_game_spacer" style="margin-top: 130px;"></div>';
            }

            echo '<div class="below_game_banner bnr728">' . myarcadetheme_get_option( 'below_game_banner' ) . '</div>';
          }
          ?>
        </div>

        <?php
        if ( 3 == $layout || 4 == $layout ) {
          get_template_part( "partials/game", "right-sidebar" );
        }
        ?>



      </div>

      <?php do_action( 'myarcadetheme_after_game' ); ?>
    </div>
  </article>

  <div class="cntcls <?php echo 'sidebar_' . myarcadetheme_get_option( 'sidebar_position', 'right' ); ?>">
    <main class="main-cn cols-n9">
      <?php myarcadetheme_get_layout( 'play_game' ); ?>
    </main>

    <?php get_sidebar(); ?>
  </div>
</div>