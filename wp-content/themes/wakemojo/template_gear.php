<?php
/**
 * Template Name: Gear
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
                        <div class="board-brand-title">
                           Gear
                        </div>
                        <div class="filter-buttons">
                            <h2>Filter By - </h2>
                            <div class="all" data-filter="*">All</div>
                            <div class="vests-button" data-filter=".vests">Vests</div>
                            <div class="board-bags-button" data-filter=".board-bags">Board Bags</div>
                            <div class="fins-button" data-filter=".fins">Fins</div>
                            <div class="boat-accessories-button" data-filter=".boat-accessories">Boat Accessories</div>
                        </div>
                        <div class="board-container gear">
                            <?php $args = array(
                                'post_type' => 'gear',
                            );
                            $query = new WP_Query( $args );
                            if( $query->have_posts() ){
                                while( $query->have_posts() ){
                                    $query->the_post(); ?>
                                    <div class="brand-container gear <?php the_field('category'); ?>">
                                        <a href="<?php the_permalink(); ?>">
                                        <img class="brand-image board" src="<?php the_field('image'); ?>">
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
    

  <?php get_footer(); ?>