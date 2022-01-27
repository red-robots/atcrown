<?php
/*
 * Template Name: Our Sponsors
 */
function get_content($name, $dir) {
  $ds = DIRECTORY_SEPARATOR;
  $path = __DIR__ . $ds . 'content' . $ds . $dir . $ds . $name . '.php';
  if (file_exists($path)) {
    require_once $path;
  }
}
?>
<?php get_header();?>
<section id="content" role="main" data-type="page">
<?php do_action('get_notices');?>
<?php if (have_posts()): ?>
  <?php while (have_posts()): ?>
    <?php the_post();?>
  <article id="post-<?php the_ID();?>" <?php post_class();?>>
    <?php if (is_page()) {
      if ($post->post_parent) {
        echo atc10k_get_element('/layout/subpage-header');
      } else {
        echo atc10k_get_element('/layout/rootpage-header');
      }
    }?>
    
    <?php if ( get_the_content() || has_post_thumbnail() ) { ?>
     <section class="entry-content body-content">
      <?php if (has_post_thumbnail()) { the_post_thumbnail(); }?>
      <?php the_content();?>
      <div class="entry-links"><?php wp_link_pages();?></div>
    </section>
    <?php } ?>
  </article>
  <?php //if (!post_password_required()) {comments_template('', true);}?>
  <?php endwhile;?>
<?php endif;?>

  <?php
  $args = array(
    'posts_per_page'=> -1,
    'post_type'     => 'atc10k_sponsor',
    'post_status'   => 'publish',
  );
  $placeholder = get_bloginfo('template_url') .'/assets/images/rectangle-lg.png';
  $sponsors = new WP_Query($args);
  if ( $sponsors->have_posts() ) {  ?>
  <div class="sponsors-section">
    <div class="wrapper">
      <div class="inner">
      <?php while ( $sponsors->have_posts() ) : $sponsors->the_post(); 
        $postid = get_the_ID();
        $logo = get_field("logo_color");
        $terms = get_the_terms($postid,'sponsor-categories');
        $types = array('tier-1','tier-2');
        $has_more_info = '';
        $tier_type = '';
        if($terms) {
          $tier_type = $terms[0]->slug;
          foreach($terms as $term) {
            $cat = $term->slug;
            if( in_array($cat,$types) ) {
              $has_more_info = true;
            }
          }
        }
        if($logo) { ?>
        <div class="sponsor-logo<?php echo ($tier_type) ? ' cat_'.$tier_type.' ':'' ?><?php echo ($has_more_info) ? 'has-info':''; ?>">
          <?php if ($has_more_info) { ?>
            <a href="javascript:void(0)" data-id="<?php echo $postid ?>" class="link sponsorInfo" style="background-image:url('<?php echo $logo['url'] ?>')">
              <img src="<?php echo $placeholder ?>" alt="">
            </a>
          <?php } else { ?>
            <figure class="link" style="background-image:url('<?php echo $logo['url'] ?>')">
              <img src="<?php echo $placeholder ?>" alt="">
            </figure>
          <?php } ?>
        </div>
        <?php } ?>
      <?php endwhile; wp_reset_postdata(); ?>
      </div>
    </div>
  </div>
  <?php } ?>
</section>
<div id="sponsor-details-popup" style="display:none">
  <div class="sponsor-wrap animated">
    <a href="javascript:void(0)" id="close-info">close</a>
    <div id="sponsor-details" class="sponsor-content"></div>
  </div>
</div>
<script type="text/javascript">
jQuery(document).ready(function($){
  $("#sponsor-details-popup").appendTo('body');
});
</script>
<?php get_footer();?>