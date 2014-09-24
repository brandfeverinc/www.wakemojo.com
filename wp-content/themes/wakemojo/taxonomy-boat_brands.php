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
                        <div class="boat-sort-buttons button-group">
                            <h2>Sort by</h2>
                          <button data-sort-by="price">Price</button>
                          <button data-sort-by="length">Length</button>
                          <button data-sort-by="weight">Weight</button>
                        </div>
                        <div class="board-container">
                        <?php if( have_posts() ){
                            while( have_posts() ){
                                the_post(); ?>
                                <div class="brand-container boat">
                                    <div class="sort-data">
                                        <div class="price"><?php the_field('price'); ?></div>
                                        <div class="length"><?php the_field('length'); ?></div>
                                        <div class="weight"><?php the_field('dry_weight'); ?></div>
                                    </div>
                                    <a href="<?php the_permalink(); ?>">
                                    <img class="brand-image board" src="<?php the_field('boat_image'); ?>">
                                    <p><?php the_title(); ?></p>
                                    </a>
                                    <a class="view-all-boards" href="<?php the_permalink(); ?>">More Info</a>
                                </div>
                            <?php }
                        } ?>
                    </div>
                  </div>
              </div>
          </div>
      </main>
  </div>
</div>
<div id="bottom-container">
    <div class="cta">
        <div class="wrap">
            <h2><a href="/contact-us/">Is there a boat you'd like to see on our site?</a></h2>
        </div>
    </div>
    <div class="contact-us">
        <a href="/contact-us/">Contact Us >></a>
    </div>

  <?php get_footer(); ?>