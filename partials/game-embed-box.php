<div class="blk-cn">
  <div class="titl"><?php _e('DO YOU LIKE THIS GAME?', 'myarcadetheme'); ?></div>
  <div class="embdtxt">
    <p><?php _e('Embed this game', 'myarcadetheme'); ?></p>
    <form name="select_all" action="#">
      <textarea name="text_area" onclick="javascript:this.form.text_area.focus();this.form.text_area.select();" class="intx rnd5" cols="66" rows="3"><a href="<?php echo home_url();?>"><?php bloginfo('name'); ?></a><br /><?php if ( function_exists('get_game_code') ) echo get_game_code(); else echo get_game($post->ID); ?></textarea>
    </form>
  </div>
</div>