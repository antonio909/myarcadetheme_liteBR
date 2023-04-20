<?php
/*
Template Name: Blog Template
Blog Template: Blog Template
*/

get_header(); ?>

<div class="cont">

  <?php
  if ( myarcadetheme_get_option( 'blog_archive_breadcrumbs', 1 )  ) {
    myarcadetheme_breadcrumb();
  }
  ?>

  <div class="cntcls <?php echo 'sidebar_' . myarcadetheme_get_option( 'sidebar_position', 'right' ); ?>">
    <main class="main-cn cols-n9">
      <article>
        <?php
        if ( have_posts() ) :
          global $query_string;
          query_posts($query_string.'&post_type=post&pagename=&cat='.myarcadetheme_get_option( 'blogcat' ) );

          while ( have_posts() ) : the_post(); ?>
            <div class="titl">
              <div><?php myarcadetheme_archive_title(); ?></div>
              <?php if ( is_category() && myarcadetheme_get_option( 'blogcat_desc', 1 ) ) : ?>
                <?php myarcadetheme_archive_description(); endif; ?>
            </div>

            <section class="post-list">
              <header>
                <h2>
                  <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                    <?php the_title(); ?>
                  </a>
                </h2>

                <p>
                  <span class="gm-cate"><?php echo get_the_category_list(' '); ?></span>
                  <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" title="<?php printf( esc_attr__( 'View all posts by %s', 'myarcadetheme' ), get_the_author() ); ?>">
                    <span itemprop="name"> <?php the_author(); ?> </span>
                  </a>
                  <span class="fa-calendar"><?php echo get_the_date('d'); ?> <?php echo get_the_date('M'); ?> , <?php echo get_the_date('Y'); ?></span> <span class="fa-comments"><?php echo number_format_i18n( get_comments_number() ); ?></span>
                </p>
              </header>

              <div class="txcn">
                <?php if ( has_post_thumbnail() ): ?>
                  <figure>
                    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark">
                      <?php the_post_thumbnail( 'thumbnail' ); ?>
                    </a>
                  </figure>
                <?php endif; ?>

                <p>
                  <span itemprop="text"><?php the_excerpt(); ?></span>
                </p>

                <a itemprop="url" href="<?php the_permalink(); ?>" title="<?php printf( __( "Read more about %s", 'myarcadetheme' ), the_title_attribute( 'echo=0' ) ); ?>" class="read-more"><?php _e('READ MORE', 'myarcadetheme'); ?></a>
              </div>
            </section>
            <?php
          endwhile;

          myarcadetheme_navigation();
        else :
          // Nothing found
          get_template_part( "partials/content", "none" );
        endif;
        ?>
      </article>
    </main>

    <?php get_sidebar(); ?>
  </div>
</div>

<?php get_footer(); ?>