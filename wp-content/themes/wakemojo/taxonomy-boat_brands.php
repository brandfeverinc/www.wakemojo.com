<?php
/**
 *
 * @package WakeMojo
 */

get_header(); 
$term = $wp_query->queried_object; ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
        	<div class="logo"><a href="http://wakemojocom.wpengine.com"><img src="/wp-content/themes/wakemojo/img/logo.png"></a></div>
        	<div class="hero">
                <?php if(get_field('brand_hero_image', $term)){ ?>
        		  <img src="<?php the_field('brand_hero_image', $term); ?>">
                <?php }
                else{ ?>
                    <img src="/wp-content/themes/wakemojo/img/hero-2.jpg">  
                <?php } ?>
        	</div>
        	<div class="green-bar">
        		<div class="wrap">
        			<?php echo '<h1 class="page-title">'.$term->name.' boats</h1>'; ?>
        		</div>
        	</div>
            <div class="brands-loop">
                <div class="wrap">
                    <div class="inner-wrap">
                        <div class="board-brand-title">
                            <?php echo $term->name . ' boats'; ?>
                        </div>
                        <?php if( get_field('quote', $term) ){ ?>
                        <div class="quote">
                            "<?php the_field('quote', $term); ?>"
                        </div>
                        <?php } ?>
                        <?php if( get_field('brand_description', $term) ){ ?>
                        <div class="brand-blurb">
                            <?php the_field('brand_description', $term); ?>
                        </div>
                        <?php } ?>
                        <?php if( get_field('brand_website', $term) ){ ?>
                        <div class="brand-link">
                           <a target="_blank" href="<?php the_field('brand_website', $term); ?>">Read more on <?php echo $term->name . '\'s'; ?> website >></a>
                        </div>
                        <?php } ?>
                        <div class="boards-loop-title">
                            Browse <?php echo $term->name; ?> boats
                        </div>
                        <?php $args = array(
                            'post_type' => 'boats',
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'boat_brands',
                                    'terms'    => $term,
                                ),
                            ),
                        );
                        $query = new WP_Query( $args );
                        if( $query->have_posts() ){
                            while( $query->have_posts() ){
                                $query->the_post(); ?>
                                <div class="brand-container boat">
                                    <a href="<?php the_permalink(); ?>">
                                    <img class="brand-image board" src="<?php the_field('boat_image'); ?>">
                                    </a>
                                    <a class="view-all-boards" href="<?php the_permalink(); ?>">More Info</a>
                                </div>
                            <?php }
                        } ?>
                  </div>
              </div>
          </div>
      </main>
  </div>
</div>
<div id="bottom-container">
    <div class="cta">
        <div class="wrap">
            <h2><a href="#">Is there a boat you'd like to see on our site?</a></h2>
        </div>
    </div>
    <div class="contact-us">
        <a href="<?php the_field('page_cta_link'); ?>">Contact Us >></a>
    </div>

  <?php get_footer(); ?>