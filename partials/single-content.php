<div class="cont">

  <?php echo myarcadetheme_breadcrumb(); ?>

  <div class="cntcls <?php echo 'sidebar_' . myarcadetheme_get_option( 'sidebar_position', 'right' ); ?>">
    <main class="main-cn cols-n9">
      <!--<post>-->
      <article>
        <section class="post-sngl">
          <header>
            <h1><?php the_title(); ?></h1>
            <p><span class="gm-cate"><?php echo get_the_category_list(' '); ?></span> <a href="<?php echo get_author_posts_url($post->post_author); ?>"><?php the_author_meta('display_name',$post->post_author); ?></a> <time class="fa-calendar"><?php echo get_the_date('d'); ?> <?php echo get_the_date('M'); ?> , <?php echo get_the_date('Y'); ?></time> <span class="fa-comments"><?php echo number_format_i18n( get_comments_number() ); ?></span></p>
          </header>

          <div class="txcn">
            <?php the_content(); ?>
          </div>
        </section>

        <footer>
          <?php echo get_the_tag_list('<p><span class="fa-tag">'.__('Tags:', 'myarcadetheme').' ', ', ','</span></p>'); ?>

          <div class="pst-shr">
            <a class="fa-share-alt" href="#"><strong><?php _e('SHARE', 'myarcadetheme'); ?></strong></a>
            <ul class="lst-social">
              <li><a rel="nofollow" onclick="window.open ('https://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>', 'Facebook', 'toolbar=0, status=0, width=650, height=450');" href="javascript: void(0);" class="fa-facebook"><span><?php _e('Facebook', 'myarcadetheme'); ?></span></a></li>
              <li><a rel="nofollow" onclick="window.open ('https://www.twitter.com/share?url=<?php the_permalink(); ?>', 'Twitter', 'toolbar=0, status=0, width=650, height=450');" href="javascript: void(0);" class="fa-twitter"><span><?php _e('Twitter', 'myarcadetheme'); ?></span></a></li>
            </ul>
          </div>
        </footer>
      </article>
    </main>

    <?php get_sidebar(); ?>
  </div>
</div>