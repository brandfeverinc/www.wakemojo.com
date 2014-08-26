<?php
/**
 * This is the template for display all pages
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
        	<div class="page-content">
                <div class="brands-loop">
                    <div class="wrap">
                        <div class="inner-wrap page">
                            <?php if ( have_posts() ) : while ( have_posts() ) : the_post();
                            the_content();
                            endwhile; else: ?>
                            <p>Sorry, no posts matched your criteria.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
        	</div>
      </main>
  </div>
</div>
<div id="bottom-container">
    <?php if(get_field('page_cta_text')){ ?>
    <div class="cta">
        <div class="wrap">
            <h2><a href="<?php the_field('page_cta_link'); ?>"><?php the_field('page_cta_text'); ?></a></h2>
        </div>
    </div>
    <div class="contact-us">
        <a href="<?php the_field('page_cta_link'); ?>">Contact Us >></a>
    </div>
    <?php } ?>

  <?php get_footer(); ?>