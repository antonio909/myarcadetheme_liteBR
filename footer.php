      </div>
      <!--</bdcn>-->
      <?php
      // Do some actions before the footer
      do_action('myarcadetheme_before_footer');
      ?>
      <!--<ftcn>-->
      <footer class="ftcn"  itemscope="itemscope" itemtype="http://schema.org/WPFooter">
        <?php if ( myarcadetheme_get_option( 'footer_widgets', 1 ) && ! ( myarcadetheme_get_option( 'mobile_footer_sidebar', 0 ) && wp_is_mobile() ) ) : ?>
        <div class="ftcn-1">
          <div class="cont">
            <div class="cntcls">
              <?php
              if ( is_active_sidebar('footer-sidebar' ) ) {
                dynamic_sidebar('footer-sidebar');
              }
              ?>
            </div>
          </div>
        </div>
        <?php endif; ?>

        <div class="ftcn-2">
         <div class="cont" itemprop="text">
          <p>
            <?php
              echo sprintf( __('Proudly powered by %sMyArcadePlugin - WordPress Arcade%s', 'myarcadetheme'), '<a target="_blank" href="http://myarcadeplugin.com/" title="WordPress Arcade" rel="noopener" itemprop="url">', '</a>' ) ;
            ?>
          </p>
        </div>
      </div>
    </footer>
    <!--</ftcn>-->

    <?php
    // Do some actions after the footer
    do_action('myarcadetheme_after_footer');
    ?>
  </div>
  <!--</all>-->

<?php if ( myarcadetheme_get_option( 'back_top', 1 ) ) : ?>
  <a href="#hd" class="botn-gtop fa-chevron-up" title="<?php _e("Back to Top", 'myarcadetheme');?>"></a>
    <?php endif; ?>

  <?php get_template_part( "partials/footer", "modal" ); ?>

  <?php wp_footer(); ?>
  <!--[if lt IE 9]><script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/lib/css3mq.js"></script><![endif]-->
  <!--[if lte IE 9]><script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/lib/ie.js"></script><![endif]-->
</body>
</html>