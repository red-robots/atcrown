<?php
$banner_image = get_field('banner_image');
$btn = get_field('banner_button');
$btnLink = ( isset($btn['url']) && $btn['url'] ) ? $btn['url'] : ''; 
$btnText = ( isset($btn['title']) && $btn['title'] ) ? $btn['title'] : ''; 
$btnTarget = ( isset($btn['target']) && $btn['target'] ) ? $btn['target'] : '_self'; 

$text_sm = get_field('banner_text_sm');
$text_lg = get_field('banner_text_lg');
$text_md = get_field('banner_text_md');
$has_text = array($text_sm,$text_lg,$text_md);
if($banner_image) { ?>
<section class="hero" style="background-image:url('<?php echo $banner_image['url'] ?>')">

  <?php if ( $btn || ($has_text && array_filter($has_text)) ) { ?>
  <div class="hero__inner">
    <?php if ($text_sm) { ?>
      <h2 class="hero__preheading"><?php echo $text_sm ?></h2>
    <?php } ?>
    <?php if ($text_lg) { ?>
      <h1 class="hero__heading"><?php echo $text_lg ?></h1>
    <?php } ?>
    <?php if ($text_md) { ?>
      <h3 class="hero__subheading"><?php echo $text_md ?></h3>
    <?php } ?>

    <?php if ($btnText && $btnLink) { ?>
      <a href="<?php echo $btnLink ?>" target="<?php echo $btnTarget ?>" class="hero__cta"><?php echo $btnText ?></a>
    <?php } ?>
  </div>
  <?php } ?>

</section>
<?php } ?>