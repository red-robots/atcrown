<?php
/*
Plugin Name: Around the Crown 10K Plugin
Description: Directory informatoin
*/

function debug() {
  $args = func_get_args();
  echo '<pre>';
  print_r(count($args) === 1 ? $args[0] : $args);
  echo '</pre>';
}

function require_directory($path) {
  $files = array_diff(scandir($path), ['..', '.']);
  foreach ($files as $file) {
    require_once($path . $file);
  }
}

function require_all($path) {
  if (is_array($path)) {
    foreach ($path as $p) {
      require_all($p);
    }
    return;
  }
  $path = dirname(__FILE__) . $path;
  if (is_dir($path)) {
    return require_directory($path);
  }
  if (is_file($path)) {
    return require_once($path);
  }
}

require_all([
  // '/functions/',
  '/helpers.php',
  '/nav/',
  '/html_elements/',
  // '/classes/auto_increment.php',
  // '/classes/shcd_table.php',
  '/custom-post-types/',
//  '/taxonomies/',
]);




add_action('admin_menu', function() {
  add_management_page(
    'Email List',
    'Email List',
    'manage_options',
    'atc10k-emails',
    function() {
      require_once(dirname(__FILE__) . "/tools/email_list.php");
    }
  );
});

add_action('init', function() {
  if (!empty($_REQUEST['email']) && atc10k_validate_email($_REQUEST['email'])) {
    if (atc10k_add_email($_REQUEST['email'])) {
      Notice::set('success', 'Success!', atc10k_get_constant('EMAIL_SUCCESS_MESSAGE'));
      global $wp;
      wp_redirect(home_url( $wp->request ));
    }
  }

  if (!empty($_REQUEST['contactform-template'])) {
    atc10k_process_contact_reply($_REQUEST);
  }
});


/* Get Faculty Details via Ajax */
add_action( 'wp_ajax_nopriv_get_posttype_content', 'get_posttype_content' );
add_action( 'wp_ajax_get_posttype_content', 'get_posttype_content' );
function get_posttype_content() {
  if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
      $post_id = ($_POST['postid']) ? $_POST['postid'] : '';
      // $content = ($post_id) ? get_the_content($post_id) : '';
      // $details = ($content) ? apply_filters('the_content', $content) : '';
      $details = get_field("description",$post_id);
      $link = get_field("url",$post_id);
      $html = '';
      ob_start(); ?>
      <div class="details">
        <?php echo ($details) ? wpautop($details) : '' ?>
        <?php if ($link) { ?>
        <p class="sponsor-site">
          <a href="<?php echo $link ?>" target="_blank">Visit <?php echo get_the_title($post_id); ?></a>
        </p> 
        <?php } ?>
      </div>
      <?php
      $html = ob_get_contents();
      ob_end_clean();

      $response['content'] = $html;
      echo json_encode($response);
  }
  else {
      header("Location: ".$_SERVER["HTTP_REFERER"]);
  }
  die();
}


require get_template_directory() . '/inc/custom-taxonomies.php';
