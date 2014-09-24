<?php //Template Name: Blog 


get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
        	<div class="logo"><a href="http://wakemojo.com"><img src="/wp-content/themes/wakemojo/img/logo.png"></a></div>
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
                    <div class="inner-wrap blog">
						<?php $args = array(
						    'post_type' => 'post',
						);
						$query = new WP_Query( $args );
						if( $query->have_posts() ){
						    while( $query->have_posts() ){
						        $query->the_post(); ?>
						        <div class="post-container">
						        	<div class="image">
						        		<?php the_post_thumbnail(); ?>
						        	</div>
						        	<div class="content">
						        		<h2><?php the_title(); ?></h2>
						        		<h3><?php the_date('F j, Y'); ?></h3>
						        		<?php the_content(); ?>
						        	</div>
						        </div> <?php
						    }
						} ?>
                  </div>
              </div>
          </div>
      </main>
  </div>
</div>
<div id="bottom-container">
  <?php get_footer(); ?>