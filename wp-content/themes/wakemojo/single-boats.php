<?php
/**
 *
 * @package WakeMojo
 */

get_header(); 
$term = $wp_query->queried_object; ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
        	<div class="logo"><a href="http://wakemojo.com"><img src="/wp-content/themes/wakemojo/img/logo.png"></a></div>
        	<div class="hero single">
            <div class="wrap">
                    <div class="board-image">
                        <img src="<?php the_field('boat_image');?>">
                    </div>
                    <div class="sidebar">
                        <div class="sidebar-top">
                            <h2 class="brand-name"><?php echo get_the_term_list( $post->ID, 'boat_brands' ); ?></h2>
                            <h3 class="board-title"><?php the_title(); ?></h3>
                            <?php if( get_field('sidebar_description') ){ ?>
                                <div class="summary">
                                    <?php the_field('sidebar_description'); ?>
                                </div>
                            <?php } ?>
                            <?php if( get_field('engine') ){ ?>
                                <div class="fins">
                                    <span class="fins-title">Engine: </span><?php the_field('engine'); ?>
                                </div>
                           <?php } ?>
                           <?php if( get_field('horsepower') ){ ?>
                                <div class="shaped-by">
                                    <span class="shaped-by-title">Horsepower: </span><?php the_field('horsepower'); ?>
                                </div>
                           <?php } ?>
                           <?php if( get_field('length') ){ ?>
                                <div class="shaped-by">
                                    <span class="shaped-by-title">Length: </span><?php the_field('length'); ?>'
                                </div>
                           <?php } ?>
                           <?php if( get_field('dry_weight') ){ ?>
                                <div class="shaped-by">
                                    <span class="shaped-by-title">Dry Weight: </span><?php the_field('dry_weight'); ?>lbs
                                </div>
                           <?php } ?>
                           <?php if( get_field('capacity') ){ ?>
                                <div class="shaped-by">
                                    <span class="shaped-by-title">Passenger Capacity: </span><?php the_field('capacity'); ?>
                                </div>
                           <?php } ?>
                           <?php if( have_rows('features') ){ ?>
                                <div class="construction-features">
                                    <div class="cf-title">Construction Features</div>
                                    <?php while( have_rows('features') ){
                                        the_row();
                                        ?><div><?php the_sub_field('feature'); ?></div><?php
                                    }
                                ?></div><?php
                           } ?>
                           <?php if( get_field('price') ){ ?>
                               <div class="price-display">
                                   <span class="fins-title">Price: $<?php echo number_format( get_field('price') ); ?></span>
                               </div>
                           <?php } ?>
                        </div>
                        <div class="sidebar-bottom">
                            <?php if( get_field('manufacturer_link') ){ ?>
                                <a target="_blank" href="<?php the_field('manufacturer_link'); ?>">Read more on manufacturer website >></a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
        	</div>
        	<div class="green-bar">
        		<div class="wrap">
        			<h1 class="page-title"><?php the_title(); ?> Review</h1>
        		</div>
        	</div>
            <div class="brands-loop">
                <div class="wrap">
                    <div class="inner-wrap review">
                        <?php 
                        $images = get_field('image_gallery');
                        if( $images ){ ?>
                            <div class="image-gallery">
                                <?php foreach( $images as $image ){ ?>
                                    <div class="image-container">
                                        <a class="fancybox" rel="group" href="<?php echo $image['url']; ?>">
                                            <img src="<?php echo $image['sizes']['thumbnail']; ?>">
                                        </a>
                                    </div>
                                <?php } ?>
                            </div>
                        <?php } ?>
                        <h2>Official Review</h2>
                        <h3><?php echo get_the_term_list( $post->ID, 'boat_brands' ); ?> <?php the_title(); ?></h3>
                        <?php if( get_field('review_summary') ){ ?>
                            <div class="bottom-summary">
                                <?php the_field('review_summary'); ?>
                            </div>
                        <?php } ?>
                        <div class="rating-container">
                            <?php if( get_field('rating') != 0 ){ ?>
                                <div class="rating-title"><h2>Overall Rating</h2></div>
                            <?php } ?>
                            <div class="rating">
                                <?php
                                $rating = get_field('rating');
                                if( $rating == 1 ){
                                    echo '<img src="/wp-content/themes/wakemojo/img/1-star.png">';
                                }
                                elseif( $rating == 2){
                                    echo '<img src="/wp-content/themes/wakemojo/img/2-stars.png">';
                                }
                                elseif( $rating == 3){
                                    echo '<img src="/wp-content/themes/wakemojo/img/3-stars.png">';
                                }
                                elseif( $rating == 4){
                                    echo '<img src="/wp-content/themes/wakemojo/img/4-stars.png">';
                                }
                                elseif( $rating == 5){
                                    echo '<img src="/wp-content/themes/wakemojo/img/5-stars.png">';
                                } ?>
                            </div>
                        </div>
                        <?php if( get_field('full_review') ){ ?>
                        <div class="expand">
                            <h3>Expand for full review</h3>
                            <img src="/wp-content/themes/wakemojo/img/green-arrow.png">
                        </div>
                        <div class="review-content">
                            <?php the_field('full_review'); ?>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
      </main>
  </div>
</div>
<div id="bottom-container">
    <div class="cta">
        <div class="wrap">
            <h2><a href="/submit-boat-review/">Submit a Boat Review</a></h2>
        </div>
    </div>
    <div class="contact-us">
        <a href="/submit-boat-review/">Contact Us >></a>
    </div>

  <?php get_footer(); ?>