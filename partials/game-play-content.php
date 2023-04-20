<div class="blk-cn post-list">
  <?php if ( myarcadetheme_get_option( 'pregame', 1 ) ) : ?>
  <div class="titl"><?php _e('GAME INSTRUCTIONS', 'myarcadetheme'); ?></div>
  <?php else: ?>
    <div class="titl"><?php _e('GAME INFO', 'myarcadetheme'); ?></div>
  <?php endif; ?>
  <div class="txcn" itemprop="text">
    <?php
    $banner = myarcadetheme_get_option( 'game_content_banner' );
    if ( $banner ) : ?>
      <div class="contentbnr300">
        <?php echo $banner; ?>
      </div>
    <?php endif ?>

    <p>
      <?php
      $instructions = myarcade_instructions(false);
      if ( ! empty( $instructions ) ) {
        if ( ! myarcadetheme_get_option( 'pregame', 1 ) ) {
          // Display game description
          echo myarcadetheme_content();

          $myarcade_general = get_option( 'myarcade_general' );
          if ( strpos( $myarcade_general['template'], '%INSTRUCTIONS%' ) !== false ) {
            // Display game instructions, too
            echo "<p>". $instructions . "</p>";
          }
        }
        else {
          echo $instructions;
        }
      }
      else {
        echo myarcadetheme_content();
      }
      ?>
    </p>

    <?php
    // Display some manage links if logged in user is an admin
    myarcadetheme_admin_links();
    ?>
  </div>
</div>