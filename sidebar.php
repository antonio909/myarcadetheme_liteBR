<?php if ( ! ( myarcadetheme_get_option( 'mobile_sidebar', 0 ) && wp_is_mobile() ) ) : ?>
<aside class="sdbr-cn cols-n3" itemscope="itemscope" itemtype="http://schema.org/WPSideBar">
  <?php
  // Do some actions before the widget area
  do_action('myarcadetheme_before_sidebar_widgets');

  // Get dynamic sidebars
  myarcadetheme_sidebar();

  // Do some actions after the widget area
  do_action('myarcadetheme_after_sidebar_widgets');
  ?>
</aside>
<?php endif; ?>
