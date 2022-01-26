<?php
$v = atc10k_get_constant('EVENT_DATE');
$t = strtotime($v);

?>
<section class="hero">
  <?php if (!empty($v) && $t > time()): ?>
    <div class="hero__countdown countdown js-countdown" data-date="<?= date('Y-m-d', $t) . 'T' . date('H:i:s', $t) ?>">
      <header class="countdown__header">
        <h3 class="countdown__heading">LET THE COUNT DOWN BEGIN: <?= date('F j, Y', $t); ?></h3>
      </header>
      <div class="countdown__content js-countdown-content"></div>
    </div>
  <?php endif; ?>

  <div class="hero__inner">
    <h2 class="hero__preheading"><? block_field('preheading') ?></h2>
    <h1 class="hero__heading"><? block_field('heading') ?></h1>
    <h3 class="hero__subheading"><? block_field('subheading') ?></h3>
    <a href="<?php  block_field('cta-url') ?>" class="hero__cta"><?php block_field('cta-text') ?></a>
  </div>
</section>