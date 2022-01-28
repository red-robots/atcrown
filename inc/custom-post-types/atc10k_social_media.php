<?php

add_action( 'init', function() {
  register_post_type( 'atc10k_social_media',
    array(
      'labels' => array(
        'name' => __( 'Social Media' ),
        'singular_name' => __( 'Social Media' ),
        'add_new_item' => 'Add new link',
        'edit_item' => 'Edit link info',
        'view_item' => 'View link',
        'search_items' => 'Find link',
      ),
      'public' => true,
      'has_archive' => true,
      'menu_icon' => 'dashicons-share',
    )
  );
});


function atc10k_social_media_sort( $query ){
  if( !empty($query->query['post_type']) && $query->query['post_type'] === 'atc10k_social_media' ){
    $query->set( 'meta_key', 'order' );
    $query->set( 'orderby', 'meta_value' );
    $query->set( 'order', 'ASC' );
  }
}
add_action( 'pre_get_posts', 'atc10k_social_media_sort' );