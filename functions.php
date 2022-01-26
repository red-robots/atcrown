<?php
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

