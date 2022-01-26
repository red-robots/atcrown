<?php
$blurb = get_post_meta(get_the_ID(), 'blurb');
global $post;
?>
<header class="subpage-header">
  <div class="subpage-header__inner">
    <h2 class="subpage-header__parent">
      <a href="<?= get_the_permalink($post->post_parent) ?>">
        <?= get_the_title($post->post_parent) ?>
      </a>
    </h2>
    <h1 class="subpage-header__title"><?php the_title(); ?></h1>
    <?php if (!empty($blurb)): ?>
      <p class="subpage-header__blurb"><?= $blurb[0] ?></p>
    <?php endif; ?>
  </div>
</header>
