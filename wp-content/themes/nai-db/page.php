<?php
/**
 * Page
 */
get_header();

if ( have_posts() ) :
	while ( have_posts() ) : the_post(); ?>
		<div class="top-block" style="background-image: url(<?php echo has_post_thumbnail() ? the_post_thumbnail_url() : bloginfo('template_url').'/images/default.png' ?>);">
			<div class="row columns">
				<?php $post_parent = $post->post_parent;
				if( $post_parent ): ?>
					<h2><?php echo get_the_title($post_parent); ?></h2>
				<?php else: ?>
					<h2><?php the_title(); ?></h2>
				<?php endif; ?>
			</div>
			<?php dynamic_sidebar('Top Right Sidebar'); ?>
		</div>
		<article class="row single-page">
			<h1 class="page-title columns"><?php the_title(); ?></h1>
			<div class="small-12 columns single-post-content">
				<?php the_content('',true); ?>
			</div>
		</article>
	<?php endwhile;
endif;

get_footer(); ?>