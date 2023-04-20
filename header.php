<!doctype html>
<!--[if IE 8]><html class="ie-8" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 9]><html class="ie-9" <?php language_attributes(); ?>><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html <?php language_attributes(); ?>><!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name=viewport content="width=device-width, initial-scale=1">
<meta name="theme-color" content="<?php echo myarcadetheme_get_option('toolbar-color'); ?>">
<meta name="msapplication-navbutton-color" content="<?php echo myarcadetheme_get_option('toolbar-color'); ?>">
<meta name="apple-mobile-web-app-status-bar-style" content="<?php echo myarcadetheme_get_option( 'ios-toolbar-color', 'default'); ?>">
<link href='https://fonts.gstatic.com' crossorigin rel='preconnect' />
<?php wp_head(); ?>
<!--[if lt IE 9]><script src="<?php echo get_template_directory_uri(); ?>/js/lib/html5.js"></script><![endif]-->
</head>

<body <?php body_class(); ?>>
  <?php do_action('myarcadetheme_before_wrapper'); ?>
  <div class="all<?php if ( myarcadetheme_get_option( 'boxed' ) ){ echo' boxed-cont'; } ?>">
    <?php
    // Do some actions before the header output
    do_action('myarcadetheme_before_header');

    // Get the header layout
    myarcadetheme_header_layout();
    ?>

    <div class="bdcn">
      <?php
      // Do some actions before the content wrap
      do_action('myarcadetheme_before_content');
      ?>
