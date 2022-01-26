<?php
class Walker_Nav extends Walker {

  // Tell Walker where to inherit it's parent and id values
  var $db_fields = array(
    'parent' => 'menu_item_parent',
    'id'     => 'db_id'
  );

  /**
   * At the start of each element, output a <li> and <a> tag structure.
   *
   * Note: Menu objects include url and title properties, so we will use those.
   */
  function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
    $is_current = $item->current || $item->current_item_parent;
    $target = (isset($item->target) && $item->target=='_blank') ? ' target="_blank"' : '';
    $class = classes([
      'nav__item',
      'nav__item--current' => $is_current,
      'nav__item--children' => $args->walker->has_children,
      'nav__item--root' => !$depth,
      'nav__item--' . $this->slugify($item->title)
    ]);
    $output .= $this->n($depth + 1) . sprintf('<li class="%s">', $class);
    $output .= $this->n($depth + 2);
    $output .= sprintf( '<a class="nav__link %s" href="%s"'.$target.'>%s</a>',
      classes([
        'nav__link--current' => $is_current,
        'nav__link--parent' => $args->walker->has_children,
        'nav__link--root' => !$depth,
      ]),
      $item->url,
      $item->title
    );
  }

  public function end_el( &$output, $category, $depth = 0, $args = array() ) {
    $output .= $this->n($depth + 1) . "</li>";
  }

  function start_lvl( &$output, $depth = 0, $args = array() ) {
    $output .= $this->n($depth + 2) . '<div class="nav__children"><ul class="nav__list">';
  }

  function end_lvl( &$output, $depth = 0, $args = array() ) {
    $output .= $this->n($depth + 2) . '</ul></div>' . "\n";
  }

  private function n($depth = 0) {
    return "\n" . str_repeat("\t", $depth);
  }

  private function slugify($text) {
    $text = strtolower(str_replace(' ', '_', trim($text)));
    return preg_replace('/[^a-z_]/', '', $text);
  }
}