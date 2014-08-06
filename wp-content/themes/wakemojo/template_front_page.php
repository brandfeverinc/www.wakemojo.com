<?php
/**
 * Template Name: Front Page
 *
 * @package WakeMojo
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
        	<div class="logo"><a href="http://wakemojocom.wpengine.com"><img src="/wp-content/themes/wakemojo/img/logo.png"></a></div>
        	<div class="hero">
        		<img src="<?php the_field('homepage_hero_image'); ?>">
        	</div>
        	<div class="green-bar">
        		<div class="wrap">
        			<div class="reference">
        				<h2><?php the_field('green_bar_text'); ?></h2>
        			</div>
        			<div class="blog-link">
        				<a href="#">
        					<div class="arrow"><img src="/wp-content/themes/wakemojo/img/blog-arrow.png"></div>
        					<div class="blog-link-text"><?php the_field('blog_link_text'); ?></div>
        				</a>
        			</div>
        		</div>
        	</div>
        	<div class="homepage-categories">
        		<div class="wrap">
        			<div class="featured-box boards">
        				<div class="image">
        					<img src="<?php the_field('boards_image'); ?>">
        				</div>
        				<div class="text">
        					<h2>Boards</h2>
        					<p><?php the_field('boards_text'); ?></p>
        					<a href="#"><div class="view-all">View All</div></a>
        				</div>
				    </div>
        			<div class="featured-box boats">
        				<div class="image">
        					<img src="<?php the_field('boats_image'); ?>">
        				</div>
        				<div class="text">
        					<h2>Boats</h2>
        					<p><?php the_field('boats_text'); ?></p>
        					<a href="#"><div class="view-all">View All</div></a>
        				</div>
				    </div>
        			<div class="featured-box gear">
        				<div class="image">
        					<img src="<?php the_field('gear_image'); ?>">
        				</div>
        				<div class="text">
        					<h2>Gear</h2>
        					<p><?php the_field('gear_text'); ?></p>
        					<a href="#"><div class="view-all">View All</div></a>
        				</div>
				    </div>
			     </div>
        	</div>
            <div class="homepage-cta">
                <div class="wrap">
                    <h2><a href="<?php the_field('cta_link'); ?>"><?php the_field('cta_text'); ?></a></h2>
                </div>
            </div>
            <div class="featured-posts">
                <div class="wrap">
                    <h2>Recent Posts</h2>
                    <?php $query = new WP_Query('cat=4'); ?>
                    <?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>
                    <?php static $count = 0;
                    if ($count == 4) { break; }
                    else { ?>
                    <div class="featured-post id-<?php echo $count; ?>">
                        <img class="border" src="/wp-content/themes/wakemojo/img/featured-top-border.png">
                        <div class="image">
                                <?php if ( has_post_thumbnail() ) { 
                                  ?> <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(array(232, 142, true)); ?></a><?php
                                } ?>
                        </div>
                        <div class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
                        <div class="content"><?php wp_trim_words( the_content(), 30 ) ?></div>
                        <div class="read-more"><a href="<?php the_permalink(); ?>">Read More</a></div>
                    </div>
                    <?php $count++; } endwhile; endif; ?>
                </div>
            </div>
        </main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer( 'homepage' ); ?>
