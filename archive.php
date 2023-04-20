<?php
/**
 * The template for displaying Archive pages
 *
 * @package WordPress
 * @subpackage MyArcadeTheme
 * @since 1.0.0
 */

get_header();
?>
<div class="cont">
  <?php
  if ( ( is_category() && myarcadetheme_get_option( 'cat_breadcrumbs', 1 ) ) || ( is_tag() && myarcadetheme_get_option( 'tag_breadcrumbs', 1 ) ) ) {
    myarcadetheme_breadcrumb();
  }
  ?>

  <div class="cntcls <?php echo 'sidebar_' . myarcadetheme_get_option( 'sidebar_position', 'right' ); ?>">
    <div id="ajaxcat">
      <main class="main-cn cols-n9">
        <?php
        $design = filter_input( INPUT_COOKIE, 'designcat', FILTER_VALIDATE_INT, array( "options" => array( "default" => myarcadetheme_get_option('archive_design', 3 ) ) ) );
        $order = filter_input( INPUT_COOKIE, 'ordercat', FILTER_VALIDATE_INT, array( "options" => array( "default" => myarcadetheme_get_option('archive_order', 1 ) ) ) );

        if ( have_posts() ) {
          ?>
          <div class="titl">
            <div><?php myarcadetheme_archive_title(); ?></div>

            <?php // Display sort selection on category pages ?>
            <?php if ( is_category() || is_tag() ) : ?>
              <div class="mt-slct-cn game_sorting">
                <label><?php _e("Show:", 'myarcadetheme'); ?></label>
                <select id="mt_design_cat" name="mt_design_cat">
                  <option value="1" <?php selected($design, 1 ); ?>><?php _e('Small', 'myarcadetheme'); ?></option>
                  <option value="2" <?php selected($design, 2 ); ?>><?php _e('Large', 'myarcadetheme'); ?></option>
                  <option value="3" <?php selected($design, 3 ); ?>><?php _e('Grid', 'myarcadetheme'); ?></option>
                  <option value="4" <?php selected($design, 4 ); ?>><?php _e('Half', 'myarcadetheme'); ?></option>
                </select>
              </div>

              <div class="mt-slct-cn game_sorting">
                <label><?php _e("Sort:", 'myarcadetheme'); ?></label>
                <select id="mt_order_cat" name="mt_order_cat">
                  <option value="1" <?php selected($order, 1 ); ?>><?php _e('Newest First', 'myarcadetheme'); ?></option>
                  <option value="2" <?php selected($order, 2 ); ?>><?php _e('Oldest First', 'myarcadetheme'); ?></option>
                  <?php if ( function_exists('the_ratings') ) : ?>
                    <option value="3" <?php selected($order, 3 ); ?>><?php _e('Highest Rated', 'myarcadetheme'); ?></option>
                  <?php endif; ?>
                  <?php if ( function_exists('the_views') ) : ?>
                    <option value="4" <?php selected($order, 4 ); ?>><?php _e('Most Played', 'myarcadetheme'); ?></option>
                  <?php endif; ?>
                  <option value="5" <?php selected($order, 5 ); ?>><?php _e('Most Discussed', 'myarcadetheme'); ?></option>
                  <option value="6" <?php selected($order, 6 ); ?>><?php _e('Alphabetically (A-Z)', 'myarcadetheme'); ?></option>
                  <option value="7" <?php selected($order, 7 ); ?>><?php _e('Alphabetically (Z-A)', 'myarcadetheme'); ?></option>
                </select>
              </div>
              <?php
              myarcadetheme_archive_description();
            endif; ?>
          </div>

          <?php
          $classes = array(
            '',
            'lst-gmct cate-small',
            'lst-gmct cate-large',
            'lst-gams cate-grid',
            'lst-gmct-cntcls-n6'
          );
          ?>
          <ul class="<?php echo $classes[ $design ]; ?>">
            <?php
            while ( have_posts() ) : the_post();
              get_template_part( "partials/archive", "view-" . $design );
            endwhile;
            ?>
          </ul>
          <?php

          myarcadetheme_navigation();
        }
        else {
          // Nothing found
          get_template_part( "partials/content", "none" );
        } ?>
      </main>
    </div>

    <?php get_sidebar(); ?>
  </div>
</div>
<?php get_footer(); ?>