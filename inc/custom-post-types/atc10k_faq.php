<?php

add_action( 'init', function() {
  register_post_type( 'atc10k_faq',
    array(
      'labels' => array(
        'name' => __( 'FAQ' ),
        'singular_name' => __( 'FAQ' ),
        'add_new_item' => 'Add new Question',
        'edit_item' => 'Edit Question',
        'view_item' => 'View Question',
        'search_items' => 'Find Question',
      ),
      'public' => true,
      'has_archive' => true,
      'menu_icon' => 'dashicons-editor-help',
    )
  );
});



