<?php
$page_title = 'Latest Happenings';
$has_category = false;
if (!empty($_GET['category_name'])) {
  $page_category = get_category_by_slug($_GET['category_name']);
  if ($page_category) {
    $has_category = true;
    $page_title = $page_category->name;
  }
}

$categories = get_categories(['hide_empty' => true]);
$categories = array_reduce($categories, function ($acc, $category) {
  if ($category->name !== 'Uncategorized') {
    $acc[] = $category;
  }
  return $acc;
}, []);

?>
<?php get_header();?>
<header class="post-header post-header--list">
  <div class="post-header__inner">
    <h2 class="post-header__parent"><a href="<?=get_permalink(get_option('page_for_posts'))?>">ATC10K Blog</a></h2>
    <h1 class="post-header__heading"><?=$page_title?></h1>
  </div>
</header>

<div class="sidebar-layout">
  <main id="content">
  <?php if (have_posts()): ?>
    <section class="entry-list">
  <?php
while (have_posts()) {
  the_post();
  get_template_part('entry');
  comments_template();
}
?>
  </section>
  <?php endif;?>
  <?php get_template_part('nav', 'below');?>
  </main>
  <aside id="sidebar">
    <h3 class="u-header-2">Browse topics</h3>
    <ul class="pills">
      <li
        class="<?=atc10k_class_list(['pills__pill', 'pills__pill--active' => !$has_category])?>"><a href="?">All topics</a></li>
    <?php foreach ($categories as $category): ?>
      <li
        class="<?=atc10k_class_list(['pills__pill', 'pills__pill--active' => $has_category && $page_category->term_id === $category->term_id])?>"
      >
        <a href="?category_name=<?=$category->slug?>"><?=$category->name?></a>
      </li>
    <?php endforeach;?>
    </ul>
  </aside>
</div>
<?php get_footer();?>