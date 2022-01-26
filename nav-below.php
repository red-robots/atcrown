<?php

// $args = array(
// 'prev_text' => sprintf( esc_html__( '%s older', 'blankslate' ), '<span class="meta-nav">&larr;</span>' ),
// 'next_text' => sprintf( esc_html__( 'newer %s', 'blankslate' ), '<span class="meta-nav">&rarr;</span>' )
// );
// the_posts_navigation( $args );

$args = [];
if (!empty($_GET['category_name'])) {
  $args['category_name'] = $_GET['category_name'];
}
?>
<section class="page-numbers-nav">
  <?=paginate_links([
  'next_text' => 'next',
  'prev_text' => 'prev',
  'add_args' => $args,
]);?>
</section>
