<?php if ( myarcadetheme_get_option( 'lights_button' ) || myarcadetheme_get_option( 'favorite_button' ) || myarcadetheme_get_option( 'fullscreen' ) || myarcadetheme_get_option( 'report_button' ) || myarcadetheme_get_option( 'share_button' )  ) : ?>
<?php $display = myarcadetheme_get_option( 'game_preloader_ads', 1 ) ? 'style="display:none;"' : ''; ?>
<div class="game-ctrl" <?php echo $display; ?>>
  <ul class="game_opts" id="game_opts">
    <?php if ( myarcadetheme_get_option( 'lights_button' ) ) : ?>
      <li><a href="#" class="fa-lightbulb-o trnlgt" title="<?php _e("Turn lights on/off", 'myarcadetheme' ); ?>"></a></li>
    <?php endif; ?>

    <?php if ( myarcadetheme_get_option( 'favorite_button' ) ): ?>
      <?php myarcadetheme_favorite(); ?>
    <?php endif; ?>

    <?php if ( myarcadetheme_get_option( 'report_button' ) && function_exists( 'RBL_UI' ) ) : ?>
      <li>
        <input name="RBL_URL" type="hidden" value="'.home_url().$_SERVER['REQUEST_URI'].'" />
        <a onclick="return false;" id="RBL_Element" href="#" role="button" class="ictxt fa-flag" data-tooltip="tooltip" data-placement="right" title="<?php _e( 'Report this game', 'myarcadetheme' ); ?>">&#xf11d;</a>
      </li>
    <?php endif; ?>

    <?php if ( myarcadetheme_get_option( 'share_button' ) ) : ?>
      <li class="pst-shr">
        <a class="fa-share-alt" href="#"></a>
        <ul class="lst-social">
          <li><a rel="nofollow" onclick="window.open ('https://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>', 'Facebook', 'toolbar=0, status=0, width=650, height=450');" href="javascript: void(0);" class="fa-facebook"><span><?php _e('Facebook', 'myarcadetheme'); ?></span></a></li>
          <li><a rel="nofollow" onclick="window.open ('https://www.twitter.com/share?url=<?php the_permalink(); ?>', 'Twitter', 'toolbar=0, status=0, width=650, height=450');" href="javascript: void(0);" class="fa-twitter"><span><?php _e('Twitter', 'myarcadetheme'); ?></span></a></li>
          <li><a rel="nofollow" onclick="window.open ('https://www.addthis.com/bookmark.php?source=bx32nj-1.0&v=300&url=<?php the_permalink(); ?>');" href="javascript: void(0);" class="fa-plus-square"></a></li>
        </ul>
      </li>
    <?php endif; ?>
  </ul>
</div>
<?php endif; ?>