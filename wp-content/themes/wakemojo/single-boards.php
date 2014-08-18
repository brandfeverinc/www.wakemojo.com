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
        	<div class="hero single">
            <div class="wrap">
                    <div class="board-image">
                        <img src="<?php the_field('board_image');?>">
                    </div>
                    <div class="sidebar">
                        <div class="sidebar-top">
                            <h2 class="brand-name"><?php echo get_the_term_list( $post->ID, 'brand' ); ?></h2>
                            <h3 class="board-title"><?php the_title(); ?></h3>
                            <div class="team-size">
                                <?php if( get_field('team_rider_tested')){ ?>
                                    <span class="team-rider">Team rider tested - </span>
                                <?php } ?>
                                <?php if( get_field('sizes') ){ ?>
                                    <span class="size">Sizes <?php the_field('sizes'); ?></span>
                                <?php } ?>
                            </div>
                            <?php if( get_field('sidebar_description') ){ ?>
                                <div class="summary">
                                    <?php the_field('sidebar_description'); ?>
                                </div>
                            <?php } ?>
                            <?php if( get_field('fins') ){ ?>
                                <div class="fins">
                                    <span class="fins-title">Fins: </span><?php the_field('fins'); ?>
                                </div>
                           <?php } ?>
                           <?php if( get_field('shaped_by') ){ ?>
                                <div class="shaped-by">
                                    <span class="shaped-by-title">Shaped By: </span><?php the_field('shaped_by'); ?>
                                </div>
                           <?php } ?>
                           <?php if( have_rows('construction_features') ){ ?>
                                <div class="construction-features">
                                    <div class="cf-title">Construction Features</div>
                                    <?php while( have_rows('construction_features') ){
                                        the_row();
                                        ?><div><?php the_sub_field('feature'); ?></div><?php
                                    }
                                ?></div><?php
                           } ?>
                        </div>
                        <div class="sidebar-bottom">
                            <?php if( get_field('manufacturer_link') ){ ?>
                                <a href="<?php the_field('manufacturer_link'); ?>">Read more on manufacturer website >></a>
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
                        <h3><?php echo get_the_term_list( $post->ID, 'brand' ); ?> <?php the_title(); ?></h3>
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
                                elseif( $rating == 2 ){
                                    echo '<img src="/wp-content/themes/wakemojo/img/2-stars.png">';
                                }
                                elseif( $rating == 3 ){
                                    echo '<img src="/wp-content/themes/wakemojo/img/3-stars.png">';
                                }
                                elseif( $rating == 4 ){
                                    echo '<img src="/wp-content/themes/wakemojo/img/4-stars.png">';
                                }
                                elseif( $rating == 5 ){
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
            <h2><a href="#">Want us to review your product?</a></h2>
        </div>
    </div>
    <div class="contact-us">
        <a href="<?php the_field('page_cta_link'); ?>">Contact Us >></a>
    </div>

  <?php get_footer(); ?>