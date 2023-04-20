<?php
/**
 * The template for displaying search results
 *
 * @package WordPress
 * @subpackage MyArcadeTheme
 * @since 1.0.0
 */

get_header();
?>
<div class="cont">
 <?php if ( myarcadetheme_get_option( 'search_breadcrumbs', 1 ) ) { myarcadetheme_breadcrumb(); } ?>
  <div class="cntcls <?php echo 'sidebar_' . myarcadetheme_get_option( 'sidebar_position', 'right' ); ?>">
    <div id="ajaxtag">
      <main class="main-cn cols-n9">
        <?php
        $design = filter_input( INPUT_COOKIE, 'designsearch', FILTER_VALIDATE_INT, array( "options" => array( "default" => myarcadetheme_get_option('search_archive_design', 3 ) ) ) );
        $order = filter_input( INPUT_COOKIE, 'ordersearch', FILTER_VALIDATE_INT, array( "options" => array( "default" => myarcadetheme_get_option('search_archive_order', 1 ) ) ) );

        if ( have_posts() ) {
          ?>
          <div class="titl">
          <div><?php printf( __( 'Search Results for: %s', 'myarcadetheme' ), get_search_query() ); ?></div>
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