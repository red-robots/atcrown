<section class="home-ctas">
  <?php for( $i = 1; $i <= 4; $i++): ?>
    <a class="home-ctas__cta" href="<? block_field('url-' . $i) ?>">
      <h3 class="home-ctas__cta-title"><? block_field('title-' . $i) ?></h3>
      <h4 class="home-ctas__cta-subtitle"><? block_field('text-' . $i) ?></h4>
    </a>
  <?php endfor; ?>
</section>