<?php if ( ! ( myarcadetheme_get_option( 'mobile_header_news', 0 ) && wp_is_mobile() ) ) : ?>
<?php
if ( myarcadetheme_get_option( 'slider_news' ) ) {
  $categories = myarcadetheme_get_option( 'categories_slidernews' );
  $category_in = '';
  if ( ! empty( $categories ) ) {
    $categories = implode(",", $categories );
    $category_in = 'cat=' . $categories;
  }

  $querynews = new WP_Query( $category_in.myarcadetheme_mobile_tag().'&posts_per_page='.myarcadetheme_get_option( 'sortable_slidernews', 10 ) );

  if ( $querynews->have_posts() ) { ?>
    <div class="hdcn-5">
      <div class="cont">
        <div class="news-cn" style="visibility:hidden">
          <strong class="fa-flash"><?php _e('NEWS', 'myarcadetheme'); ?></strong>
          <ul class="sldr-nw">
            <?php
            $i=1;
            while ($querynews->have_posts()) : $querynews->the_post(); ?>
              <li>
                <strong>
                  <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a> - </strong> <span><?php echo myarcadetheme_chop_text( strip_tags( get_the_excerpt(), '<a>,<strong>'), 120); ?> </span>
              </li>
              <?php $i++; ?>
            <?php endwhile; ?>
          </ul>
        </div>
      </div>
    </div>
    <?php
    wp_reset_postdata();
  }
}
?>
<?php endif; ?>