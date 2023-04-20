<?php if ( ! ( myarcadetheme_get_option( 'mobile_top_bar', 0 ) && wp_is_mobile() ) ) : ?>
  <?php if ( myarcadetheme_get_option( 'topbar', '1' ) ) : ?>
    <div class="hdcn-1" itemscope="itemscope" itemtype="http://www.schema.org/SiteNavigationElement">
      <div class="cont">
        <?php
        if ( myarcadetheme_get_option( 'topbar_heading', '1' ) ) {
          myarcadetheme_top_heading();
        }
        ?>

        <?php
        if ( myarcadetheme_get_option( 'topbar_login', '1' )
          || myarcadetheme_get_option( 'topbar_register', '1' )
          || myarcadetheme_get_option( 'topbar_search', '1' )
          || myarcadetheme_get_option( 'topbar_share', '1' ) ) : ?>
        <ul class="menu-top<?php if ( is_user_logged_in() ) { ?> usr-online<?php } ?>">
          <?php wp_nav_menu( array( 'container' => false, 'theme_location' => 'top', 'items_wrap' => '%3$s', 'fallback_cb' => false ) ); ?>

          <?php
          if ( myarcadetheme_get_option( 'topbar_login', '1' ) !== '0' ) {
            if ( ! is_user_logged_in() ) {
              if ( myarcadetheme_get_option( 'topbar_login' ) == '1' ) {
                // Modal
                $data = 'href="#" data-toggle="modal" data-target="#modl-logi"';
              }
              else {
                // Link
                $data = 'href="'.wp_login_url( myarcadetheme_get_current_url() ).'"';
              }
              ?>
              <li><a class="fa-sign-in" <?php echo $data; ?>><?php _e('LOGIN', 'myarcadetheme'); ?></a></li>
              <?php
            }
            else {
              global $current_user;
              ?>
              <li>
                <span class="fa-user"><?php printf( __( 'Hello, <strong>%s</strong>', 'myarcadetheme' ), $current_user->display_name ); ?></span>
                <ul>
                  <li class="avatar-cn"><?php echo get_avatar( $current_user->ID, 85 ); ?></li>
                  <li><a href="<?php if(defined('BP_VERSION')){ global $bp; echo $bp->loggedin_user->domain; }else{ echo home_url().'/wp-admin/profile.php'; } ?>" class="fa-user"><?php _e('My account', 'myarcadetheme'); ?></a></li>
                  <li><a href="<?php echo wp_logout_url(  home_url() ); ?>" class="fa-power-off"><?php _e('Logout', 'myarcadetheme'); ?></a></li>
                </ul>
              </li>
              <?php
            }

            if ( ! is_user_logged_in() && myarcadetheme_get_option( 'topbar_register', '1' ) !== '0' ) {
              if ( get_option('users_can_register') ) {
                if ( myarcadetheme_get_option( 'topbar_register' ) == '1' ) {
                // Modal
                $data = 'href="#" href="#" data-toggle="modal" data-target="#modl-regi""';
                }
                else {
                  // Link
                  $data = 'href="'.wp_registration_url().'"';
                }
                ?>
                <li><a class="fa-sign-out" <?php echo $data; ?>><?php _e('REGISTER', 'myarcadetheme'); ?></a></li>
              <?php
              }
            }
          }
          ?>

          <?php if ( myarcadetheme_get_option( 'topbar_search', '1' ) ) : ?>
          <li><a class="fa-search" href="#" data-toggle="modal" data-target="#modl-srch"><?php _e('SEARCH', 'myarcadetheme'); ?></a></li>
          <?php endif; ?>

          <?php if ( myarcadetheme_get_option( 'topbar_share', '1' ) ) : ?>
          <li class="shar-cnt">
            <a class="fa-share-alt" href="#"><?php _e('FOLLOW US', 'myarcadetheme'); ?></a>
            <ul class="lst-social">
              <?php get_template_part( "partials/social", "share" ); ?>
            </ul>
          </li>
          <?php endif; ?>
        </ul>
        <?php endif; ?>
      </div>
    </div>
  <?php endif; ?>
<?php endif; ?>