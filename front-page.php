<?php
/**
 * The template for homepage
 *
 */
get_header();
?>

<section id="content" role="main" data-type="page">
  <?php get_template_part('parts/home-hero'); ?>
  <?php while ( have_posts() ) : the_post(); ?>

    <?php if( have_rows('row2_blocks') ) { ?>
    <section class="home-ctas">
      <?php while( have_rows('row2_blocks') ) : the_row(); ?>
        <?php  
        $title = get_sub_field('title');
        $text = get_sub_field('description');
        $link = get_sub_field('link');
        $pagelink = (isset($link['url']) && $link['url']) ? $link['url'] : 'javascript:void(0)';
        ?>
        <a class="home-ctas__cta" href="<?php echo $pagelink ?>">
          <?php if ($title) { ?>
          <h3 class="home-ctas__cta-title"><?php echo $title ?></h3>
          <?php } ?>
          <?php if ($text) { ?>
          <h4 class="home-ctas__cta-subtitle"><?php echo $text ?></h4>
          <?php } ?>
        </a>
      <?php endwhile; ?>
    </section>
    <?php } ?>

    <?php
    $row3Img = get_field("row3_imagebg");
    $row3_author = get_field("row3_author");
    $row3_quote = get_field("row3_quote");
    $row3Link = get_field("row3_link");
    $r3Link = ( isset($row3Link['url']) && $row3Link['url'] ) ? $row3Link['url'] : '';
    $r3Text = ( isset($row3Link['title']) && $row3Link['title'] ) ? $row3Link['title'] : '';
    $r3Target = ( isset($row3Link['target']) && $row3Link['target'] ) ? $row3Link['target'] : '_self';
    $row3_content = array($row3_author,$row3_quote,$row3Link);
    $r3Style = ($row3Img) ? ' style="background-image:url('.$row3Img['url'].')"' : '';
    
    if($row3_content && array_filter($row3_content)) { ?>
    <section class="home-quote"<?php echo $r3Style ?>>
      <?php if ($row3_author) { ?>
      <cite class="home-quote__author"><?php echo $row3_author ?></cite>
      <?php } ?>
      <?php if ($row3_quote) { ?>
      <blockquote class="home-quote__quote"><?php echo $row3_quote ?></blockquote>
      <?php } ?>
      <?php if ($r3Text && $r3Link) { ?>
      <a class="home-quote__cta" href="<?php echo $r3Link ?>" target="<?php echo $r3Target ?>"><?php echo $r3Text ?></a>
      <?php } ?>
    </section>
    <?php } ?>

    <?php
    $sponsors = get_field("sponsors");
    $row4_heading = get_field("row4_heading");
    $row4_blurb = get_field("row4_blurb");
    if($sponsors || $row4_heading || $row4_blurb) { ?>
    <section class="sponsor-list-small">
      <?php if($row4_heading || $row4_blurb) { ?>
      <header class="sponsor-list-small__header">
        <?php if ($row4_heading){ ?>
          <h2 class="sponsor-list-small__heading"><?php echo $row4_heading ?></h2>
        <?php } ?>
        <?php if ($row4_blurb){ ?>
          <h3 class="sponsor-list-small__blurb"><?php echo $row4_blurb ?></h3>
        <?php } ?>
      </header>
      <?php } ?>

      <?php if($sponsors) { ?>
      <div class="sponsor-list-small__list">
        <?php foreach ($sponsors as $s) { 
          $img_id = $s['ID'];
          $imgLink = get_field("attachment_website_url",$img_id);
          $brandLink = ($imgLink) ? $imgLink : 'javascript:void(0)';
          $brandTarget = ($imgLink) ? '_blank':'_self';
        ?>
        <a href="<?php echo $brandLink ?>" target="<?php echo $brandTarget ?>" class="sponsor-list-small__sponsor sponsor">
          <header class="sponsor__header">
            <img width="<?php echo $s['width'] ?>" height="<?php echo $s['height'] ?>" src="<?php echo $s['url'] ?>" alt="<?php echo $s['title'] ?>">
          </header>
        </a>
        <?php } ?>
      </div>
      <?php } ?>
    </section>
    <?php } ?>

  <?php endwhile;  ?>
</section>

<?php
get_footer();