<?php
/**
 * Template Name: Boat Makers
 *
 * @package WakeMojo
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
        	<div class="logo"><a href="http://wakemojocom.wpengine.com"><img src="/wp-content/themes/wakemojo/img/logo.png"></a></div>
        	<div class="hero">
                <?php if(get_field('page_hero_image')){ ?>
        		  <img src="<?php the_field('page_hero_image'); ?>">
                <?php }
                else{ ?>
                    <img src="/wp-content/themes/wakemojo/img/hero-2.jpg">  
                <?php } ?>
        	</div>
        	<div class="green-bar">
        		<div class="wrap">
        			<h1 class="page-title"><?php the_title(); ?></h1>
        		</div>
        	</div>
            <div class="brands-loop">
                <div class="wrap">
                    <div class="inner-wrap">
                        <div class="board-container brands">
                    <?php
                    //list terms in a given taxonomy
                    $taxonomy = 'boat_brands';
                    $tax_terms = get_terms($taxonomy);
                    $brand_image = 'brand_image';
                    ?>
                    <?php
                    foreach ($tax_terms as $tax_term) { 
                    $term_link = get_term_link( $tax_term ); ?>
                       <div class="brand-container">
                            <?php echo '<a href="' . esc_url( $term_link ) . '">' ?>
                            <img class="brand-image" src="<?php the_field($brand_image, $tax_term); ?>">
                            <?php echo '</a>'; ?>
                            <?php echo '<a class="view-all-boards" href="' . esc_url( $term_link ) . '">View All</a>' ?>
                        </div> 
                    <?php }
                    ?>
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
            <h2><a href="<?php the_field('page_cta_link'); ?>"><?php the_field('page_cta_text'); ?></a></h2>
        </div>
    </div>
    <div class="contact-us">
        <a href="<?php the_field('page_cta_link'); ?>">Contact Us >></a>
    </div>

  <?php get_footer(); ?>