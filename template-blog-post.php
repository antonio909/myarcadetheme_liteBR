<?php
/*
* Single Post Template: Blog Post Template
* Template Name: Blog Post
* Template Post Type: post
*/

get_header(); ?>

<div class="cont">

  <?php
  if ( myarcadetheme_get_option( 'single_post_breadcrumbs', 1 )  ) {
    myarcadetheme_breadcrumb();
  }
  ?>

  <div class="cntcls <?php echo 'sidebar_' . myarcadetheme_get_option( 'sidebar_position', 'right' ); ?>">
    <main class="main-cn cols-n9">
      <?php
      if ( have_posts() ) :
        while ( have_posts() ) : the_post(); ?>
          <!--<post>-->
          <article>
            <section class="post-sngl">
              <header>
                <h1><?php the_title(); ?></h1>
                <p>             <span class="gm-cate"><?php echo get_the_category_list(' '); ?></span>
              <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" title="<?php printf( esc_attr__( 'View all posts by %s', 'myarcadetheme' ), get_the_author() ); ?>">
               <span class="fa-user"> <?php the_author(); ?> </span>
              </a>
              <span class="fa-calendar"><?php echo get_the_date('d'); ?> <?php echo get_the_date('M'); ?> , <?php echo get_the_date('Y'); ?></span> <span class="fa-comments"><?php echo number_format_i18n( get_comments_number() ); ?></span></p>
              </header>

              <div class="txcn">
              <?php if ( myarcadetheme_get_option( 'single_post_featured_image', 1 )  ) {
              the_post_thumbnail( 'large', array( 'class' => 'aligncenter' ) );
              } ?>
                <?php the_content(); ?>
              </div>
              <?php
        // Display some manage links if logged in user is an admin
        myarcadetheme_admin_links();
        ?>
            </section>

            <footer>
              <?php echo get_the_tag_list('<p><span class="fa-tag">'.__('Tags:', 'myarcadetheme').' ', ', ','</span></p>'); ?>
              <div class="pst-shre">
                <strong><?php _e('Share:', 'myarcadetheme'); ?></strong>
                <a rel="nofollow" onclick="window.open ('https://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>', 'Facebook', 'toolbar=0, status=0, width=650, height=450');" href="javascript: void(0);" class="fa-facebook"><span><?php _e('Facebook', 'myarcadetheme'); ?></span></a>
                <a rel="nofollow" onclick="window.open ('https://www.twitter.com/share?url=<?php the_permalink(); ?>', 'Twitter', 'toolbar=0, status=0, width=650, height=450');" href="javascript: void(0);" class="fa-twitter"><span><?php _e('Twitter', 'myarcadetheme'); ?></span></a>
                <a rel="nofollow" onclick="window.open ('https://api.addthis.com/oexchange/0.8/forward/pinterest/offer?url=<?php the_permalink(); ?>', 'Pinterest', 'toolbar=0, status=0, width=650, height=450');" href="javascript: void(0);" class="fa-pinterest"></a>
                <a rel="nofollow" onclick="window.open ('https://reddit.com/submit?url=<?php the_permalink(); ?>', 'Reddit', 'toolbar=0, status=0, width=650, height=450');" href="javascript: void(0);" class="fa-reddit"></a>
                <a rel="nofollow" onclick="window.open ('https://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink(); ?>', 'Linkedin', 'toolbar=0, status=0, width=650, height=450');" href="javascript: void(0);" class="fa-linkedin"></a>
                <a rel="nofollow" onclick="window.open ('https://www.addthis.com/bookmark.php?source=bx32nj-1.0&v=300&url=<?php the_permalink(); ?>');" href="javascript: void(0);" class="fa-plus-square"></a>
              </div>
            </footer>
          </article>
          <?php if ( myarcadetheme_get_option( 'single_post_author_box', 1 )  ) { get_template_part( "partials/author-info"); } ?>
          <!--</post>-->
          <?php
        endwhile;

      else :
        // Nothing found
        get_template_part( "partials/content", "none" );
      endif;

      if ( myarcadetheme_get_option( 'single_post_comments', 1 ) ) {
        myarcadetheme_comments();
      }
      ?>
    </main>

    <?php get_sidebar(); ?>
  </div>
</div>
<?php get_footer(); ?>