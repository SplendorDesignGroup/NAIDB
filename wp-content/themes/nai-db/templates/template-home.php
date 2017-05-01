<?php
/**
 * Template Name: Home Page
 */
get_header(); ?>

	<div class="row">
		<!--HOME PAGE SLIDER-->
		<?php echo home_slider_template(); ?>
		<!--END of HOME PAGE SLIDER-->
	</div>

	<!-- BEGIN of main content -->
	<?php if ( have_posts() ) :
		while ( have_posts() ) : the_post();
			//hero block
			if (have_rows('all_hero_blocks')) : ?>
				<div class="gray-back">
					<div class="row row-hero">
						<?php while(have_rows('all_hero_blocks')) : the_row();
							$width = get_sub_field('width');
							$height = get_sub_field('height');
							$type = get_sub_field('type');
							$background_image = get_sub_field('background_image');
							$icon = get_sub_field('icon');
							$title = get_sub_field('title');
							$video_link = get_sub_field('video_link');
							$text = get_sub_field('text');
							$link = get_sub_field('link');
							?>
							<div class="hero-grid-item
							hero-grid-item-width-<?php echo $width; ?>
							hero-grid-item-height-<?php echo $height; ?>
							type-<?php echo $type; ?>"
								 style="background-image: url(<?php echo $background_image['sizes']['large']; ?>);">
								<?php
								//text
								if ( $type == '1') : ?>
									<a href="<?php echo $link; ?>">
										<div class="info">
											<?php if ( $title ) : ?>
												<h3 class="<?php echo $text ? '' : 'no-text'; ?>"><?php echo $title; ?></h3>
											<?php endif;
											if ( $text ) : ?>
												<p><?php echo $text; ?></p>
											<?php endif; ?>
										</div>
									</a>
								<?php endif;
								//video
								if ( $type == '2' && $video_link ) : ?>
									<a class="iframe" href="<?php echo $video_link; ?>" ></a>
								<?php endif;
								//map
								if ( $type == '3' ) : ?>
									<a href="<?php echo $link; ?>">
										<div class="info text-center">
											<div class="text-left info-title">
												<?php if ( $title ) : ?>
													<h3><?php echo $title; ?></h3>
												<?php endif;
												if ( $icon ) : ?>
													<img src="<?php echo $icon['sizes']['thumbnail']; ?>" />
												<?php endif; ?>
											</div>
										</div>
									</a>
								<?php endif; ?>
							</div>
						<?php endwhile; ?>
					</div>
				</div>
			<?php endif;
			//updates
			if ( get_field('display_updates_section_on_this_page') == '1' ) :
			    get_template_part('parts/updates');
			endif;
			//sign-up
			if ( get_field('show_sign_up_section') == '1' ) : ?>
				<div class="sign-up-block">
					<div class="row columns">
						<?php if ( $home_sign_up_form_text = get_field('home_sign_up_form_text') ) : ?>
						    <h2><?php echo $home_sign_up_form_text; ?></h2>
						<?php endif;
						if ( $home_sign_up_form = get_field('home_sign_up_form') ) : ?>
							<?php echo do_shortcode('[gravityform id="' . $home_sign_up_form['id'] . '" title="false" description="false" ajax="true"]'); ?>
						<?php endif; ?>
					</div>
				</div>
			<?php endif;
			//latest resource
			if ( get_field('show_latest_resource_section') == '1' ) : ?>
				<div class="latest-resource">
					<div class="row">
						<div class="large-2 medium-6 small-6 columns">
								<?php if ( $latest_resource_section_title = get_field('latest_resource_section_title') ) : ?>
									<h2><?php echo $latest_resource_section_title; ?></h2>
								<?php endif; ?>
						</div>
						<div class="large-2 medium-6 small-6 columns latest-resource-image">
								<p> </p>
								<?php if ( $latest_resource_section_image = get_field('latest_resource_section_image') ) : ?>
									<img src="<?php echo $latest_resource_section_image['sizes']['medium']; ?>" />
								<?php endif; ?>
						</div>
						<div class="large-8 medium-12 small-12 columns">
							<div class="row">
								<?php if ( $latest_resource_section_form = get_field('latest_resource_section_form') ) :
									echo do_shortcode('[gravityform id="' . $latest_resource_section_form['id'] . '" title="false" description="true" ajax="true"]');
								endif; ?>
							</div>
						</div>
					</div>
				</div>
			<?php endif;
			//news block
			get_template_part('parts/news');
			?>
			<div class="row rss-news">
				<?php
				//funnel news
				get_template_part('parts/funnel-news');
				//global news
				get_template_part('parts/global-news');
				?>
			</div>
		<?php endwhile;
	endif; ?>
	<!-- END of main content --> 

<?php get_footer(); ?>