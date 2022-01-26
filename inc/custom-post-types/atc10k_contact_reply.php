<?php

add_action( 'init', function() {
  register_post_type( 'atc10k_contact_reply',
    array(
      'labels' => array(
        'name' => __( 'Contact Form Replies' ),
        'singular_name' => __( 'Contact Form Reply' ),
        'add_new_item' => 'Add new reply',
        'edit_item' => 'Edit reply',
        'view_item' => 'View reply',
        'search_items' => 'Find reply',
      ),
      'public' => true,
      'has_archive' => true,
      'menu_icon' => 'dashicons-email',
    )
  );
});

function atc10k_validate_contact_email($email) {
  return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function atc10k_get_contact_form_input_name($k) {
  return 'contactform-input-' . $k;
}

function atc10k_get_contact_form_reply_matches($body) {
  preg_match_all('/{{[\s]*([^}]*)[\s]*}}/', $body, $matches);
  return $matches;
}

function atc10k_get_email_message($body, $post) {
  $matches = atc10k_get_contact_form_reply_matches($body);
  $replace = [];
  if (!empty($matches[0])) {
    foreach ($matches[0] as $k => $match) {
      $field = atc10k_get_contact_form_input_name($k);
      $replace[$match] = !empty($post[$field]) ? $post[$field] : '';
    }
    $body = str_replace(array_keys($replace), array_values($replace), $body);
  }
  return iconv('UTF-8', 'ASCII//TRANSLIT', $body);
}

function atc10k_parse_contact_form_reply($body) {
  $matches = atc10k_get_contact_form_reply_matches($body);
  $replace = [];
  if (!empty($matches[1])) {
    foreach ($matches[1] as $k => $label) {
      $name = atc10k_get_contact_form_input_name($k);
      $id = 'contactform-' . $name;
      $choices = explode('|', $label);
      if (count($choices) > 1) {
        $input = sprintf('<select class="contactform__input contactform__input--select" name="%s" aria-label="%s">', $name, $name);
        $input .= '<option value=""> -- Select an option -- </option>';
        foreach ($choices as $choice) {
          $input .= sprintf('<option value="%s">%s</option>', trim($choice), trim($choice));
        }
        $input .= '</select>';
      } else {
        $input = sprintf('<div class="contactform__field contactform__field--text">
          <label class="contactform__label" for="%s">%s</label>
          <input id="%s" class="contactform__input contactform__input--text" type="text" name="%s">
        </div>', $id, $label, $id, $name);
      }
      $replace[$matches[0][$k]] = $input;
    }
    $body = str_replace(array_keys($replace), array_values($replace), $body);
  }
  return $body;
}


function atc10k_send_contact_reply_success($to, $message, $id, $from) {
  $headers = '';
  $eol = "\r\n";
  $subject = 'Around the Crown 10K Question';
  $body = implode($eol, ["Around the Crown 10K Contact:", '', str_replace('\\', '', $message)]);
  if (atc10k_validate_contact_email($from)) {
    $headers = implode($eol, ["Reply-To: $from", 'X-Mailer: PHP/' . phpversion()]);
  }
  mail($to, $subject, $body, $headers);
}

function atc10k_process_contact_reply($post) {
  $template = stripslashes(html_entity_decode($post['contactform-template']));
  $title = $post[atc10k_get_contact_form_input_name(0)];
  $from = $post[atc10k_get_contact_form_input_name(5)];
  $message = atc10k_get_email_message($template, $post);
  $id = wp_insert_post([
    'post_title' => $title,
    'post_content' => $message,
    'post_type' => 'atc10k_contact_reply',
    'post_status' => 'publish',
  ]);
  if ($id) {
    $users = get_users([ 'role' => 'administrator']);
    foreach ($users as $user) {
      atc10k_send_contact_reply_success($user->data->user_email, $message, $id, $from);
    }
    Notice::set('success', 'Your feedback has been submitted!');
  }
  global $wp;
  wp_redirect(home_url( $wp->request ));
}
