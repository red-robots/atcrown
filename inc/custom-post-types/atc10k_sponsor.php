<?php

add_action( 'init', function() {
  register_post_type( 'atc10k_sponsor',
    array(
      'labels' => array(
        'name' => __( 'Sponsors' ),
        'singular_name' => __( 'Sponsor' ),
        'add_new_item' => 'Add new sponsor',
        'edit_item' => 'Edit sponsor',
        'view_item' => 'View sponsor',
        'search_items' => 'Find sponsor',
      ),
      'public' => true,
      'has_archive' => true,
      'menu_icon' => 'dashicons-money',
    )
  );
});



