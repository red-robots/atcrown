<?php
/*
<span class="cat-links"><?php esc_html_e('Categories: ', 'blankslate');?><?php the_category(', ');?></span>
<span class="tag-links"><?php the_tags();?></span>
<?php if (comments_open()) {echo '<span class="meta-sep">|</span> <span class="comments-link"><a href="' . esc_url(get_comments_link()) . '">' . sprintf(esc_html__('Comments', 'blankslate')) . '</a></span>';}?>
 */

?>
<footer class="entry-footer">

<?php
$query = new WP_Query([
  'post__not_in' => [get_the_ID()],
  'posts_per_page' => 3,
]);
?>
<section class="footer-posts">
  <?php foreach ($query->posts as $post): ?>
    <?php
$category = get_the_category($post->ID);
$category_title = !empty($category) && $category[0]->name !== 'Uncategorized' ? $category[0]->name : '';
?>
    <a
      href="<?=get_permalink($post->ID)?>"
      class="footer-posts__post"
    >
      <div class="u-banner" style="background-image: url(<?=get_the_post_thumbnail_url();?>)"></div>
      <h4 class="u-overline"><?=$category_title?></h4>
      <h3 class="u-header-2"><?=get_the_title($post->ID);?></h3>
      <p><?=strip_tags(get_the_excerpt($post->ID));?></p>
    </a>
  <?php endforeach;?>
</section>
</footer>