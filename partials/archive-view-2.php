<?php
/**
 * Large view
 */
?>
<li>
  <div class="gmcn-larg">
    <figure class="gm-imag">
      <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
        <?php
        // Check if there is a screenshot available. If so, display it.
        // Otherwise display the game thumbnail
        $screenshot = myarcade_screenshot( array( 'width' => 820, 'height' => 401, 'echo' => false, 'lazy_load' => myarcadetheme_get_option('lazy_load'), 'show_loading' => myarcadetheme_get_option( 'lazy_load_animation' ) ) );
        if ( $screenshot ) {
          echo $screenshot;
        }
        else {
          myarcade_thumbnail( array( 'width' => 820, 'height' => 401, 'lazy_load' => myarcadetheme_get_option('lazy_load'), 'show_loading' => myarcadetheme_get_option( 'lazy_load_animation' ) ) );
        }
        ?>
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