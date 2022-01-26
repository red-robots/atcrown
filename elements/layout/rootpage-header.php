<?php
$meta = get_post_meta(get_the_ID());

if (empty($meta['top_title']) || empty($meta['heading'])) {
  return '';
}

$title = !empty($meta['top_title']) && !empty($meta['top_title'][0]) ? $meta['top_title'][0] : get_the_title();
$heading = $meta['heading'][0];
$sub_heading = $meta['sub-heading'][0];
$sub_heading_cta_text = $meta['sub-heading_cta_text'][0];
$sub_heading_cta_url = $meta['sub-heading_cta_url'][0];

if (empty($heading)) {
  return '';
}

$banner_style = '';
if ($image_id = $meta['heading_image'][0]) {
  $image = wp_get_attachment_image_src($image_id, 'full');
  list ($src, $w, $h) = $image;
  $banner_style = 'background-image:url(' . $src . ');';
}

if (!empty($sub_heading_cta_url) && !empty($sub_heading_cta_text)) {
  $sub_heading .= sprintf(' <a href="%s">%s</a>', $sub_heading_cta_url, $sub_heading_cta_text);
}
?>
<header class="rootpage-header">
  <div class="rootpage-header__inner">
    <div class="rootpage-header__banner" style="<?= $banner_style ?>"></div>
    <div class="rootpage-header__content">
      <h1 class="rootpage-header__title"><?= $title ?></h1>
      <h2 class="rootpage-header__heading"><?= $heading ?></h2>
      <h3 class="rootpage-header__subheading"><?= $sub_heading ?></h2>
    </div>
  </div>
</header>
