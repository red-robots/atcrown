<?php
function get_content($name, $dir) {
  $ds = DIRECTORY_SEPARATOR;
  $path = __DIR__ . $ds . 'content' . $ds . $dir . $ds . $name . '.php';
  if (file_exists($path)) {
    require_once $path;
  }
}
?>
<?php get_header();?>
<section id="content" role="main" data-type="page">
<?php do_action('get_notices');?>
<?php if (have_posts()): ?>
  <?php while (have_posts()): ?>
    <?php the_post();?>
  <article id="post-<?php the_ID();?>" <?php post_class();?>>
    <?php if (is_page()) {
  if ($post->post_parent) {
    echo atc10k_get_element('/layout/subpage-header');
  } else {
    echo atc10k_get_element('/layout/rootpage-header');
  }
}?>
    <section class="pre-entry-content">
      <?php get_content($pagename, 'pre');?>
    </section>
    <section class="entry-content body-content">
      <?php if (has_post_thumbnail()) {the_post_thumbnail();}?>
      <?php the_content();?>
      <div class="entry-links"><?php wp_link_pages();?></div>
    </section>
    <section class="post-entry-content">
      <?php get_content($pagename, 'post');?>
    </section>
  </article>
  <?php if (!post_password_required()) {comments_template('', true);}?>
  <?php endwhile;?>
<?php endif;?>
</section>
<?php get_footer();?>