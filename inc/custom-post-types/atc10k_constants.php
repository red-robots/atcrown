<?php

add_action( 'init', function() {
  register_post_type( 'atc10k_constants',
    array(
      'labels' => array(
        'name' => __( 'Constants' ),
        'singular_name' => __( 'Constant' ),
        'add_new_item' => 'Add new Constant',
        'edit_item' => 'Edit Constant',
        'view_item' => 'View Constant',
        'search_items' => 'Find Constant',
      ),
      'public' => true,
      'has_archive' => true,
      'menu_icon' => 'dashicons-admin-settings',
    )
  );
});
