<div class="entry-content">
  <?php if (has_post_thumbnail()): ?>
    <div class="entry-content__thumbnail u-banner"
      style="background-image: url(<?php the_post_thumbnail_url();?>)"
    ></div>
  <?php endif;?>
  <div class="entry-content__body body-content">
    <?php the_content();?>
  </div>
  <div class="entry-links"><?php wp_link_pages();?></div>
</div>