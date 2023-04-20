<?php if ( myarcade_has_video() ) : ?>
<div class="blk-cn">
  <div class="titl"><?php _e('Video', 'myarcadetheme'); ?></div>
  	<div class="video-container">  
     <?php echo myarcade_video(); ?>
  </div>
</div>
<?php endif; ?>