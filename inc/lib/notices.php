<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

class Notice {
  const NOTICE_KEY = 'atc10k_notifications';

  public static function __callStatic($name, $args) {
    forward_static_call_array(['self', 'set'], array_merge([$name], $args));
  }

  public static function has_redirect() {
    return !empty($GLOBALS['has_redirect']);
  }

  public static function set($type, $title, $body = null) {
    if (empty($_SESSION[self::NOTICE_KEY])) {
      self::reset();
    }
    if (is_array($title)) {
      list($title, $body) = $title;
    }
    $_SESSION[self::NOTICE_KEY][] = compact('title', 'body', 'type');
  }

  public static function get() {
    $output = '';
    if (empty($_SESSION[self::NOTICE_KEY])) {
      return '';
    }
    foreach ($_SESSION[self::NOTICE_KEY] as $notice) {
      extract($notice);
      $output = "<div class=\"notice notice--$type\">
        <h2 class=\"notice__title\">$title</h2>
        <h3 class=\"notice__body\">$body</h3>
      </div>";
    }
    return $output;
  }

  public static function reset() {
    $_SESSION[self::NOTICE_KEY] = [];
  }

  public static function on($test, $success, $fail) {
    return $test ? self::success($success) : self::error($fail);
  }

}


add_filter('wp_redirect', function($location, $status) {
  $GLOBALS['has_redirect'] = true;
  return $location;
}, 10, 2);

add_action('get_notices', function() {
  echo Notice::get();
  if (!Notice::has_redirect()) {
    Notice::reset();
  }
});