<?php global $myarcadetheme_loop; ?>

<!--<blk-cn>-->
<div class="blk-cn">
  <div class="titl"><a href="<?php echo get_category_link( $myarcadetheme_loop['category']->cat_ID ); ?>"><?php echo $myarcadetheme_loop['category']->name; ?></a> <a class="botn-mrgm fa-plus" href="<?php echo get_category_link( $myarcadetheme_loop['category']->cat_ID ); ?>"><?php _e('MORE GAMES', 'myarcadetheme'); ?></a></div>
    <ul class="lst-gmct-cntcls-n6">
     <?php foreach ( $myarcadetheme_loop['games'] as $post ) : ?>
      <!--<game>-->
      <li>
        <div class="gmcn-larg">
          <figure class="gm-imag">
            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
              <?php myarcade_thumbnail( array( 'width' => 148, 'height' => 148, 'lazy_load' => myarcadetheme_get_option('lazy_load'), 'show_loading' => myarcadetheme_get_option( 'lazy_load_animation' ) ) ); ?><span class="fa-gamepad"><?php printf( __('%sPLAY%s %sNOW!%s', 'myarcadetheme'), '<strong>', '</strong>', '<span>', '</span>'); ?></span>
            </a>
          </figure>
          <div class="gm-titl"><a href="<?php the_permalink(); ?>"><?php myarcade_title(20); ?></a></div>
          <div class="gm-desc">
            <p><?php myarcade_excerpt(115); ?></p>
          </div>

          <?php myarcadetheme_rate_and_view(); ?>
        </div>
      </li>
      <!--</game>-->
    <?php endforeach; ?>
  </ul>
</div>
<!--</blk-cn>-->