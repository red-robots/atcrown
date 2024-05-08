<?php
define('THEMEURI',get_template_directory_uri() . '/');



add_filter('wp_nav_menu_items', 'add_search_form', 10, 2);
function add_search_form($items, $args) {
if( $args->theme_location == 'main-menu' )
        $items .= '<li id="searchHereBtn" class="search-icon "><i class="fas fa-search"></i></li>';
        return $items;
}

/*-------------------------------------
  Custom client login, link and title.
---------------------------------------*/
function my_login_logo() { 
  // $custom_logo_id = get_theme_mod( 'custom_logo' );
  // $logoImg = wp_get_attachment_image_src($custom_logo_id,'large');
  //$logo_url = ($logoImg) ? $logoImg[0] : '';
  $logo_url = get_bloginfo('template_url') . '/assets/images/logo/atc10k-desktop.svg';
  if($logo_url) { ?>
  <style type="text/css">
    .login #login_error {
      color: #d63638;
    }
    body.login {
      background-color: #001b33;
      color: #000;
    }
    body.login div#login h1 a {
      background-image: url(<?php echo $logo_url; ?>);
      background-size: contain;
      width: 100%;
      height: 100px;
      margin-bottom: 10px;
    }
    .login #backtoblog, .login #nav {
      text-align: center;
    }
    body.login #backtoblog a, 
    body.login #nav a {
      color: #157394;
      transition: all ease .3s;
    }
    body.login #backtoblog a:hover,
    body.login #nav a:hover {
      color: #ec3742;
    }
    body.login form {
      border: none;
      border-radius: 10px;
    }
    body.login #login form p.submit {
      display: block;
      width: 100%;
    }
    body.login #login form p.submit input.button-primary {
      display: block;
      width: 100%;
      text-align: center;
      margin-top: 15px;
    }
    body.login.wp-core-ui .button-primary {
      background: #d63638;
      border-color: #dd202b;
      font-weight: bold;
      text-transform: uppercase;
      transition: all ease .3s;
    }
    body.login.wp-core-ui .button-primary:hover {
      background: #f17078;
    }
  </style>
<?php }
}
add_action( 'login_enqueue_scripts', 'my_login_logo' );

// Change Link
function loginpage_custom_link() {
  return get_site_url();
}
add_filter('login_headerurl','loginpage_custom_link');

function bella_login_logo_url_title() {
    return get_bloginfo('name');
}
add_filter( 'login_headertitle', 'bella_login_logo_url_title' );

function atc10k_enqueue_styles() {
  $parent_style = 'blankslate';
  // Parent styles
  wp_enqueue_style($parent_style, get_template_directory_uri() . '/style.css');
  // Theme styles
  wp_enqueue_style('atc10k-style-01',
    get_stylesheet_directory_uri() . '/style.css',
    array($parent_style),
    wp_get_theme()->get('Version')
  );
  // wp_enqueue_style('atc10k-style-02',
  //   get_stylesheet_directory_uri() . '/assets/css/style.css',
  //   array('atc10k-style-01'),
  //   wp_get_theme()->get('Version')
  // );

  wp_enqueue_style('atc10k-style-02',
    get_stylesheet_directory_uri() . '/style.min.css',
    array('atc10k-style-01'),
    wp_get_theme()->get('Version')
  );

  // JS
  wp_enqueue_script('atc10k-script-global', get_theme_file_uri('/assets/js/global.js'));
  wp_enqueue_script('atc10k-script-project', get_theme_file_uri('/assets/js/project.js'), ['jquery']);

  // You need styling for the datepicker. For simplicity I've linked to Google's hosted jQuery UI CSS.
  wp_register_style('jquery-ui', 'https://code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css');
  wp_enqueue_style('jquery-ui');

  wp_enqueue_script( 
    'bellaworks-pluginsjs', get_template_directory_uri() . '/assets/js/plugins.min.js', array(), '20220902', true 
  );

  wp_enqueue_script( 
    'bellaworks-customjs', get_template_directory_uri() . '/assets/js/custom.js', array(), '20220127', true 
  );

  wp_localize_script( 'bellaworks-customjs', 'frontajax', array(
    'ajaxurl' => admin_url( 'admin-ajax.php' )
  ));

}
add_action('wp_enqueue_scripts', 'atc10k_enqueue_styles');

// Add admin styles
function atc10k_enqueue_admin_styles() {
  // Admin-only Styles
  wp_enqueue_style('atc10k-admin-style', get_stylesheet_directory_uri() . '/assets/css/style-admin.css');
}
add_action('admin_enqueue_scripts', 'atc10k_enqueue_admin_styles');

function atc10k_register_menus() {
  register_nav_menus(
    array(
      'main-menu' => __('Main Menu'),
      'quick-links' => __('Quick Links'),
      'register' => __('Register'),
    )
  );
}
add_action('init', 'atc10k_register_menus');

function atc10k_get_element($path) {
  $p = dirname(__FILE__) . '/elements' . $path . '.php';
  $out = '';
  if (is_file($p)) {
    ob_start();
    require_once $p;
    $out = ob_get_clean();
  }
  return $out;
}

function atc10k_class_list($classes) {
  $output = [];
  foreach ($classes as $key => $val) {
    if (is_bool(($val))) {
      if ($val) {
        $output[] = $key;
      }
    } else if (is_array($val)) {
      $output[] = atc10k_class_list($val);
    } else if (!empty($val)) {
      $output[] = $val;
    }
  }
  return esc_attr(trim(implode(' ', $output)));
}

function atc10k_get_category($post_id) {
  $categories = get_the_category($post_id);
  if (empty($categories)) {
    return false;
  }
  foreach ($categories as $category) {
    if ($category->name !== 'Uncategorized') {
      return $category;
    }
  }
  return false;
}

add_shortcode('nbsp', function () {
  return '&nbsp;';
});

// Excerpt
remove_filter('excerpt_more', 'blankslate_excerpt_read_more_link');
add_filter('excerpt_more', function ($more) {
  global $post;
  return ' ';
});
add_filter('excerpt_length', function ($length) {
  return 20;
});

// Redirect users who arent logged in...
function members_only() {
  if (!is_user_logged_in() && strstr(get_page_template(), 'template-full-screen-message') === false) {
    wp_redirect('coming-soon');
  }
}
// add_action( 'wp', 'members_only' );

add_theme_support('editor-styles');
add_theme_support('dark-editor-style');
add_theme_support( 'title-tag' );
add_editor_style(get_stylesheet_directory_uri() . '/assets/css/style-editor.css');

require get_template_directory() . '/inc/init.php';

