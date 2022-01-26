<?php
$q = new WP_Query(['post_type' => 'atc10k_sponsor', 'posts_per_page' => -1]);
?>
<section class="sponsor-list-small">
  <header class="sponsor-list-small__header">
    <h2 class="sponsor-list-small__heading"><?php block_field('heading');?></h2>
    <h3 class="sponsor-list-small__blurb"><?php block_field('blurb');?></h3>
  </header>
  <div class="sponsor-list-small__list">
    <?php foreach ($q->posts as $post):
  $meta = get_post_meta($post->ID);
  $image_path = !empty($meta['logo_bw'][0]) ? $meta['logo_bw'][0] : $meta['logo_color'][0];
  $image = wp_get_attachment_image($image_path, 'full', false, [
    'class' => 'sponsor__image',
    'alt' => $post->post_title,
  ]);?>
	      <a href="<?=$meta['url'][0]?>" class="sponsor-list-small__sponsor sponsor">
	        <header class="sponsor__header">
	          <?php if ($image !== ''):
    echo $image;
  else: ?>
	            <h2 class="sponsor__title"><?=$post->post_title?></h2>
	          <?php endif;?>
        </header>
      </a>
    <?php endforeach;?>
  </div>
</section>

