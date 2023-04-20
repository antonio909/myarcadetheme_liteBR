<?php
/*
List template
This template returns the related posts as a comma-separated list.
Author: Megatemas.com
*/

if ( $related_query->have_posts() ) :
  while ($related_query->have_posts()) : $related_query->the_post(); ?>
    <!--<game>-->
    <div>
      <div class="gmcn-midl">
        <figure class="gm-imag"><a href="<?php the_permalink(); ?>" class="thumb_link" rel="bookmark" title="<?php echo $post->post_title; ?>"><?php myarcade_thumbnail( array( 'width' => 148, 'height' => 148, 'lazy_load' => myarcadetheme_get_option('lazy_load'), 'show_loading' => myarcadetheme_get_option( 'lazy_load_animation' ) ) ); ?></a></figure>
        <div class="gm-text">
          <div class="gm-cate"><?php echo get_the_category_list(' '); ?></div>
          <div class="gm-titl"><a href="<?php the_permalink(); ?>" title="<?php printf( __('Play %s', 'myarcadetheme'), get_the_title()); ?>"><?php the_title(); ?></a></div>

          <?php myarcadetheme_rate_and_view(); ?>
        </div>
      </div>
    </div>
    <!--<game>-->
    <?php
  endwhile;
endif;