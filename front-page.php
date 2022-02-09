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
    
    // $row3_author = get_field("row3_author");
    // $row3_quote = get_field("row3_quote");
    $row3Events = get_field("row3_events");
    $upcomingEvents = get_field('');
    // $row3Link = get_field("row3_link");
    // $r3Link = ( isset($row3Link['url']) && $row3Link['url'] ) ? $row3Link['url'] : '';
    // $r3Text = ( isset($row3Link['title']) && $row3Link['title'] ) ? $row3Link['title'] : '';
    // $r3Target = ( isset($row3Link['target']) && $row3Link['target'] ) ? $row3Link['target'] : '_self';
    //$row3_content = array($row3_author,$row3_quote,$row3Events);

    $row3Img = get_field("row3_imagebg");
    $r3Style = ($row3Img) ? ' style="background-image:url('.$row3Img['url'].')"' : '';
    
    if( $row3Events ) { ?>
    <section id="home-upcoming-events" class="home-quote"<?php echo $r3Style ?>>
      <div class="wrapper">
        <div class="flexwrap">
          <?php foreach ($row3Events as $e) { 
            $title = $e['title'];
            $date = $e['date'];
            $link = $e['link'];
            $bLink = ( isset($link['url']) && $link['url'] ) ? $link['url'] : '';
            $bText = ( isset($link['title']) && $link['title'] ) ? $link['title'] : '';
            $bTarget = ( isset($link['target']) && $link['target'] ) ? $link['target'] : '_self';
            $openLink = '<div class="eventLink">';
            $closeLink = '</div';
            if($bLink) {
              $openLink = '<a href="'.$bLink.'" target="'.$bTarget.'" class="eventLink">';
              $closeLink = '</a>';
            }
            if($title || $date) { ?>
              <div class="event">
                <?php echo $openLink ?>
                <?php if ($date) { ?>
                  <div class="date"><?php echo $date ?></div>
                <?php } ?>
                <?php if ($title) { ?>
                  <div class="title"><?php echo $title ?></div>
                <?php } ?>

                <?php if ($bText && $bLink) { ?>
                <span class="event-button">
                  <span class="ebtn"><?php echo $bText ?></span>
                </span> 
                <?php } ?>

                <?php echo $closeLink ?>

                
              </div> 
           <?php } ?>
          <?php } ?>
        </div>
      </div>
    </section>
    <?php } ?>

    <?php
    //$sponsors = get_field("sponsors");
    $sponsorsList = get_field("sponsorsList");
    $row4_heading = get_field("row4_heading");
    $row4_blurb = get_field("row4_blurb");

    if($sponsorsList || $row4_heading || $row4_blurb) { ?>
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

      <?php if($sponsorsList) { 
        $args = array(
          'posts_per_page'=> -1,
          'post_type'     => 'atc10k_sponsor',
          'post_status'   => 'publish',
          'tax_query'     => [
            [
              'taxonomy'=>'sponsor-categories',
              'field'=>'term_id',
              'terms'=>$sponsorsList
            ]
          ]
        );
        $sponsors = get_posts($args);
        $show_old_format = false;
        if($show_old_format) { ?>
        <div class="sponsor-list-small__list">
          <?php foreach ($sponsors as $s) { 
            $pid = $s->ID;
            $imgLink = get_field("url",$pid);
            $brandLink = ($imgLink) ? $imgLink : 'javascript:void(0)';
            $img = get_field('logo_bw',$pid);
            if($img) { ?>
            <a href="<?php echo $brandLink ?>" target="_blank" class="sponsor-list-small__sponsor sponsor">
              <header class="sponsor__header">
                <img width="<?php echo $img['width'] ?>" height="<?php echo $img['height'] ?>" src="<?php echo $img['url'] ?>" alt="<?php echo $img['title'] ?>">
              </header>
            </a>
            <?php } ?>
          <?php } ?>
        </div>
        <?php } ?>

      <div class="sponsors-carousel">
        <div id="sponsors-slider" class="owl-carousel owl-theme">
          <?php foreach ($sponsors as $s) { 
            $pid = $s->ID;
            $imgLink = get_field("url",$pid);
            $brandLink = ($imgLink) ? $imgLink : 'javascript:void(0)';
            $img = get_field('logo_bw',$pid);
            if($img) { ?>
            <a href="<?php echo $brandLink ?>" target="_blank" class="sponsor-list-small__sponsor sponsor">
              <header class="sponsor__header">
                <img width="<?php echo $img['width'] ?>" height="<?php echo $img['height'] ?>" src="<?php echo $img['url'] ?>" alt="<?php echo $img['title'] ?>">
              </header>
            </a>
            <?php } ?>
          <?php } ?>
        </div>
      </div>

      <?php } ?>
    </section>
    <?php } ?>

  <?php endwhile;  ?>
</section>

<?php
get_footer();