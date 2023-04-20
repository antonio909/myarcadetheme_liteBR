<?php if ( ! ( myarcadetheme_get_option( 'mobile_header_carousel', 0 ) && wp_is_mobile() ) ) : ?>
<?php
if ( myarcadetheme_get_option( 'slider_header' ) ) {
  $args = array();
  $args['post__not_in'] = array( get_the_ID() );

  if ( is_single() && is_game() && myarcadetheme_get_option('related_sliderhd') ) {
    $args['category__in'] = wp_get_post_categories( get_the_ID() );
  }
  else {
    $categories = myarcadetheme_get_option( 'categories_sliderhd' );
    
    if ( $categories ) {
      $args['category__in'] = $categories;
    }
  }

  if (wp_is_mobile() && myarcadetheme_get_option('mobile')) {
      $args['tag_slug__and'] = 'mobile';
  }

  $blog_cat_id = myarcadetheme_get_option('blogcat');

  if ( $blog_cat_id ) {
    $args['category__not_in'] = array( $blog_cat_id );
  }

  $args['posts_per_page'] = myarcadetheme_get_option( 'sortable_sliderhd', 20 );

  $query = new WP_Query( $args );

  if ( $query->have_posts() ) {
    ?>
    <div class="hdcn-4">
      <div class="cont">
        <div class="mt-bx-loading"></div>
        <div class="hdgms-cn" style="visibility:hidden">
          <ul class="sldr-hd">
            <?php
            while ($query->have_posts()) :
              $query->the_post();
            ?>
            <!--<game>-->
            <li>
              <div class="gmcn-smal">
                <figure class="gm-imag"><a href="<?php the_permalink(); ?>"><?php myarcade_thumbnail( array( 'width' => 60, 'height' => 60, 'lazy_load' => false ) ); ?><span class="fa-gamepad"><?php printf( __('%sPLAY%s %sNOW!%s', 'myarcadetheme'), '<strong>', '</strong>', '<span>', '</span>'); ?></span></a></figure>
                <div class="gm-titl"><a href="<?php the_permalink(); ?>"><?php myarcade_title(25); ?></a></div>

               <?php myarcadetheme_rate_and_view(); ?>
              </div>
            </li>
            <!--</game>-->
            <?php
            endwhile;
            ?>
          </ul>
        </div>
      </div>
    </div>
    <?php
    wp_reset_postdata();
  }
}
?>
<?php endif; ?>