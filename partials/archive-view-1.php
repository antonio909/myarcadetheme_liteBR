<?php
/**
 * Small view
 */
?>
<li>
  <div class="gmcn-larg">
    <figure class="gm-imag">
      <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
        <?php myarcade_thumbnail( array( 'width' => 148, 'height' => 148, 'lazy_load' => myarcadetheme_get_option('lazy_load'), 'show_loading' => myarcadetheme_get_option( 'lazy_load_animation' ) ) ); ?>
        <span class="fa-gamepad">
          <?php _e("<strong>PLAY</strong> <span>NOW!</span>", 'myarcadetheme' ); ?>
        </span>
      </a>
    </figure>

    <div class="gm-titl">
      <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
        <?php the_title(); ?>
      </a>
    </div>

    <div class="gm-desc">
      <p><?php myarcade_description(230); ?></p>
    </div>

    <?php myarcadetheme_rate_and_view(); ?>
  </div>
</li>