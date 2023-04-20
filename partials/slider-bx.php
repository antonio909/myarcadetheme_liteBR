<?php
/**
 * The template for displaying the BXSlider
 *
 * @package WordPress
 * @subpackage MyArcadeTheme
 * @since 1.0.0
 */

// Check if the slider is enabled
if ( myarcadetheme_get_option( 'slider_home', 1) && ! ( myarcadetheme_get_option( 'mobile_slider', 0 ) && wp_is_mobile() ) ) {

  $categories = myarcadetheme_get_option( 'categories_sliderft' );
  $category_in = '';
  if ( !empty($categories) ) {
    $category_in = implode(",", $categories);
  }

  // Query games with screenshots
  $args = array (
    'showposts' => myarcadetheme_get_option( 'gamecount_sliderft', 10 ),
    'cat'       => $category_in,
    'orderby'   => 'date',
    'meta_query' => array (
      array (
        'key' => 'mabp_screen1_url',
        'value' => 'http',
        'compare' => 'LIKE'
      )
    )
  );

  if ( wp_is_mobile() && myarcadetheme_get_option( 'mobile' ) ) {
    $args['tag'] = 'mobile';
  }

  $querybxslider = new WP_Query( $args );

  if ( $querybxslider->have_posts() ) {
    global $post;

    $queried_posts = array();

    ob_start();
    ?>
    <div class="lastgms-cn-clfl">
      <div class="mt-bx-loading"></div>
      <div id="lastgmsload" style="visibility:hidden">
        <div class="lstgms">
          <ul class="sldr-gm">
          <?php while ( $querybxslider->have_posts() ) : $querybxslider->the_post(); ?>
            <?php $queried_posts[] = $post->ID; ?>
            <!--<game>-->
            <li>
              <div class="gmcn-sldr">
                <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                  <figure><?php myarcade_screenshot( array( 'width' => 750, 'height' => 390, 'lazy_load' => myarcadetheme_get_option('lazy_load'), 'show_loading' => myarcadetheme_get_option( 'lazy_load_animation' ) ) ); ?></figure>
                </a>
                <div class="gm-text">
                  <div class="gm-cate"><?php echo myarcade_category(); ?></div>
                  <div class="gm-titl">
                    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                      <?php the_title(); ?>
                    </a>
                  </div>
                  <div class="gm-desc">
                    <p><?php myarcade_description(150); ?></p>
                  </div>

                  <?php myarcadetheme_rate_and_view(); ?>
                </div>
              </div>
            </li>
            <!--</game>-->
          <?php endwhile; ?>
          <?php wp_reset_postdata(); ?>
          </ul>
        </div>
        <ul class="lst-gamgrid vs-dsk">
          <?php
          // Query latest games for the right site of the slider, but exclude already displayed in the slider
          $args = array (
            'showposts' => 9,
            'cat'       => $category_in,
            'post__not_in' => $queried_posts,
            'orderby'   => 'date',
          );

          // get the blog cat
          $blog_cat = ( myarcadetheme_get_option('blogcat') ) ? intval( myarcadetheme_get_option('blogcat') ) : false;
          if ( $blog_cat ) {
            $args['category__not_in'] = array( $blog_cat );
          }

          $additional_games = new WP_Query( $args );

          if ( $additional_games->have_posts() ) {
            while ( $additional_games->have_posts() ) : $additional_games->the_post();
              ?>
              <!--<game>-->
              <li>
                <div class="gmcn-midl">
                  <figure class="gm-imag">
                    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                      <?php myarcade_thumbnail( array( 'width' => 130, 'height' => 130, 'lazy_load' => myarcadetheme_get_option('lazy_load'), 'show_loading' => myarcadetheme_get_option( 'lazy_load_animation' ) ) ); ?>
                    </a>
                  </figure>
                  <div class="gm-text">
                    <div class="gm-cate"><?php echo myarcade_category(); ?></div>
                    <div class="gm-titl">
                      <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                        <?php myarcade_title(25); ?>
                      </a>
                    </div>

                    <?php myarcadetheme_rate_and_view(); ?>
                  </div>
                </div>
              </li>
              <!--</game>-->
              <?php
            endwhile;
            wp_reset_postdata();
          }
          ?>
        </ul>
      </div>
    </div>
    <?php
    ob_end_flush();
  }
}