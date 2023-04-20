 <div class='yarpp-related'>
  <?php
  // Create the query array
  $args = array(
    'category__in' => wp_get_post_categories( get_the_ID() ),
    'posts_per_page' => ( wp_is_mobile() ) ? 6: 10,
    'post__not_in' => array( get_the_ID() ),
  );

  // get the blog cat
  $blog_cat = ( myarcadetheme_get_option('blogcat') ) ? intval( myarcadetheme_get_option('blogcat') ) : false;
  if ( $blog_cat ) {
    $args['category__not_in'] = array( $blog_cat );
  }

  if ( wp_is_mobile() && myarcadetheme_get_option( 'mobile' ) ) {
   $args['tag'] = 'mobile';
  }

  $relatedgames = new WP_Query ( $args );

  if ( $relatedgames->have_posts() ) :
    while ($relatedgames->have_posts()) :
      $relatedgames->the_post();
      ?>
      <div>
        <div class="gmcn-midl">
          <figure class="gm-imag"><a href="<?php the_permalink(); ?>" class="thumb_link" rel="bookmark" title="<?php echo $post->post_title; ?>"><?php myarcade_thumbnail( array( 'width' => 80, 'height' => 80, 'lazy_load' => myarcadetheme_get_option('lazy_load'), 'show_loading' => myarcadetheme_get_option( 'lazy_load_animation' ) ) ); ?></a></figure>
          <div class="gm-text">
            <div class="gm-cate"><?php echo myarcade_category(); ?></div>
            <div class="gm-titl">
              <a href="<?php the_permalink(); ?>" title="<?php printf( __('Play %s', 'myarcadetheme'), get_the_title()); ?>">
               <span> <?php the_title(); ?> </span>
              </a>
            </div>
            <?php myarcadetheme_rate_and_view(); ?>
          </div>
        </div>
      </div>
      <?php
    endwhile;
    wp_reset_postdata();
  else:
    echo "<p style='margin-left:10px'>" . __("No related games found.", "myarcadetheme" ) . "</p>";
  endif;
  ?>
</div>
<div class="related-clfl"></div>