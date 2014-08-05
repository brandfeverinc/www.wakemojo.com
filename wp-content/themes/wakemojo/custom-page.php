<?php
// Template Name: Custom Page Layout
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php 
		$tab_count = 0;
		while(has_sub_field("flexible_content")){
			
			if(get_row_layout() == "text_box"){ ?>
				<div class="text"><?php the_sub_field("text_box"); ?> </div>
			<?php }

			elseif(get_row_layout() == "image"){ ?>
				<img src="<?php the_sub_field("image"); ?>">
			<?php }

			elseif(get_row_layout() == "file_upload"){ 
				while (have_rows('social_icons')) : the_row(); ?>
					<a href="<?php the_sub_field("social_link"); ?>"><img src="<?php the_sub_field("icon"); ?>"></a>
				<?php endwhile;
			}

			elseif(get_row_layout() == "youtube_embed"){
				the_sub_field("youtube_embed");
			}

			elseif(get_row_layout() == "google_maps_embed"){
				the_sub_field("google_maps_embed");
			}
		}

		the_content(); ?>
	</div>
</article>