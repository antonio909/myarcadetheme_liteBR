<?php
/**
 * Add modal boxes
 */
if ( ! is_user_logged_in() ) : ?>
<?php if ( myarcadetheme_get_option( 'topbar_login', '1' ) == '1' ) : ?>
<div class="modal fade" id="modl-logi" tabindex="-1" role="dialog" aria-hidden="true">
  <button type="button" class="clos-modl bg" data-dismiss="modal"><?php _e( 'Close', 'myarcadetheme' ); ?></button>
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?php echo wp_login_url(); ?>" id="mt_login_theme">
        <div class="modl-titl"><?php _e( 'Login', 'myarcadetheme' ); ?></div>
        <div class="frmspr">
          <label class="icofrm fa-user"><input name="log" type="text" placeholder="<?php _e( 'User name', 'myarcadetheme' ); ?>"></label>
        </div>
        <div class="frmspr">
          <label class="icofrm fa-lock"><input name="pwd" type="password" placeholder="<?php _e( 'Password', 'myarcadetheme' ); ?>"></label>
        </div>
        <div class="frmspr lost_pass"><a href="<?php echo wp_lostpassword_url(); ?>"><?php _e( 'Lost password?', 'myarcadetheme' ); ?></a></div>
        <div class="frmspr"><input name="rememberme" value="forever" id="inch_1" type="checkbox"><label for="inch_1"><?php _e( 'Remember me', 'myarcadetheme' ); ?></label></div>
        <?php if (function_exists("anr_verify_captcha")) :?>
          <?php anr_captcha_form_field(); ?>
        <?php endif; ?>
        <div class="frmspr"><button type="submit"><?php _e( 'LOGIN', 'myarcadetheme' ); ?></button></div>
        <?php if ( function_exists('new_fb_sign_button' ) ) : ?>
        <a class="botn-lgfa fa-facebook" href="<?php echo wp_login_url(); ?>?loginFacebook=1" onclick="window.location = '<?php echo wp_login_url(); ?>?loginFacebook=1; return false;"><?php printf( __( 'LOGIN WITH %sFACEBOOK%s', 'myarcadetheme' ),'<strong>', '</strong>'); ?></a>
        <?php endif; ?>
        <input id="redirect_to" type="hidden" name="redirect_to" value="<?php echo myarcadetheme_get_current_url(); ?>">
        <input type="hidden" name="user-cookie" value="1">
      </form>
    </div>
  </div>
</div>
<?php endif; ?>

<?php if ( myarcadetheme_get_option( 'topbar_register', '1' ) == '1' ) : ?>
<div class="modal fade" id="modl-regi" tabindex="-1" role="dialog" aria-hidden="true">
  <button type="button" class="clos-modl bg" data-dismiss="modal"><?php _e( 'Close', 'myarcadetheme' ); ?></button>
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="#" id="mt_register_theme">
        <div class="modl-titl"><?php _e( 'Signup', 'myarcadetheme' ); ?></div>
        <div class="frmspr">
          <label class="icofrm fa-user"><input name="username" type="text" placeholder="<?php _e( 'User name', 'myarcadetheme' ); ?>"></label>
        </div>
        <div class="frmspr">
          <label class="icofrm fa-envelope"><input name="email" type="text" placeholder="<?php _e( 'Your email address', 'myarcadetheme' ); ?>"></label>
        </div>
        <div class="frmspr">
          <label class="icofrm fa-lock"><input name="pass" type="password" placeholder="<?php _e( 'Password', 'myarcadetheme' ); ?>"></label>
        </div>
        <div class="frmspr">
          <label class="icofrm fa-lock"><input name="passb" type="password" placeholder="<?php _e( 'Retype password', 'myarcadetheme' ); ?>"></label>
        </div>
        <?php if (function_exists("anr_verify_captcha")) :?>
          <?php anr_captcha_form_field(); ?>
        <?php endif; ?>
        <div class="frmspr"><button type="submit"><?php _e( 'Signup', 'myarcadetheme' ); ?></button></div>
        <?php if ( function_exists('new_fb_sign_button') ) : ?>
        <a class="botn-lgfa fa-facebook" href="<?php echo wp_login_url(); ?>?loginFacebook=1" onclick="window.location = '<?php echo wp_login_url(); ?>?loginFacebook=1; return false;"><?php printf( __( 'LOGIN WITH %sFACEBOOK%s', 'myarcadetheme' ),'<strong>', '</strong>'); ?></a>
        <?php endif; ?>
      </form>
    </div>
  </div>
</div>
<?php endif; ?>
<?php endif; ?>

<?php if ( myarcadetheme_get_option( 'topbar_search', '1' ) == '1' ) : ?>
<div class="modal fade" id="modl-srch" tabindex="-1" role="dialog" aria-hidden="true">
  <button type="button" class="clos-modl bg" data-dismiss="modal"><?php _e( 'Close', 'myarcadetheme' ); ?></button>
  <div class="modal-dialog">
    <div class="modal-content cont">
      <div class="srchbx">
        <form method="get" id="search_form" action="<?php echo esc_url( home_url() ); ?>">
          <input name="s" id="s" type="text" placeholder="<?php _e( 'To search type and hit enter', 'myarcadetheme' ); ?>">
          <button type="submit"><span class="fa-search"><?php _e( 'Search', 'myarcadetheme' ); ?></span></button>
          <p><?php _e( 'PRESS ENTER TO SEARCH', 'myarcadetheme' ); ?></p>
        </form>
      </div>
    </div>
  </div>
</div>
<?php endif; ?>