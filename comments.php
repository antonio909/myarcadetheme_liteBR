<?php
/**
 * The template for displaying comments
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package WordPress
 * @subpackage MyArcadeTheme
 * @since 1.0.0
 */

// Do not delete these lines
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && 'comments.php' == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
  die ( __("Please do not load this page directly. Thanks!", 'myarcadetheme') );
}

if ( function_exists('post_password_required') ) {
  if ( post_password_required() ) {
    echo '<p class="nocomments">'.__("This post is password protected. Enter the password to view comments.", 'myarcadetheme').'</p>';
    return;
  }
}
else {
  if ( !empty( $post->post_password ) ) { // if there's a password
    if ( $_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password ) {  // and it doesn't match the cookie
      ?>
      <p class="nocomments">
        <?php _e("This post is password protected. Enter the password to view comments.", 'myarcadetheme'); ?>
      </p>
      <?php
      return;
    }
  }
}

if ( have_comments() ) : ?>
  <div class="blk-cn">
    <div class="titl"><?php printf( __('COMMENTS %s#%s%s', 'myarcadetheme'), '<strong>', get_comments_number(), '</strong>'); ?></div>
    <ul class="lst-cmnt" id="comments">
      <?php wp_list_comments( array( 'callback' => 'myarcadetheme_comment' ) ); ?>
    </ul>
  </div>

  <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
    $pagination = paginate_comments_links( array( 'prev_next' => true, 'echo' => false ) );

    if( ! empty( $pagination ) ) : ?>
      <div class="mt-pagnav wp-pagenavi"><?php echo $pagination ?></div>
      <?php
    endif; ?>
  <?php endif; ?>

<?php endif; // end have_comments(); ?>

<?php if ( comments_open() ) : ?>
  <div class="blk-cn" id="respond">
    <?php comment_form( array(
      'title_reply' => '<div class="titl">'. __('LEAVE A REPLY', 'myarcadetheme') . '</div>',
      'logged_in_as' => '<p>' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'myarcadetheme' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',
      'fields' => array(
        'author' => '<div class="frmspr cols-n4"><label class="icofrm fa-user"><input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .'" placeholder="' . __('Name', 'myarcadetheme') .'" size="30"></label></div>',
        'email' => '<div class="frmspr cols-n4"><label class="icofrm fa-envelope"><input id="email" name="email" type="text" value="' . esc_attr( $commenter['comment_author_email'] ) .'" placeholder="'. __('Email', 'myarcadetheme') .'" size="30"></label></div>',
        'url' => '<div class="frmspr cols-n4"><label class="icofrm fa-link"><input id="url" name="url" type="text" value="'. esc_attr( $commenter['comment_author_url'] ) .'" placeholder="'. __('Website', 'myarcadetheme') .'" size="30"></label></div><div style="clear:both"></div>',
      ),
      'comment_field' => '<div class="cols-n12"><label for="comment" class="icofrm fa-comment"><textarea id="comment" name="comment" cols="66" rows="6" placeholder="'. __("Your comment here...", "myarcadetheme").'" aria-required="true"></textarea></label></div><div style="clear:both"></div>',
      'cancel_reply_before' => '<div class="cancel-comment-reply"><span>',
      'cancel_reply_after' => '</span></div>',
      'comment_notes_before' => '<p class="comment-notes cols-n12">' . __( 'Your email address will not be published.', 'myarcadetheme') . '</p>',
        'submit_field' => '<p class="form-submit cols-n12">%1$s %2$s</a>',
    )); ?>
  </div>
<?php endif; ?>