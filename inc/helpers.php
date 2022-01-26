<?php
require_once(dirname(__FILE__) . '/lib/notices.php');

function classes($classes, $curr = '') {
  if (is_array($classes)) {
    foreach ($classes as $k => $c) {
      if (is_numeric($k)) {
        $class = $c;
      } else if ($c) {
        $class = $k;
      } else {
        continue;
      }
      $curr = classes($class, $curr);
    }
  } else if (!empty($classes)) {
    $curr .= ' ' . $classes;
  }
  return $curr;
}

function atc10k_get_constant($constant_name, $default = null) {
  $q = new WP_Query([
    'post_type' => 'atc10k_constants',
    'title' => $constant_name,
  ]);
  if (!empty($q->posts)) {
    $meta = get_post_meta($q->posts[0]->ID, 'value');
    if (!empty($meta[0])) {
      return $meta[0];
    }
  }
  return $default;
}