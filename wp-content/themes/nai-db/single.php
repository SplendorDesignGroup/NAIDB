<?php
/**
 * Single
 *
 * Loop container for single post content
 */
get_header();

if ( have_posts() ) :
	while ( have_posts() ) : the_post(); ?>
		<div class="top-block" style="background-image: url(<?php echo has_post_thumbnail() ? the_post_thumbnail_url() : bloginfo('template_url').'/images/default.png' ?>);">
			<div class="row columns">
				<?php $cats = get_the_category($post->ID);
				foreach( $cats as $one_cat ) : ?>
					<?php //var_dump($one_cat); ?>
					<h2><?php echo $one_cat->name; ?></h2>
				<?php endforeach; ?>
			</div>
			<?php dynamic_sidebar('Top Right Sidebar'); ?>
		</div>
		<div class="row">
			<article class="single-post">
					<div class="medium-8 medium-centered small-12 columns text-center">
						<h1 class="page-title"><?php the_title(); ?></h1>
					</div>
					<div class="medium-9 small-12 columns single-post-content">
						<p class="entry-meta"><?php the_time(get_option('date_format')); ?></p>
						<?php the_content('',true); ?>
					</div>
					<div class="medium-3 small-12 columns sidebar">
						<?php dynamic_sidebar('News Sidebar'); ?>
					</div>
					<div class="small-12 columns post-navigation text-center">
						<span class="prev-post"><?php echo get_previous_post_link( '%link', 'PREVIOUS', 1 ); ?></span>
						<a href="<?php echo get_site_url(); ?>">
							<img src="<?php bloginfo('template_url') ?>/images/post-icon.png" />
						</a>
						<span class="next-post"><?php echo get_next_post_link( '%link', 'NEXT', 1 ); ?></span>
					</div>
			</article>
		</div>
	<?php endwhile;
endif;

get_footer(); ?>