<?php
$q = new WP_Query(['post_type' => 'atc10k_sponsor', 'posts_per_page' => -1]);
?>
<section class="sponsor-list-large">
  <?php foreach ($q->posts as $post):
  $meta = get_post_meta($post->ID);
  $image = wp_get_attachment_image($meta['logo_color'][0], 'full', false, [
    'class' => 'sponsor__image',
    'alt' => $post->post_title,
  ]);?>
	    <a href="<?=$meta['url'][0]?>" class="sponsor-list-large__sponsor sponsor">
	      <h3 class="sponsor__slogan"><?=$meta['slogan'][0]?></h3>
	      <header class="sponsor__header">
	        <?php if ($image !== ''):
    echo $image;
  else: ?>
	          <h2 class="sponsor__title"><?=$post->post_title?></h2>
	        <?php endif;?>
      </header>
      <p class="sponsor__description"><?=$meta['description'][0]?></p>
      <p class="sponsor__cta-text">Visit <?=$post->post_title?></p>
    </a>
  <?php endforeach;?>
</section>

