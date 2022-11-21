<!DOCTYPE HTML>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
        <noscript><link rel="stylesheet" href=<?php echo get_template_directory_uri()?>"/assets/css/noscript.css" /></noscript>
        <link rel="profile" href="https://gmpg.org/xfn/11">
        <?php wp_head(); ?>
    </head>
    <body <?php body_class('is-preload');?>>
        <?php wp_body_open();?>
        <div id="wrapper">

            <header id="header" class="alt">
                <span class="logo"><img src="images/logo.svg" alt="" /></span>
                <h1><?php bloginfo('name');?></h1>
                <p><?php echo get_bloginfo('description', 'display');?></p>
            </header>

            <nav id="nav">
              <?php wp_nav_menu(
                      array(
                          'theme_location' => 'Header',
                          'menu_id' => 'primary-menu'
                      )); ?>
            </nav>
            <div id="main">
