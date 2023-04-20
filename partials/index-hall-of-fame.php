<?php
if ( myarcadetheme_get_option( 'hall_of_fame', '1' ) && defined('MYSCORE_VERSION') ) {
  // Get x best players
  $players = myarcadetheme_get_best_players(5);

  if ( $players ) {
    ?>
    <!--<blk-cn>-->
    <div id="hall_of_fame" class="blk-cn">
      <div class="titl"><?php echo myarcadetheme_get_option( 'hall_of_fame_title', __('HALL OF FAME', 'myarcadetheme') ); ?></div>
      <ul>
        <?php
        foreach ($players as $player) {
          ?>
          <li>
            <div class="avatar"><?php echo get_avatar($player->user_id, 90); ?></div>
            <div class="name"><?php echo myscore_get_user_link($player->user_id); ?></div>
            <div class="plays"><?php printf( __( "%s plays", 'myarcadetheme' ), myarcade_format_number( $player->plays ) ); ?></div>
            <div class="highscores"><?php printf( __( "%s High Scores", 'myarcadetheme' ), myarcade_format_number( $player->highscores ) ); ?></div>
          </li>
          <?php
        }
        ?>
      </ul>
    </div>
    <!--</blk-cn>-->
    <?php
  }
}
?>