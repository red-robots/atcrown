<div class="entry-summary">
  <?php strip_tags(the_excerpt());?>
  <?php if (is_search()) {?>
    <div class="entry-links"><?php wp_link_pages();?></div>
  <?php }?>
</div>