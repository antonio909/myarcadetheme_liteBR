<?php if ( myarcade_count_screenshots() ) : ?>
<div class="blk-cn">
  <div class="titl"><?php _e('Screen Shots', 'myarcadetheme'); ?></div>
  <div class="blcnbx">
    <ul class="lst-scrs" data-featherlight-gallery data-featherlight-filter='[rel="lightbox"]'>
      <?php myarcade_all_screenshots(130, 130, 'screen_thumb' ); ?>
    </ul>
  </div>
</div>
<?php endif; ?>