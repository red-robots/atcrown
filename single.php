<?php get_header();?>
<?php
$author = get_the_author();
$byline = [];
if (!empty($author)) {
  $byline[] = "Written by $author";
}
$byline[] = get_the_time(get_option('date_format'));
?>
<header class="post-header post-header--single">
  <div class="post-header__inner">
    <h2 class="post-header__parent"><a href="<?=get_permalink(get_option('page_for_posts'))?>">ATC10K News</a></h2>
    <h1 class="post-header__heading"><?=get_the_title()?></h1>
    <h3 class="post-header__subheading"><?=implode(' | ', $byline)?></h3>
  </div>
</header>

<div class="single-content">
  <section id="content" role="main">
    <?php if (have_posts()): while (have_posts()): the_post();?>
								      <?php get_template_part('entry');?>
								    <?php endwhile;endif;?>
    <footer class="footer">
      <?php get_template_part('nav', 'below-single');?>
    </footer>
  </section>
</div>
<?php get_footer();?>