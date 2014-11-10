<?php
/**
 * Template Name: Boards
 * @package WakeMojo
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
        	<div class="logo"><a href="http://wakemojocom.wpengine.com"><img src="/wp-content/themes/wakemojo/img/logo.png"></a></div>
        	<div class="hero">
                <?php if(get_field('brand_hero_image')){ ?>
        		  <img src="<?php the_field('brand_hero_image'); ?>">
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
                        <div class="sort-buttons">
                            <h2>Sort By - </h2>
                            <div class="sort-by">Style</div>
                            <div class="option-set style" data-group="style">
                                <input type="checkbox" value=".Surf" id="wave" />
                                <label for="wave">Surf</label>
                                <input type="checkbox" value=".Skim" id="skim" />
                                <label for="skim">Skim</label>
                                <input type="checkbox" value=".Hybrid" id="hybrid" />
                                <label for="hybrid">Hybrid</label>
                            </div>
                            <div class="sort-by">Skill Level</div>
                            <div class="option-set skill-level" data-group="skill-level">
                                <input type="checkbox" value=".beginner" id="beginner" />
                                <label for="beginner">Beginner</label>
                                <input type="checkbox" value=".intermediate" id="intermediate" />
                                <label for="intermediate">Intermediate</label>
                                <input type="checkbox" value=".expert" id="expert" />
                                <label for="expert">Expert</label>
                            </div>
                            <div class="sort-by">Weight Range</div>
                            <div class="option-set weight-range" data-group="weight-range">
                                <input type="checkbox" value=".w-100" id="w-100" />
                                <label for="w-100">Up to 100 lbs</label>
                                <input type="checkbox" value=".w-150" id="w-150" />
                                <label for="w-150">Up to 150 lbs</label>
                                <input type="checkbox" value=".w-200" id="w-200" />
                                <label for="w-200">Up to 200 lbs</label>
                                <input type="checkbox" value=".w-250" id="w-250" />
                                <label for="w-250">Up to 250 lbs</label>
                                <input type="checkbox" value=".w-max" id="w-max" />
                                <label for="w-max">250+ lbs</label>
                            </div>
                        </div>
                        <div class="board-container">
                            <?php $args = array(
                                'post_type' => 'boards',
                                'posts_per_page' => 9999,
                            );
                            $query = new WP_Query( $args );
                            if( $query->have_posts() ){
                                while( $query->have_posts() ){
                                    $query->the_post(); 
                                    $terms = get_the_term_list( $post->ID, 'brand' );
                                    $terms = strip_tags( $terms ); ?>
                                    <div class="brand-container <?php the_field('skill_level'); ?> <?php the_field('weight_range'); ?> <?php the_field('style'); ?> <?php the_field('price'); ?>">
                                        <a href="<?php the_permalink(); ?>">
                                        <img class="brand-image board" src="<?php the_field('board_image'); ?>">
                                        <p><?php echo $terms; ?> <?php the_title(); ?></p>
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
            <h2><a href="#">Is there a board you'd like to see on our site?</a></h2>
        </div>
    </div>
    <div class="contact-us">
        <a href="<?php the_field('page_cta_link'); ?>">Contact Us >></a>
    </div>

  <?php get_footer(); ?>