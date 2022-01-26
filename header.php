<!DOCTYPE html>
<html <?php language_attributes();?>>
  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_uri(); ?>" />
    <?php wp_head();?>
    <?php if ( is_singular(array('post')) ) { 
    global $post;
    $post_id = $post->ID;
    $thumbId = get_post_thumbnail_id($post_id); 
    $featImg = wp_get_attachment_image_src($thumbId,'full'); ?>
    <!-- SOCIAL MEDIA META TAGS -->
    <meta property="og:site_name" content="<?php bloginfo('name'); ?>"/>
    <meta property="og:url"   content="<?php echo get_permalink(); ?>" />
    <meta property="og:type"  content="article" />
    <meta property="og:title" content="<?php echo get_the_title(); ?>" />
    <meta property="og:description" content="<?php echo (get_the_excerpt()) ? strip_tags(get_the_excerpt()):''; ?>" />
    <?php if ($featImg) { ?>
    <meta property="og:image" content="<?php echo $featImg[0] ?>" />
    <?php } ?>
    <!-- end of SOCIAL MEDIA META TAGS -->
    <?php } ?>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-132819498-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-132819498-1');
    </script>
  </head>
<body <?php body_class();?>>
  <div class="hfeed page">
    <header class="page__header  page-header" role="banner">
      <div class="page-header__inner  page-header__inner--desktop">
        <section id="branding" class="page-header__branding">
          <a class="page-header__home" href="/">
            <img
              class="page-header__logo"
              src="<?=get_theme_file_uri('/assets/images/logo/atc10k-desktop.svg')?>"
              alt="Around the Crown 10K logo"
            />
          </a>
        </section>
        <?php wp_nav_menu([
          'walker' => new Walker_Nav(),
          'theme_location' => 'main-menu',
          'container' => 'nav',
          'container_class' => 'page-header__nav nav  js-nav-hover',
          'menu_class' => 'nav__list nav__list--root',
        ]);?>
        <div class="page-header__footer">
          <?php wp_nav_menu([
            'walker' => new Walker_Nav(),
            'theme_location' => 'register',
            'container' => 'nav',
            'container_class' => 'page-header__nav nav page-header__nav--register',
            'menu_class' => 'nav__list nav__list--root',
          ]);?>
        </div>
      </div>

      <div class="page-header__inner  page-header__inner--mobile js-avoid-admin-bar">
        <a class="page-header__home" href="/">
          <img
            class="page-header__logo"
            alt="Around the Crown 10K logo"
            src="<?=get_theme_file_uri('/assets/images/logo/atc10k-mobile.svg')?>" />
        </a>
        <button class="page-header__hamburger js-mobile-nav-control">
          <span class="hamburger-icon" aria-label="Open Menu"></span>
        </button>
      </div>

      <div class="page-header__mobile-nav  mobile-nav  js-mobile-nav">
        <div class="mobile-nav__inner js-avoid-admin-bar">
          <header class="mobile-nav__header">
              <a class="page-header__home" href="/">
                <img
                  class="page-header__logo"
                  alt="Around the Crown 10K logo"
                  src="<?=get_theme_file_uri('/assets/images/logo/atc10k-mobile.svg')?>"
                />
              </a>
            <button class="mobile-nav__hamburger  page-header__hamburger js-mobile-nav-control">
              <span class="hamburger-icon" aria-label="Open Menu"></span>
            </button>
          </header>
          <div class="mobile-nav__content">
            <div class="mobile-nav__navs">
              <div class="mobile-nav__navs-inner">
                <?php wp_nav_menu([
                  'walker' => new Walker_Nav(),
                  'theme_location' => 'main-menu',
                  'container' => 'nav',
                  'container_class' => 'page-header__nav nav page-header__nav--main-menu js-nav-toggle',
                  'menu_class' => 'nav__list nav__list--root',
                ]);?>

                <?php wp_nav_menu([
                  'walker' => new Walker_Nav(),
                  'theme_location' => 'quick-links',
                  'container' => 'nav',
                  'container_class' => 'page-header__nav nav page-header__nav--quick-links',
                  'menu_class' => 'nav__list nav__list--root',
                ]);?>

                <div class="page-header__social-links  social-links">
                  <?=atc10k_social_media_nav()?>
                </div>
              </div>
            </div>
              <?php wp_nav_menu([
                'walker' => new Walker_Nav(),
                'theme_location' => 'register',
                'container' => 'nav',
                'container_class' => 'page-header__nav nav page-header__nav--register',
                'menu_class' => 'nav__list nav__list--root',
              ]);?>
          </div>
        </div>
      </div>

    </header>
    <div id="container" class="page__content content">