<?php get_header();?>
<main id="content"  data-templage="<?=get_page_template()?>">
<header>
<?php
if ($post->post_parent) {
  echo atc10k_get_element('/layout/subpage-header');
} else {
  echo atc10k_get_element('/layout/rootpage-header');
}
//print_r($post);
?>
</header>
<?php if (have_posts()): while (have_posts()): the_post();?>
																<?php get_template_part('entry');?>
																<?php comments_template();?>
																<?php endwhile;endif;?>
<?php get_template_part('nav', 'below');?>
</main>
<?php get_sidebar();?>
<?php get_footer();?>