<article id="post-<?php the_ID();?>" <?php post_class(atc10k_class_list(['post-list' => !is_singular()]));?>>
  <?php if (!is_singular()): ?>
    <?php $category = atc10k_get_category(get_the_ID());?>
    <div class="post-list__thumbnail">
      <a class="post-list__thumbnail-link"
        href="<?php the_permalink();?>"
        title="<?php the_title_attribute();?>"
        style="background-image: url(<?php the_post_thumbnail_url()?>)">
      </a>
    </div>
    <div class="post-list__content">
      <header>
        <?php if (!empty($category)): ?>
          <h3>
            <a
                class="u-display-block u-hover-underline u-overline"
                href="?category_name=<?=$category->slug?>"><?=$category->name?></a>
          </h3>
        <?php endif;?>
        <h2 class="entry-title">
          <a
            class="u-header-2 u-hover-underline u-display-block"
            href="<?php the_permalink();?>"
            title="<?php the_title_attribute();?>"
            rel="bookmark"><?php the_title();?></a>
        </h2>
      </header>
      <?php get_template_part('entry', 'summary');?>
    </div>
  <?php else: ?>
    <?php get_template_part('entry', 'content');?>
    <?php if (!is_search()) {get_template_part('entry-footer');}?>
  <?php endif;?>
</article>