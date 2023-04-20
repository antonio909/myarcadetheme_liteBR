<header class="hdcn" id="header_magazine">
  <?php get_template_part( "partials/header" , "topbar" ); ?>

  <div class="hdcn-2" itemscope="itemscope" itemtype="http://schema.org/WPHeader">
    <div class="cont">
      <div class="logo">
        <a href="<?php echo home_url(); ?>" title="<?php bloginfo('name');?>" itemprop="url">
          <?php
          $logo = myarcadetheme_get_option( 'logohd' );
          if ( empty( $logo['url'] ) ) {
            $logo['url'] = get_template_directory_uri() .' /images/my-arcade-theme.png';
          }
          ?>
          <img src="<?php echo $logo['url']; ?>" alt="<?php bloginfo('blogname'); ?>" title="<?php bloginfo('blogname'); ?>" itemprop="image"/>
        </a>
        <meta itemprop="name" content="<?php bloginfo('blogname'); ?>">
      </div>

      <?php if ( myarcadetheme_get_option( 'header_banner' ) ) : ?>
      <div class="bnr728">
        <?php echo myarcadetheme_get_option( 'header_banner' ); ?>
      </div>
      <?php endif; ?>
    </div>
  </div>

  <div class="hdcn-3">
    <div class="cont">
      <?php
      // Do some actions before the main menu
      do_action('myarcadetheme_before_menu');
      ?>
      <nav class="menu">
        <button class="menu-botn"><span class="fa-bars"><?php _e('Menu', 'myarcadetheme'); ?></span></button>
        <ul>
          <?php wp_nav_menu( array(
            'container' => false,
            'theme_location' => 'primary',
            'items_wrap' => '%3$s',
            'fallback_cb' => 'myarcadetheme_default_menu')
          ); ?>
        </ul>

        <?php if ( myarcadetheme_get_option( 'randomgame' ) ) : ?>
        <a href="<?php echo home_url(); ?>/?randomgame=1" class="rndgame fa-random" title="<?php _e("Play a random game!", 'myarcadetheme' ); ?>">
          <?php _e('RANDOM GAME', 'myarcadetheme'); ?>
        </a>
        <?php endif ?>
      </nav>

      <?php
      // Do some actions after the main menu
      do_action('myarcadetheme_after_menu');
      ?>
    </div>
  </div>

  <?php get_template_part( "partials/header", "carousel" ); ?>

  <?php get_template_part( "partials/header", "news" ); ?>
</header>