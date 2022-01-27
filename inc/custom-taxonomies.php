<?php

/* ##########################################################
 * Add new taxonomy, make it hierarchical (like categories)
 * Custom Taxonomies
*/
add_action( 'init', 'build_taxonomies', 0 ); 
function build_taxonomies() {
  $post_types  = array();
  $post_types = array(
    array(
      'post_type' => array('atc10k_sponsor'),
      'menu_name' => 'Sponsor Category',
      'plural'    => 'Sponsor Categories',
      'single'    => 'Sponsor Category',
      'taxonomy'  => 'sponsor-categories'
    ),
  );


  if($post_types) {
    foreach($post_types as $p) {
      $p_type = ( isset($p['post_type']) && $p['post_type'] ) ? $p['post_type'] : ""; 
      $single_name = ( isset($p['single']) && $p['single'] ) ? $p['single'] : "Custom Post"; 
      $plural_name = ( isset($p['plural']) && $p['plural'] ) ? $p['plural'] : "Custom Post"; 
      $menu_name = ( isset($p['menu_name']) && $p['menu_name'] ) ? $p['menu_name'] : $p['plural'];
      $taxonomy = ( isset($p['taxonomy']) && $p['taxonomy'] ) ? $p['taxonomy'] : "";
      $rewrite = ( isset($p['rewrite']) && $p['rewrite'] ) ? $p['rewrite'] : $taxonomy;
      $query_var = ( isset($p['query_var']) && $p['query_var'] ) ? $p['query_var'] : true;
      $show_admin_column = ( isset($p['show_admin_column']) ) ? $p['show_admin_column'] : true;

      $labels = array(
        'name' => _x( $menu_name, 'taxonomy general name' ),
        'singular_name' => _x( $single_name, 'taxonomy singular name' ),
        'search_items' =>  __( 'Search ' . $plural_name ),
        'popular_items' => __( 'Popular ' . $plural_name ),
        'all_items' => __( 'All ' . $plural_name ),
        'parent_item' => __( 'Parent ' .  $single_name),
        'parent_item_colon' => __( 'Parent ' . $single_name . ':' ),
        'edit_item' => __( 'Edit ' . $single_name ),
        'update_item' => __( 'Update ' . $single_name ),
        'add_new_item' => __( 'Add New ' . $single_name ),
        'new_item_name' => __( 'New ' . $single_name ),
      );

      register_taxonomy($taxonomy, $p_type, array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_admin_column' => $show_admin_column,
        'query_var' => $query_var,
        'show_ui' => true,
        'show_in_rest' => true,
        'public' => true,
        '_builtin' => true,
        'rewrite' => array( 'slug' => $rewrite ),
      ));

    }
  }

}