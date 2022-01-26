<?php

add_action( 'init', function() {
  register_post_type( 'atc10k_email',
    array(
      'labels' => array(
        'name' => __( 'Emails' ),
        'singular_name' => __( 'Email' ),
        'add_new_item' => 'Add new email',
        'edit_item' => 'Edit email',
        'view_item' => 'View email',
        'search_items' => 'Find email',
      ),
      'public' => true,
      'has_archive' => true,
      'menu_icon' => 'dashicons-email',
    )
  );
});

function atc10k_validate_email($email) {
  return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function atc10k_parse_email($email) {
  $email = trim(strtolower($email));
  return atc10k_validate_email($email) ? $email : null;
}

function atc10k_find_email($email) {
  if (!($email = atc10k_parse_email($email))) {
    return null;
  }
  $q = new WP_Query([
    'post_type' => 'atc10k_email',
    'title' => atc10k_parse_email($email),
  ]);
  if ($q->post_count) {
    return $q->posts[0]->ID;
  }
  return null;
}

function atc10k_send_email_success($to, $id) {
  $body = "
  A new contact has signed up for email!

  View their information here:
  https://aroundthecrown10k.com/wp-admin/post.php?post=$id&action=edit

  To see all the emails:
  https://aroundthecrown10k.com/wp-admin/tools.php?page=atc10k-emails
  ";
  mail($to, 'A new contact has signed up for email', $body);
}

function atc10k_add_email($email) {
  if (!($email = atc10k_parse_email($email))) {
    return null;
  }
  if ($id = atc10k_find_email($email)) {
    wp_update_post([
      'ID' => $id,
      'post_status' => 'publish',
      'post_type' => 'atc10k_email',
    ]);
    wp_untrash_post($id);
  } else {
    $id = wp_insert_post([
      'post_type' => 'atc10k_email',
      'post_title' => atc10k_parse_email($email),
      'post_status' => 'publish',
    ]);
  }

  if ($id) {
    $users = get_users([ 'role' => 'administrator']);
    foreach ($users as $user) {
      atc10k_send_email_success($user->data->user_email, $id);
    }
    return $id;
  }

  return null;

}
