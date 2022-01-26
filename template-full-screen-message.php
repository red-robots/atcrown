<?php /* Template Name: Full Screen Message */
/**
 * The template for displaying a full screen message independent of any design
 *
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage ATC10K
 * @since 1.0
 * @version 1.0
 */

$meta = get_post_meta(get_the_ID());
$heading = $meta['heading'][0];
$sub_heading = $meta['sub-heading'][0];
$sub_heading_cta = $meta['sub-heading_cta_text'][0];

?>

<?php get_header(); ?>
  <style>


  </style>
  <div class="fulldisplay">
    <?php do_action('get_notices'); ?>
    <h1 class="fulldisplay__heading">
      <img class="fulldisplay__logo" src="<?= get_theme_file_uri( '/assets/images/logo/icon-circle.svg') ?>" /><br>
      <?= $heading ?>
    </h1>
    <h2 class="fulldisplay__subheading"><?= $sub_heading ?></h2>
    <p class="fulldisplay__cta"><?= $sub_heading_cta ?></p>
    <footer class="fulldisplay__footer">
      <h3 class="fulldisplay__footer-heading">Your inbox deserves better. Sign up to receive our newsletter.</h3>
      <?= atc10k_get_element('/email-capture') ?>
    </footer>
  </div>

<?php get_footer(); ?>

