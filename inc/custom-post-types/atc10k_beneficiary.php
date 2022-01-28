<?php

add_action( 'init', function() {
  register_post_type( 'atc10k_beneficiaries',
    array(
      'labels' => array(
        'name' => __( 'Beneficiaries' ),
        'singular_name' => __( 'Beneficiary' ),
        'add_new_item' => 'Add new Beneficiary',
        'edit_item' => 'Edit Beneficiary',
        'view_item' => 'View Beneficiary',
        'search_items' => 'Find Beneficiary',
      ),
      'public' => true,
      'has_archive' => true,
      'menu_position'=> 50,
      'menu_icon' => 'dashicons-groups',
    )
  );
});



