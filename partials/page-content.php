<section class="post-sngl">
  <header>
    <h1><?php the_title(); ?></h1>
  </header>

  <div <?php post_class( 'txcn' ); ?> id="post-<?php the_ID(); ?>">
    <?php the_content(); ?>
    <?php wp_link_pages(); ?>
  </div>
</section>