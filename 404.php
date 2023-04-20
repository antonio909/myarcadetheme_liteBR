<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * @package WordPress
 * @subpackage MyArcadeTheme
 */

get_header(); ?>

<div class="cont">
  <?php myarcadetheme_breadcrumb(); ?>

  <div class="cntcls <?php echo 'sidebar_' . myarcadetheme_get_option( 'sidebar_position', 'right' ); ?>">
    <main class="main-cn cols-n9">
      <div class="titl-404"><?php _e('404', 'myarcadetheme'); ?></div>
      <p><?php _e("Sorry, the page you asked for couldn't be found. Please, try to use the search form below.", 'myarcadetheme'); ?></p>

      <?php get_template_part( "partials/form", "search" ); ?>
    </main>

    <?php get_sidebar(); ?>
  </div>
</div>

<?php get_footer(); ?>