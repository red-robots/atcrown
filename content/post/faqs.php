<?php

$category_meta_id = 'field_5c43a1dcde2cd';
$field_object = get_field_object('field_5c43a1dcde2cd');
$choices = $field_object['choices'];

$faq_title = get_post_meta(get_the_ID(), 'faq_title', true);

$choice_keys = array_keys($choices);
$choice_key = array_shift($choice_keys);
if (!empty($_GET['faq_category']) && array_key_exists($_GET['faq_category'], $choices)) {
  $choice_key = $_GET['faq_category'];
}

$q = new WP_Query([
  'post_type' => 'atc10k_faq',
  'nopaging' => true,
  'meta_key' => 'category',
  'meta_value' => $choice_key,
]);
?>

<section class="subpage-header">
  <div class="subpage-header__inner">
    <h1 class="subpage-header__parent">FAQS</h1>
    <h2 class="subpage-header__title"><?= $faq_title ?></h2>
  </div>
  <nav class="tabnav">
    <ul class="tabnav__list">
      <?php foreach ($choices as $key => $label): ?>
        <li
          class="tabnav__item<?= $key == $choice_key ? ' tabnav__item--current' : '' ?>"
        >
          <a
            class="tabnav__link<?= $key == $choice_key ? ' tabnav__link--current' : '' ?>"
            href="?faq_category=<?= $key ?>"
          ><?= $label ?></a>
        </li>
      <?php endforeach; ?>
    </ul>
  </nav>
</section>



<section class="faqlist">
  <header class="faqlist__header">
    <h2 class="faqlist__heading"><?= $choices[$choice_key] ?></h2>
  </header>
  <ul class="faqlist__list">
    <?php foreach ($q->posts as $post):
      $question = $post->post_title;
      $answer = get_post_meta($post->ID, 'answer')[0];
      ?>
      <li class="faqlist__item">
        <button class="faqlist__toggle js-faqlist-toggle">
          <h2 class="faqlist__question"><?= $question ?></h2>
          <span class="faqlist__answer"><?= $answer ?></span>
        </button>
      </li>
    <?php endforeach; ?>
  </ul>
</section>