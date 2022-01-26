<?php

function atc10k_social_media_nav() {
  $q = new WP_Query([
    'post_type' => 'atc10k_social_media',
    'nopaging' => true,
  ]);
  $out = '';
  foreach ($q->posts as $post) {
    $line = '';
    $url = get_post_meta($post->ID, 'url')[0];
    $class = strtolower(preg_replace('/([A-Za-z0-9])([A-Z])/', '$1 $2', $post->post_title));
    $class = trim(preg_replace('/[\s+]/', '-', $class));
    $line = sprintf('<a href="%s" class="social-media-nav__link social-media-nav__link--%s">
      <span class="social-media-nav__link-label">%s</span>
    </a>',
      $url,
      $class,
      $post->post_title
    );

    $out .= '<li class="social-media-nav__item">' . $line . '</li>';
  }

  return '<ul class="social-media-nav">' . $out . '</ul>';
}