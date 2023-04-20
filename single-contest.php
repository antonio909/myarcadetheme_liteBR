<?php
/**
 * The Template for displaying all single posts
 *
 * @package WordPress
 * @subpackage MyArcadeTheme
 */

get_header();

if ( have_posts() ) {
  while ( have_posts() ) :
    the_post();
    ?>
    <div class="cont">
      <div class="cntcls <?php echo 'sidebar_' . myarcadetheme_get_option( 'sidebar_position', 'right' ); ?>">
        <main class="main-cn cols-n9">
          <article>
            <section class="post-sngl">
              <header>
                <h1><?php the_title(); ?></h1>
              </header>
              <div class="txcn">
                <?php the_content(); ?>
              </div>
            </section>
          </article>
        </main>

        <?php get_sidebar(); ?>
      </div>
    </div>
    <?php
  endwhile;
}
else {
  // Nothing found
  get_template_part( "partials/content", "none" );
}

// Do some actions before the content wrap ends
do_action('myarcadetheme_before_content_end');
?>

<?php get_footer(); ?>