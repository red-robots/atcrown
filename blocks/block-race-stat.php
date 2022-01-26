<?php
$icon_path = block_field('icon', false);
$description = block_field('description', false);

?>
<section class="racestat">
  <header class="racestat__header">
    <?php if (!empty($icon_path)): ?>
      <div class="racestat__banner">
        <img class="racestat__icon" src="<?= $icon_path ?>" alt="" />
      </div>
    <?php endif; ?>
    <div class="racestat__heading"><?php block_field('heading'); ?></div>
  </header>
  <div class="racestat__content">
    <?= str_replace("\n", '<br/>', $description) ?>
  </div>
</section>

