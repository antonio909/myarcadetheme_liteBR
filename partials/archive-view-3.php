<?php
/**
 * Grid view
 */
?>
<li>
  <div class="gmcn-midl">
    <figure class="gm-imag">
      <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
        <?php myarcade_thumbnail( array( 'width' => 148, 'height' => 148, 'lazy_load' => myarcadetheme_get_option('lazy_load'), 'show_loading' => myarcadetheme_get_option( 'lazy_load_animation' ) ) ); ?>
      </a>
    </figure>

    <div class="gm-text">
      <div class="gm-cate">
        <?php echo myarcade_category(); ?>
      </div>

      <div class="gm-titl">
        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
          <?php the_title(); ?>
        </a>
      </div>

      <?php myarcadetheme_rate_and_view(); ?>
    </div>
  </div>
</li>