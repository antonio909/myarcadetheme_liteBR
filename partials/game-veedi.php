<div class="blk-cn" id="veedi_video">
  <div class="titl"><?php _e('Walkthrough Video', 'myarcadetheme'); ?></div>
  <div id="veediInit"></div>
  <script type="text/javascript" id="veediInit">
    var _v,settings = {
    game : "<?php echo the_title_attribute(); ?>",
    publisherId : <?php echo myarcadetheme_get_option( 'play_veedi_publisherid' ) ?>,
    onVideoFound :  function() {
    },
    onVideoNotFound : function() {
      jQuery("#veedi_video").remove();
    },
    width  :  800
    };

    (function(settings)  {
      var vScript = document.createElement('script');
      vScript.type = 'text/javascript'; vScript.async = true;
      vScript.src = '//www.veedi.com/player/embed/veediEmbed.js';
      vScript.onload = function(){
        _v = new VeediEmbed(settings);};
        var veedi = document.getElementById('veediInit');
        veedi.parentNode.insertBefore(vScript, veedi);
      })(settings);
    </script>
</div>