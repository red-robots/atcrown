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
    <script src="https://kit.fontawesome.com/b826b85308.js" crossorigin="anonymous"></script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-132819498-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-132819498-1');
    </script>
    <script>var assets = '<?php echo  THEMEURI . "assets/"?>'; </script>

<style type="text/css">
  .search-icon {
    display: flex;
    flex-direction: column;
    justify-content: center;
  }
  .top-search-bar {
   width: 100%;
   height: 0;
   background: #001b33;
   position: absolute;
   top: 0px;
   left: 0;
   transition: all ease 0.3s;
   z-index: 210;
   box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.35);
   overflow: hidden;
}
 .top-search-bar.show {
   opacity: 1;
   height: 150px;
   transform: translateY(0);
}
 .top-search-bar * {
   box-sizing: border-box;
}
 .top-search-bar .screen-reader-text {
   display: none;
}
 .top-search-bar .wrapper {
   height: 100%;
   display: flex;
   flex-direction: column;
   justify-content: center;
}
 .top-search-bar .form-wrapper {
   max-width: 80%;
   width: 100%;
   margin: 0 auto;
   position: relative;
}
 .top-search-bar form {
   width: 100%;
   position: relative;
   top: -5%;
}
 .top-search-bar form * {
   box-sizing: border-box;
}
 .top-search-bar label {
   display: block;
   width: 100%;
   margin: 0 0;
}
 .top-search-bar input.search-field {
   width: 100%;
   -webkit-appearance: none;
   border-radius: 0px;
   border: none;
   background-color: transparent;
   box-shadow: none;
   border-bottom: 2px solid #565656;
   height: 50px;
   line-height: 45px;
   font-size: 25px;
   color: #fff;
   outline: none;
   padding: 3px 15px;
   padding-left: 45px;
   font-weight: 300;
}
 .top-search-bar input.search-submit {
   width: 50px;
   height: 100%;
   position: absolute;
   top: 0;
   right: 0;
   z-index: 10;
   visibility: hidden;
   opacity: 0;
}
 .top-search-bar #topsearchBtn {
   cursor: pointer;
   font-size: 22px;
   line-height: 1;
   position: absolute;
   top: 3px;
   left: -11px;
   z-index: 50;
   width: 50px;
   height: 100%;
   color: #c1c1c1;
   text-align: center;
}
 .top-search-bar #topsearchBtn .fa-search {
   display: block;
   position: relative;
   top: -3px;
}
.top-search-bar #topsearchBtn a {
  text-decoration: none;
 }
 .top-search-bar #closeTopSearch {
   display: inline-block;
   cursor: pointer;
   width: 40px;
   height: 100%;
   position: absolute;
   top: 0;
   right: 0;
   background-color: transparent;
}
 .top-search-bar #closeTopSearch span {
   display: none;
}
 .top-search-bar #closeTopSearch:before, .top-search-bar #closeTopSearch:after {
   content: "";
   display: block;
   width: 50%;
   height: 3px;
   background: #c1c1c1;
   position: absolute;
   left: 13px;
   top: 25px;
}
 .top-search-bar #closeTopSearch:before {
   transform: rotate(45deg);
}
 .top-search-bar #closeTopSearch:after {
   transform: rotate(-45deg);
}
#searchHereBtn {
  padding: 0 20px;
  cursor: pointer;
}
.mobile-nav #searchHereBtn {
  color: #fff;
  padding: 20px 20px 20px 0;
}
 
</style>


  </head>
<body <?php body_class();?>>
<?php 
  $top_message = get_field('topMessage','option'); 
  $top_visibility = get_field('announcement_visibility','option'); 
?>
  <div class="hfeed page">
    <header class="page__header  page-header" role="banner">
      <?php if( (is_front_page() || is_home()) && $top_visibility=='on' ) { ?>
        <div class="topMessage"><div class="inner"><?php echo $top_message; ?></div></div>
      <?php } ?>
      <div id="topSearchBar" class="top-search-bar">
        <div class="wrapper">
          <div class="form-wrapper">
            <?php //echo get_search_form(); ?>
            <form role="search" method="get" class="search-form" action="<?php bloginfo('url'); ?>">
              <label>
                <span class="screen-reader-text">Search for:</span>
                <input type="search" class="search-field" placeholder="Search &hellip;" value="" name="s" />
              </label>
              <input type="submit" class="search-submit" value="Search" />
            </form>         
            <!-- <a href="#" id="topsearchBtn"><i class="fas fa-search"></i></a> -->
            <a href="#" id="closeTopSearch"><span>Close</span></a>
          </div>
        </div>
      </div>

      <div class="page-header__inner  page-header__inner--desktop">
        <section id="branding" class="page-header__branding">
          <a class="page-header__home" href="/">
            <img
              class="page-header__logo"
              src="<?=get_theme_file_uri('/assets/images/logo/atc-logo-2024-b.png')?>"
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
       <!--  <div class="search">
                  sei
                </div> -->
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
            src="<?=get_theme_file_uri('/assets/images/logo/atc-mobile-2024.png')?>" 
            />
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
                  src="<?=get_theme_file_uri('/assets/images/logo/atc-mobile-2024.png')?>"
                  width="200px"
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