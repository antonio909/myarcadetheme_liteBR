<?php
/**
 * MyArcadeTheme
 *
 * @author Daniel Bakovic
 *
 * @package WordPress
 * @subpackage MyArcadeTheme
 */

// MyArcadeTheme only works in WordPress 4.1 or later.
if ( version_compare( $GLOBALS['wp_version'], '4.1-alpha', '<' ) ) {
  require( get_template_directory() . '/inc/back-compat.php' );
}

// MyArcadePlugin Theme API
include_once( get_template_directory() . '/inc/myarcade_api.php' );
// Include setup theme
include_once( get_template_directory() . '/inc/setup.php' );
// Include theme widgets
include_once( get_template_directory() . '/inc/widgets.php' );
// Include Ajax functionality
include_once( get_template_directory() . '/inc/ajax.php' );
// Include theme actions API
include_once( get_template_directory() . '/inc/actions.php' );
// Include rewrite rules
include_once( get_template_directory() . '/inc/rewrite.php' );

/**
 * Enqueue scripts
 *
 * @version 5.2.0
 * @since   1.0.0
 * @return  void
 */
function myarcadetheme_scripts() {

  $script_debug = false;

  if ( $script_debug ) {
    $subfolder = 'development/';
    $suffix = '';
  }
  else {
    $subfolder = '';
    $suffix = '.min';
  }

  if ( $script_debug ) {
    wp_enqueue_script( 'myarcadetheme-chkbox', get_template_directory_uri() . '/js/'.$subfolder.'chkbox.js', array('jquery'), '', true );
    wp_enqueue_script( 'myarcadetheme-slctbx', get_template_directory_uri() . '/js/'.$subfolder.'slctbx.js', array('jquery'), '', true );
    wp_enqueue_script( 'myarcadetheme-botmod', get_template_directory_uri() . '/js/'.$subfolder.'botmod.js', array('jquery'), '', true );
    wp_enqueue_script( 'myarcadetheme-menu', get_template_directory_uri() . '/js/'.$subfolder.'menu.js', array('jquery'), '', true );
    wp_enqueue_script( 'myarcadetheme-ajax', get_template_directory_uri() . '/js/'.$subfolder.'ajax.js', array('jquery'), '', true );
    $localize_script = 'ajax';
  }
  else {
    // Include general theme JS
    // This JS file combines chkbox.js, slctbx.js, botmod.js, menu.js, ajax.js
    wp_enqueue_script( 'myarcadetheme-general', get_template_directory_uri() . '/js/general.js', array('jquery'), '', true );
    wp_script_add_data( 'myarcadetheme-general', 'async', true );
    $localize_script = 'general';

  }

  if ( strpos( myarcadetheme_get_option( 'box_design' ), 'friv' ) !== false && myarcadetheme_get_option( 'promo_banner' ) ) {
    $friv_banner = true;
  }
  else {
    $friv_banner = false;
  }

  wp_localize_script( 'myarcadetheme-'.$localize_script, 'MtAjax', array(
    'ajaxurl' => admin_url( 'admin-ajax.php' ),
    'loading' => __('Loading...', 'myarcadetheme'),
    'login' => __('LOGIN', 'myarcadetheme'),
    'register' => __('Signup', 'myarcadetheme'),
    'friv_banner' => $friv_banner,
    'nonce' => wp_create_nonce( 'myarcadetheme-promotedgames-nonce' ),
  ));

  // Enqueue BxSlider (in footer) if
  // - any of our sliders is enabled
  // - the newsticker is active
  // - a widget that uses the bxslider lib is active
  if ( myarcadetheme_get_option( 'slider_home' )
     || myarcadetheme_get_option( 'slider_header' )
     || myarcadetheme_get_option( 'slider_news' )
     || is_active_widget( false, false, 'mabp_most_popular' )
     || is_active_widget( false, false, 'mabp_recent_games' ) )
  {
    wp_enqueue_script( 'myarcadetheme-bxslider' , get_template_directory_uri() . '/js/bxsldr.min.js', array('jquery'), '', true );
    wp_script_add_data( 'myarcadetheme-bxslider', 'async', true );
  }

  if ( myarcadetheme_get_option( 'lazy_load', 1 ) ) {
    wp_enqueue_script( 'myarcadetheme-lazy-load', get_template_directory_uri() . '/js/echo.min.js', array('jquery'), '', true );
    wp_script_add_data( 'myarcadetheme-lazy-load', 'async', true );
  }

  if ( myarcadetheme_get_option( 'sticky_sidebar', 1 ) && ! wp_is_mobile() ) {
    wp_enqueue_script( 'myarcadetheme-sticky-sidebar', get_template_directory_uri() . '/js/sticky-sidebar.js', array('jquery'), '', true );
    wp_script_add_data( 'myarcadetheme-sticky-sidebar', 'async', true );
  }

  if ( myarcadetheme_get_option( 'smooth_scroll', 1 ) && ! wp_is_mobile() ) {
    wp_enqueue_script( 'myarcadetheme-nice-scroll', get_template_directory_uri() . '/js/lib/jquery.nicescroll.js', array('jquery'), '', true );
    wp_script_add_data( 'myarcadetheme-nice-scroll', 'async', true );
  }

  // Include on single game view
  if ( is_single() && function_exists('is_game') && is_game() ) {
    // Handle favorites
    if ( function_exists('wpfp_link') ) {
      $myvars = array(
        'txt_remove' => wpfp_get_option('remove_favorite'),
        'txt_add' => wpfp_get_option('add_favorite')
        );
      wp_enqueue_script( 'myarcadetheme-favorite', get_template_directory_uri() . '/js/fav.js', array('jquery'), '', true );
      wp_script_add_data( 'myarcadetheme-favorite', 'async', true );
      wp_localize_script( 'myarcadetheme-favorite', 'MtFav', $myvars );
    }

    // Lights on/off
    wp_enqueue_script( 'myarcadetheme-lights', get_template_directory_uri() . '/js/'.$subfolder.'lights.js', array('jquery'), '', true );
    wp_script_add_data( 'myarcadetheme-lights', 'async', true );
    // Game resize
    wp_enqueue_script( 'myarcadetheme-resize', get_template_directory_uri() . '/js/'.$subfolder.'resize.js', array(), '', true );
    wp_script_add_data( 'myarcadetheme-resize', 'async', true );

    if ( ! function_exists('jqlb_init') ){
    // Featherlight JS
    wp_enqueue_script('myarcadetheme-featherlight', get_template_directory_uri() . '/js/lib/featherlight.min.js', array('jquery'), '', true );
    wp_script_add_data( 'myarcadetheme-featherlight', 'async', true );
    //Featherlight Gallery JS
    wp_enqueue_script('myarcadetheme-featherlight-gallery', get_template_directory_uri() . '/js/lib/featherlight.gallery.min.js', array('jquery'), '', true );
    wp_script_add_data( 'myarcadetheme-featherlight-gallery', 'async', true );
    }
  }

  // Enqueue this only on category pages
  if ( is_category() || is_tag() ) {
    $myvars = array(
      'ajaxurl' => admin_url( 'admin-ajax.php' ),
      'loading' => __('Loading...', 'myarcadetheme'),
      'nonce'   => wp_create_nonce( 'mt-nonce' ),
      'file'    => get_template_directory_uri() . '/js/'.$subfolder.'cat'.$suffix.'.js'
    );
    wp_enqueue_script( 'myarcadetheme-cat', get_template_directory_uri() . '/js/'.$subfolder.'cat'.$suffix.'.js', array('jquery'), '', true );
    wp_script_add_data( 'myarcadetheme-cat', 'async', true );
    wp_localize_script( 'myarcadetheme-cat', 'MtCat', $myvars );
  }

  // Enqueue comments JS
  if ( is_singular() && comments_open() && get_option('thread_comments') ) {
    wp_enqueue_script( 'comment-reply' );
  }
}
add_action( 'wp_enqueue_scripts', 'myarcadetheme_scripts' );

/**
 * Enqueue styles
 *
 * @version 1.0.0
 * @since   1.0.0
 * @return  void
 */
function myarcadetheme_styles() {

  wp_enqueue_style( 'myarcadetheme-style', get_stylesheet_uri() );

  wp_register_style('mt-fa', get_template_directory_uri() . '/css/fa.css');
  wp_enqueue_style( 'mt-fa');

  $subset = '&subset=' . myarcadetheme_get_option( 'character_set', 'latin' );
  wp_register_style('mt-opensans', '//fonts.googleapis.com/css?display=swap&family=Open+Sans:300italic,400italic,700italic,400,300,700'.$subset);
  wp_enqueue_style( 'mt-opensans');

  if (defined('BP_VERSION')) {
    wp_register_style('mt-BuddyPressIntegration', get_template_directory_uri() . '/css/buddypress.css');
    wp_enqueue_style( 'mt-BuddyPressIntegration');
  }

  if ( is_single() && function_exists('is_game') && is_game() && ! function_exists('jqlb_init') ) {
    wp_register_style('mt-featherlight', get_template_directory_uri() . '/css/featherlight.min.css');
    wp_enqueue_style( 'mt-featherlight');

    wp_register_style('mt-featherlight-gallery', get_template_directory_uri() . '/css/featherlight.gallery.min.css');
    wp_enqueue_style( 'mt-featherlight-gallery');
  }
}
add_action( 'wp_enqueue_scripts', 'myarcadetheme_styles' );

/**
 * Filter posts per page option
 *
 * @version 1.0.0
 * @since   1.0.0
 * @access  public
 * @return  int   Number of posts that should be displayed.
 */
function myarcadetheme_posts_per_page( $posts_per_page ) {
  if ( is_front_page() || is_home() ) {
    if ( strpos( myarcadetheme_get_option( 'box_design' ), 'friv' ) !== false ) {
      return myarcadetheme_get_option( 'posts_per_page_home', 30 );
    }
  }

  elseif ( is_tag() ) {
    return myarcadetheme_get_option( 'posts_per_tag_page', 10);
  }

  elseif ( is_search() ) {
    return myarcadetheme_get_option( 'posts_per_search_page', 10);
  }

  return myarcadetheme_get_option( 'posts_per_page', 10 );
}
add_filter( 'option_posts_per_page','myarcadetheme_posts_per_page' );

/**
 * Filter number of games per tag cloud
 *
 * @version 5.2.0
 * @since   5.2.0
 * @access  public
 * @return  int   Number of posts that should be displayed.
 */
function tag_widget_limit($args) {
  //Check if taxonomy option inside widget is set to tags
  if(isset($args['taxonomy']) && $args['taxonomy'] == 'post_tag'){
    $args['number'] = myarcadetheme_get_option( 'posts_per_tag_cloud', 25);
  }

  //Check if taxonomy option inside widget is set to category
  if(isset($args['taxonomy']) && $args['taxonomy'] == 'category'){
    $args['number'] = myarcadetheme_get_option( 'posts_per_category_cloud', 25);
  }

  return $args;
}
add_filter('widget_tag_cloud_args', 'tag_widget_limit');

/**
 * Add a custom header code
 *
 * @version 1.0.0
 * @since   1.0.0
 * @access  public
 * @return  void
 */
function myarcadetheme_header() {
  global $wp_query;

  $play_endpoint = myarcadetheme_get_option( 'game_play_permalink_endpoint', 'play' );

 if ( myarcadetheme_get_option( 'pregame-page', 1 ) && myarcadetheme_get_option( 'stop_indexing' ) && is_single() && $play_endpoint && isset( $wp_query->query_vars[$play_endpoint] ) ) {
    echo '<meta name="robots" content="noindex,nofollow">' . "\n";
  }

  if ( myarcadetheme_get_option( 'custom_header_code' ) ) {
    echo stripslashes( myarcadetheme_get_option( 'custom_header_code' ) ) . "\n";
  }

  $favicon = myarcadetheme_get_option( 'favicon' );

  if ( ! empty( $favicon['url'] ) ) {
    echo"<link rel=\"shortcut icon\" type=\"image/x-icon\" href=\"".$favicon['url']."\">"."\n";
  }

  // Print game schema
  myarcade_schema();
}
add_action( 'wp_head', 'myarcadetheme_header' );

/**
 * Display a custom footer code
 *
 * @version 1.0.0
 * @since   1.0.0
 * @access  public
 * @return  void
 */
function myarcadetheme_footer() {
  echo stripslashes( myarcadetheme_get_option( 'custom_footer_code' ) ) . "\n";
}
add_action('wp_footer', 'myarcadetheme_footer');

/**
 * Get game ratings
 *
 * @version 1.0.0
 * @param   integer $new_user    [description]
 * @param   integer $new_score   [description]
 * @param   integer $new_average [description]
 * @return  [type]               [description]
 */
function myarcadetheme_ratings( $new_user = 0, $new_score = 0, $new_average = 0 ) {
  global $post;

  if ( ! function_exists( 'the_ratings' ) || ! function_exists( 'expand_ratings_template' ) || empty( $post->ID ) ) {
    return false;
  }

  if ( $new_user == 0 && $new_score == 0 && $new_average == 0 ) {
    $post_ratings_data = null;
  }
  else {
    $post_ratings_data = new stdClass();
    $post_ratings_data->ratings_users = $new_user;
    $post_ratings_data->ratings_score = $new_score;
    $post_ratings_data->ratings_average = $new_average;
  }

  // Return Post Ratings Template
  echo expand_ratings_template( '%RATINGS_IMAGES%', $post->ID, $post_ratings_data );
}

/**
 * Display post views
 *
 * @version 1.0.0
 * @since   1.0.0
 * @return  void
 */
function myarcadetheme_views() {
  if ( function_exists('the_views') ) {
    $views = intval( get_post_meta( get_the_ID(), 'views', true ) );
    echo '<span class="gm-play fa-gamepad">' . myarcade_format_number( $views ) . '</span>';
  }
}

/**
 * Display Ratings and Play count
 *
 * @version 1.0.0
 * @since   1.0.0
 * @return  void
 */
function myarcadetheme_rate_and_view() {
  if ( ! function_exists( 'the_views' ) && ! function_exists( 'the_ratings' ) ) {
    return;
  }

  ?>
  <div class="gm-vpcn">
    <div class="gm-vote">
      <div class="post-ratings">
        <?php myarcadetheme_ratings(); ?>
      </div>
    </div>

    <?php myarcadetheme_views(); ?>
  </div>
  <?php
}

/**
 * Retrieve the archive title based on the queried object.
 * Based on WordPress 4.2 get_the_archive_title function
 *
 * @version 1.0.0
 * @since   1.0.0
 * @return  void
 */
function myarcadetheme_archive_title() {
  if ( is_category() ) {
    $title = single_cat_title( '', false );
  } elseif ( is_tag() ) {
    $title = sprintf( __( 'Tag: %s', 'myarcadetheme' ), single_tag_title( '', false ) );
  } elseif ( is_author() ) {
    $title = sprintf( __( 'Author: %s', 'myarcadetheme' ), '<span class="vcard">' . get_the_author() . '</span>' );
  } elseif ( is_year() ) {
    $title = sprintf( __( 'Year: %s', 'myarcadetheme' ), get_the_date( _x( 'Y', 'yearly archives date format', 'myarcadetheme' ) ) );
  } elseif ( is_month() ) {
    $title = sprintf( __( 'Month: %s', 'myarcadetheme' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'myarcadetheme' ) ) );
  } elseif ( is_day() ) {
    $title = sprintf( __( 'Day: %s', 'myarcadetheme' ), get_the_date( _x( 'F j, Y', 'daily archives date format', 'myarcadetheme' ) ) );
  } elseif ( is_post_type_archive() ) {
    $title = sprintf( __( 'Archives: %s', 'myarcadetheme' ), post_type_archive_title( '', false ) );
  } elseif ( is_tax() ) {
    $tax = get_taxonomy( get_queried_object()->taxonomy );
    /* translators: 1: Taxonomy singular name, 2: Current taxonomy term */
    $title = sprintf( __( '%1$s: %2$s', 'myarcadetheme' ), $tax->labels->singular_name, single_term_title( '', false ) );
  } else {
    $title = __( 'Archives', 'myarcadetheme' );
  }

  echo $title;
}

/**
 * Generate output for the post navigation
 *
 * @version 1.0.0
 * @since   1.0.0
 * @return  void
 */
function myarcadetheme_navigation() {

  if ( function_exists( 'wp_pagenavi' ) ) {
    wp_pagenavi();
  }
  else {
    ?>
    <div class="post-nav clearfix">
      <p id="previous"><?php next_posts_link(__( "Older games &laquo;", "myarcadetheme" ) ); ?></p>
      <p id="next-post"><?php previous_posts_link(__( "&raquo; Newer games", "myarcadetheme" ) ); ?></p>
    </div>
    <?php
  }
}

/**
 * Get mobile query tag is the site is access by a mobile device
 *
 * @version 1.0.0
 * @since   1.0.0
 * @return  [type] [description]
 */
function myarcadetheme_mobile_tag() {
  return false;
}

/**
 * [myarcadetheme_chop_text description]
 *
 * @version 1.0.0
 * @since   1.0.0
 * @param   string  $html
 * @param   integer $length
 * @param   boolean $strip
 * @return  string
 */
function myarcadetheme_chop_text($html, $length = 180, $strip=true) {

  if ($strip==true) { $html=strip_shortcodes($html); }

  if ((mb_strlen($html) > $length)) {
    $pos_space = mb_strpos($html, ' ', $length) - 1;
    if ($pos_space > 0) {
      $characters = count_chars(mb_substr($html, 0, ($pos_space + 1)), 1);
      if (isset($characters[ord('<')]) > isset($characters[ord('>')])) {
        $pos_espacios = mb_strpos($html, ">", $pos_space) - 1;
      }
      $html = mb_substr($html, 0, ($pos_space + 1)).'...';
    }
  }

  preg_match_all('#<([a-z]+)(?: .*)?(?<![/|/ ])>#iU', $html, $result);

  $openedtags = $result[1];

  preg_match_all('#</([a-z]+)>#iU', $html, $result);

  $closedtags = $result[1];

  $len_opened = count($openedtags);

  if (count($closedtags) == $len_opened) {
    return $html;
  }

  $openedtags = array_reverse($openedtags);

  $openedtags = array_diff($openedtags, array("img", "hr", "br"));

  for ($i=0; $i < $len_opened; $i++) {

    if (!in_array($openedtags[$i], $closedtags)) {
      $html .= '</'.$openedtags[$i].'>';
    } else {
      unset($closedtags[array_search($openedtags[$i], $closedtags)]);
    }

  }

  return $html;
}

/**
 * Display the default menu
 *
 * @version 1.0.0
 * @since   1.0.0
 * @return  void
 */
function myarcadetheme_default_menu() {
  wp_list_categories('sort_column=name&title_li=&depth=1&number=5');
}

/**
 * [myarcadetheme_get_best_players description]
 *
 * @version 1.0.0
 * @since   1.0.0
 * @param   integer $count [description]
 * @return  [type]         [description]
 */
function myarcadetheme_get_best_players( $count = 5 ) {
  global $wpdb;

  return $wpdb->get_results("SELECT h.user_id, COUNT(*) as highscores, u.plays as plays
   FROM ".MYARCADE_HIGHSCORES_TABLE." AS h
   INNER JOIN ".MYARCADE_USER_TABLE." AS u ON h.user_id=u.user_id
   GROUP BY h.user_id
   ORDER BY highscores DESC LIMIT ".$count
  );
}

/**
 * Exclude blog from query
 *
 * @version 1.0.0
 * @since   1.0.0
 * @return  string Category list
 */
function myarcadetheme_exclude_blog() {
  $result = '';

  $blog_cat_id = myarcadetheme_get_option('blogcat');

  if ( ! empty( $blog_cat_id ) ) {
    $result = '&category__not_in=' . $blog_cat_id;
  }

  return $result;
}

/**
 * Get excluded categories from the front page.
 *
 * @version 1.0.0
 * @since   1.0.0
 * @access  public
 * @return  string
 */
function myarcadetheme_get_exclude_categories() {
  $result = '&exclude=';
  $blog_cat_id = myarcadetheme_get_option('blogcat');

  if ( ! empty( $blog_cat_id ) ) {
    $result = '&exclude=' . $blog_cat_id . ',';
  }

  $excluded_categories = myarcadetheme_get_option('excludecat');
  if ( !empty( $excluded_categories ) ) {
    $result .=  implode(',', myarcadetheme_get_option('excludecat') );
  }

  return $result;
}

/**
 * Return stripped post content. Images will be removed.
 *
 * @return  string Stripped post content
 */
function myarcadetheme_content() {
  $content = get_the_content();
  return $content;
}

/**
 * Generate play permalink
 *
 * @version 1.0.0
 * @since   1.0.0
 * @return  void
 */
function myarcadetheme_play_link() {
  ?>
  <a href="<?php echo trailingslashit( get_permalink() . myarcadetheme_get_option( 'game_play_permalink_endpoint', 'play' ) ); ?>" title="<?php printf( __('PLAY NOW: %s', 'myarcadetheme'), get_the_title()); ?>" rel="bookmark nofollow" class="botn"><?php _e("PLAY NOW!", 'myarcadetheme'); ?></a>
  <?php
}

/**
 * Generate the breadcrump
 *
 * @version 1.0.0
 * @since   1.0.0
 * @return  void
 */
function myarcadetheme_breadcrumb() {

  // Don't display breadcrumb on the front page
  if ( is_home() || is_front_page() ) {
    return;
  }

  if ( is_single() ) {
    $path = get_the_category_list( ', ', '', get_the_ID() ) . ' <span>/</span> <strong>' . get_the_title( get_the_ID() ) . '</strong>';
  }
  elseif ( is_page() ) {
    $path = '<strong>' . get_the_title( get_the_ID() ) . '</strong>';
  }
  elseif ( is_search() ) {
    $path = '<strong>' . get_search_query() . '</strong>';
  }
  elseif ( is_category() ) {
    $path = '<strong>' . single_cat_title( "", false ) . '</strong>';
  }
  elseif ( is_tag() ) {
    $path = '<strong>' . single_tag_title( "", false ) . '</strong>';
  }
  else {
    $path = '<strong>' . wp_title( "", false, "right" ) . '</strong>';
  }

  ?>
  <nav class="navtop">
    <a title="<?php _e('Home', 'myarcadetheme'); ?>" href="<?php echo home_url('/'); ?>" class="fa-home">
      <?php _e('Home', 'myarcadetheme'); ?>
    </a> <span>/</span> <?php echo $path; ?>
  </nav>
  <?php
}

/**
 * Callback function for list comments
 *
 * @version 1.0.0
 * @since   1.0.0
 * @param   obj $comment Comment
 * @param   array  $args
 * @param   int    $depth
 * @return  void
 */
function myarcadetheme_comment( $comment, $args, $depth ) {
  $GLOBALS['comment'] = $comment;
  switch ( $comment->comment_type ) :
    case 'pingback'  :
    case 'trackback' :
      ?>
      <li class="pingback">
        <p><?php _e( 'Pingback:', 'myarcadetheme'); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'myarcadetheme'), ' ' ); ?></p>
      </li>
      <?php
    break;

    default :
      ob_start();
      ?>
      <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
        <div class="cmnt-cn" id="comment-<?php comment_ID(); ?>">
          <figure><?php echo get_avatar( $comment, 70); ?></figure>
          <div>
            <div><?php echo get_comment_author_link(); ?> <time><?php echo get_comment_date('d'); ?> <?php echo get_comment_date('M'); ?> , <?php echo get_comment_date('Y'); ?></time></div>
            <?php if ( $comment->comment_approved == '0' ) : ?>
              <em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'myarcadetheme' ); ?></em>
              <br />
            <?php endif; ?>
            <p><?php comment_text(); ?></p>
            <?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
          </div>
        </div>
      </li>
      <?php
      ob_get_flush();
    break;
  endswitch;
}

/**
 * Display favorite posts
 *
 * @version 1.0.0
 * @since   1.0.0
 * @return  string
 */
function myarcadetheme_favorite() {
  global $post, $action;

  // Works only when WP Favorite Post is active
  if ( function_exists('wpfp_link') ) {
    if ($action == "remove") {
      $str = myarcadetheme_favorite_link($post->ID, wpfp_get_option('remove_favorite'), "remove");
    } elseif ($action == "add") {
      $str = myarcadetheme_favorite_link($post->ID, wpfp_get_option('add_favorite'), "add");
    } elseif (wpfp_check_favorited($post->ID)) {
      $str = myarcadetheme_favorite_link($post->ID, wpfp_get_option('remove_favorite'), "remove");
    } else {
      $str = myarcadetheme_favorite_link($post->ID, wpfp_get_option('add_favorite'), "add");
    }
    echo $str;
  }
}

/**
 * Generate favorite posts link
 *
 * @version 1.0.0
 * @since   1.0.0
 * @param   int $post_id    Post ID
 * @param   string $opt     Displayed text
 * @param   string $action  remove/add
 * @return  string
 */
function myarcadetheme_favorite_link($post_id, $opt, $action) {

  $link = '<li data-id="'.$post_id.'" data-type="'.$action.'" id="lnkfav" data-tremove="'.wpfp_get_option('remove_favorite').'" data-tadd="'.wpfp_get_option('add_favorite').'"><span class="wpfp-span">' . wpfp_loading_img();

  if ( $action=='remove' ) {
    $link.='<a data-id="'.$post_id.'" data-type="'.$action.'" data-tp="1" data-tooltip="tooltip" data-placement="right" class="wpfp-link wpfp-linkmt ictxt fa-times-circle mtfav-'.$action.'" href="?wpfpaction='.$action.'&amp;postid='.$post_id.'" title="'.$opt.'" rel="nofollow">&#xf057;</a>';
  }
  else {
    $link.='<a data-id="'.$post_id.'" data-type="'.$action.'" data-tp="1" data-tooltip="tooltip" data-placement="right" class="wpfp-link wpfp-linkmt ictxt fa-heart mtfav-'.$action.'" href="?wpfpaction='.$action.'&amp;postid='.$post_id.'" title="'.$opt.'" rel="nofollow">&#xf004;</a>';
  }

  $link.='</span></li>';

  return apply_filters( 'wpfp_link_html', $link );
}

/**
 * Display related games
 *
 * @version 1.0.0
 * @since   1.0.0
 * @return  void
 */
function myarcadetheme_related() {
  ?>
  <div class="blk-cn">
    <div class="titl"><?php _e( 'RELATED GAMES', 'myarcadetheme' ); ?></div>

    <?php
    if ( function_exists( 'related_entries' ) ) {
      related_entries();
    }
    else {
      get_template_part( "partials/game", "related" );
    }
    ?>
  </div>
  <?php
}

/**
 * Get the heading to the top bar
 *
 * @version 1.0.0
 * @since   1.0.0
 * @param   [type] $class [description]
 * @return  [type]        [description]
 */
function myarcadetheme_top_heading() {

  if ( is_home() || is_front_page() ) {
    $title = get_bloginfo("description");
  }
  elseif ( is_single() || is_page() ) {
    $title = get_the_title( get_the_ID() );
  }
  elseif ( is_search() ) {
    $title = get_search_query();
  }
  elseif ( is_category() ) {
    $title = single_cat_title( "", false );
  }
  elseif ( is_tag() ) {
    $title = single_tag_title( "", false );
  }
  else {
    $title = wp_title( "", false, "right" );
  }

  echo '<div class="fa-gamepad">' . $title . '</div>';
}

/**
 * Handle random game clicks
 *
 * @version 1.0.0
 * @since   1.0.0
 * @return  string
 */
function myarcadetheme_random_game() {
  // Proceed only if random game option is enabled and if a random game has been requested
  if ( myarcadetheme_get_option( 'randomgame' ) && filter_input( INPUT_GET, 'randomgame' ) ) {
    $random = new WP_Query( 'posts_per_page=1&no_found_rows=1&orderby=rand' . myarcadetheme_exclude_blog() );

    if ( $random->have_posts() ) {
      while ($random->have_posts()) : $random->the_post();
        $url = get_permalink();
      endwhile;

      // Restore original Post Data
      wp_reset_postdata();
      ?>
      <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
      <html xmlns="http://www.w3.org/1999/xhtml">
      <head>
      <meta http-equiv="Refresh" content="0; url=<?php echo $url; ?>">
      </head>
      <body>
      </body>
      </html>
      <?php
      die();
    }
  }
}
add_action( 'init', 'myarcadetheme_random_game' );

/**
 * Filter search query if mobile games function has been enabled
 *
 * @version 5.2.1
 * @since   3.0.0
 * @param   object $query
 * @return  void
 */
function myarcadetheme_pre_get_posts( $query ) {
  // Proceed only if main query and not on admin
  if ( ! is_admin() && $query->is_main_query() ) {

    // Handle order on the category page
    if ( is_category() || is_tag() ) {
      $order = filter_input( INPUT_COOKIE, 'ordercat', FILTER_VALIDATE_INT, array( "options" => array( "default" => myarcadetheme_get_option('archive_order', 1 ) ) ) );
      $orders_string = myarcadetheme_get_order( $order );
      $order_array = array();
      parse_str( $orders_string, $order_array );
      foreach ( $order_array as $key => $value ) {
        $query->set( $key, $value );
      }
    }
  }
}
add_action( 'pre_get_posts', 'myarcadetheme_pre_get_posts', 9 );

/**
 * Return an array with order args
 *
 * @version 1.0.0
 * @since   3.0.0
 * @param   int $order_nr Submitted order number
 * @return  string Order query string
 */
function myarcadetheme_get_order( $order_nr = 1 ) {

  $orders = array(
    '',
    '&orderby=date&order=desc',
    '&orderby=date&order=asc',
    '&r_sortby=highest_rated&r_orderby=desc',
    '&v_sortby=views&v_orderby=desc',
    '&orderby=comment_count',
    '&orderby=title&order=asc',
    '&orderby=title&order=desc',
  );

  if ( intval($order_nr) >= count( $orders ) ) {
    $order_nr = 1;
  }

  return $orders[ intval($order_nr) ];
}

/**
 * Remove query strings from static resources
 *
 * @version 1.0.0
 * @since   1.0.0
 * @return  string Cleaned script URL
 */
function myarcadetheme_script_version( $src ){
  $parts = explode( '?ver', $src );
  return $parts[0];
}
if ( ! is_admin() ) {
  add_filter( 'script_loader_src', 'myarcadetheme_script_version', 15, 1 );
  add_filter( 'style_loader_src', 'myarcadetheme_script_version', 15, 1 );
}

/**
 * Generate game manage buttons - only for admins
 *
 * @version 1.0.1
 * @since   1.0.1
 * @return  void
 */
function myarcadetheme_admin_links() {
  global $post;

  if ( current_user_can('delete_posts') ) {
    // Show edit and delete links
    ob_start();
    ?>
    <div class="admin_actions">
      <a class="botn" href="<?php echo get_delete_post_link(); ?>">
        <?php _e("Delete Post", 'myarcadetheme'); ?>
      </a>&nbsp;
      <a class="botn" href="<?php echo get_edit_post_link(); ?>"><?php _e("Edit Post", 'myarcadetheme'); ?></a>
    </div>
    <?php
    ob_end_flush();
  }
}

/**
 * Reorder comment fields
 *
 * @version 3.0.0
 * @since   3.0.0
 * @access  public
 * @param   array $fields
 * @return  array
 */
function myarcadetheme_comment_form_order( $fields ) {
  $new_order['author'] = $fields['author'];
  $new_order['email'] = $fields['email'];
  $new_order['url'] = $fields['url'];
  $new_order['comment'] = $fields['comment'];

  return $new_order;
}
add_filter( 'comment_form_fields', 'myarcadetheme_comment_form_order' );

/**
 *
 * Adds JSON LD MarkUp
 *
 * @version 4.1.0
 * @since   4.0.0
 * @return  void
 */
function myarcade_schema() {

  // Skip if we are not on the single page
  if ( ! is_singular('post') ) {
    return;
  }

  if ( function_exists( 'is_game' ) && is_game() ) {
    if ( ! function_exists( 'the_ratings' ) || ! get_post_meta( get_the_ID(), 'ratings_users', true ) ) {
      // Skip if WP-PostRatings isn't installed
      return;
    }

    $category = get_the_category();
    ?>
    <script type="application/ld+json">
    {
      "@context": "http://schema.org/",
      "type": "VideoGame",
      "aggregateRating": {
        "type": "aggregateRating",
        "ratingValue": "<?php echo get_post_meta( get_the_ID(), 'ratings_average', true ); ?>",
        "reviewCount": "<?php echo get_post_meta( get_the_ID(), 'ratings_users', true ); ?>",
        "bestRating": "5",
        "worstRating": "0"
      },
      "applicationCategory": "Game",
      "description": "<?php myarcade_excerpt(490); ?>",
      "genre": "<?php echo $category[0]->cat_name;?>",
      "image": "<?php echo myarcade_thumbnail_url(); ?>",
      "name": "<?php myarcade_title(); ?>",
      "operatingSystem": "Web Browser",
      "url": "<?php the_permalink(); ?>"
    }
    </script>
    <?php
  }
  else {
    // Regular blog post/page
    $logo = myarcadetheme_get_option( 'logohd' );
    if ( empty( $logo['url'] ) ) {
      $logo['url'] = get_template_directory_uri() .' /images/my-arcade-theme.png';
    }
    ?>
    <script type="application/ld+json">
    {
      "@context": "http://schema.org",
      "@type": "Article",
      "headline": "<?php the_title(); ?>",
      "author": {
          "@type": "Person",
          "name": "<?php the_author(); ?>"
      },
      "datePublished": "<?php the_date('Y-n-j'); ?>",
      "dateModified": "<?php the_modified_date('Y-n-j'); ?>",
      "url": "<?php the_permalink(); ?>",
      "image": "<?php echo wp_get_attachment_url( get_post_thumbnail_id() ); ?>",
      "description": "<?php the_excerpt(); ?>",

      "publisher": {
          "@type": "Organization",
          "name": "<?php bloginfo( 'name' ); ?>",
          "logo":" <?php echo $logo['url']; ?>"
      },

      "mainEntityOfPage":{
        "@type":"WebPage",
        "url": "<?php the_permalink(); ?>"
      }
    }
    </script>
    <?php
  }
}

/**
 * Shows the category description box
 *
 * @version 5.4.0
 * @since   4.1.0
 * @return  void
 */
function myarcadetheme_archive_description() {
  if ( is_category() ) {
    $prefix = "cat";
    $description = category_description();
  }
  else if (is_category( myarcadetheme_get_option('blogcat') ) || is_page_template('template-blog.php') ) {
    $prefix = "blogcat";
    $description = category_description();
  }
  else {
    $prefix = "tag";
    $description = tag_description();
  }

  if ( myarcadetheme_get_option( $prefix . '_desc' ) ) {
    if ( $description ) : ?>
      <div class="description">
        <?php if ( myarcadetheme_get_option( $prefix . '_desc_expand' ) ) : ?>
          <div class="collapsed">
        <?php endif; ?>
        <?php echo $description; ?>

        <?php if ( myarcadetheme_get_option( $prefix . '_desc_expand' ) ) : ?>
          </div>
          <div class="description-trigger-button">
            <span class="trigger-icon fa-angle-down"></span>
            <span class="trigger-icon fa-angle-up hide"></span>
          </div>
        <?php endif; ?>
      </div>
      <?php
    endif;
  }
}

/**
 * Adds Schema.org Markup To WordPress Navigation
 *
 * @version 4.3.0
 * @since   4.3.0
 * @return  void
 */
function myarcadetheme_add_menu_atts( $atts, $item, $args ) {
  $atts['itemprop'] = 'url';
  return $atts;
}
add_filter( 'nav_menu_link_attributes', 'myarcadetheme_add_menu_atts', 10, 3 );

/**
 * Retrieve the URL of the current page.
 * Used for redirects after user login
 *
 * @return  string
 */
function myarcadetheme_get_current_url() {
  return set_url_scheme( 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] );
}

/**
 * Get sidebars
 *
 * @return void
 */
function myarcadetheme_sidebar() {

  $sidebar = 'others';

  if ( is_single() ) {
    $sidebar = 'single';
  }
  elseif ( is_page() ) {
    $sidebar = 'page';
  }
  elseif ( is_category() ) {
    $sidebar = 'category';
  }

  if ( is_active_sidebar( "{$sidebar}-sidebar" ) ) {
    dynamic_sidebar( "{$sidebar}-sidebar" );
  }
  else {
    // Handle home sidebar separately
    if ( 'others' == $sidebar ) {
      the_widget('WP_Widget_MABP_User_Login', 'title='.__('User Panel', 'myarcadetheme').'', 'before_title=<div class="titl">&after_title=</div>&before_widget=<div id="mabp_user_login" class="blk-cn widget_mabp_user_login">&after_widget=</div>');

      the_widget('WP_Widget_MABP_Recent_Games', 'title='.__('Recent Games', 'myarcadetheme').'&limit=12', 'before_title=<div class="titl">&after_title=</div>&before_widget=<div id="mabp_recent_games" class="blk-cn widget_mabp_recent_games">&after_widget=</div>');

      the_widget('WP_Widget_MABP_Random_Games', 'title='.__('Featured Games', 'myarcadetheme').'&limit=12&wcategory=0', 'before_title=<div class="titl">&after_title=</div>&before_widget=<div id="mabp_random_games" class="blk-cn widget_mabp_random_games">&after_widget=</div>');
    }
    else {
      myarcadetheme_no_widget_message( $sidebar );
    }
  }
}

/**
 * Display a warning if sidebar is without any widgets.
 *
 * @access public
 * @param  string $sidebar
 * @return void
 */
function myarcadetheme_no_widget_message( $sidebar = '' ) {

  // Display the message only for administrators
  if ( ! current_user_can( 'manage_options' ) ) {
    return;
  }
  ?>
  <div class="box sidebar">
    <div class="warning">
      <?php printf( __( 'This is your %s sidebar and no widgets have been placed here, yet!', 'myarcadetheme' ), ucfirst( $sidebar ) ); ?>
      <p><?php printf( __( 'Click %shere%s to setup this this sidebar!', 'myarcadetheme'), '<a href="'.home_url().'/wp-admin/widgets.php">', '</a>' ); ?></p>
    </div>
  </div>
  <?php
}

/**
 * Display comments if they are open or if there is at least one comment.
 *
 */
function myarcadetheme_comments() {
  if ( comments_open() || get_comments_number() ) {
    comments_template();
  }
}

/**
 * Get the layout for a certain page.
 * The layout needs to be built on the theme options page.
 *
 */
function myarcadetheme_get_layout( $page ) {

  if ( 'play_game' == $page ) {
    get_template_part( "partials/game-play", "content" );
    get_template_part( "partials/game", "controls" );
    get_template_part( "partials/game", "video" );
    get_template_part( "partials/game", "screenshots" );
    get_template_part( "partials/game", "embed-box" );
    myarcadetheme_comments();
  }
}

/**
 * Adjust the maximum game width
 *
 * @param float $width
 * @return int
 */
function myrcadetheme_game_width( $width ) {

  $layout = myarcadetheme_get_option( 'game_layout' );

  $template_width = 1120;
  $sidebar = 220;

  switch ( $layout) {
    case '1': {
      // Full width
    } break;

    case '2':
    case '3': {
      // One sidebar
      $template_width = $template_width - $sidebar;
    } break;

    case '4': {
      // Two sidebars
      $template_width = $template_width - 2 * $sidebar;
    } break;
  }

  if ( $width > $template_width ) {
    $width = $template_width;
  }

  return $width;
}
add_filter( 'myarcade_game_width', 'myrcadetheme_game_width' );

/**
 * Adjust the maximum game height dependent on the ratio
 *
 * @param float $height
 * @return float
 */
function myarcadetheme_game_height( $height ) {
  global $post;

  if ( ! isset( $post->ID ) ) {
    return $height;
  }

  $width = get_post_meta( $post->ID, 'mabp_width', true );

  if ( ! $width || ! $height ) {
    return $height;
  }

  $ratio = $width / $height;

  $new_width = myrcadetheme_game_width( $width );

  $height = $new_width / $ratio;

  return $height;
}
add_filter( 'myarcade_game_height', 'myarcadetheme_game_height' );

/**
 * Include the selected header layout
 */
function myarcadetheme_header_layout() {

  $header_layout = 'magazine';
  get_template_part( "partials/header-layout", $header_layout );
}
