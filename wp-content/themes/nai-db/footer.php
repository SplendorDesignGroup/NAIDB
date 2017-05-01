<?php
/**
 * Footer
 */
?>

<!-- BEGIN of footer -->
<footer class="footer">
	<?php
	$footer_top_background = get_field('footer_top_background','options');
	$footer_left_content = get_field('footer_left_content','options');
	$footer_left_content_link = get_field('footer_left_content_link','options');
	$footer_left_content_link_text = get_field('footer_left_content_link_text','options');
	$footer_right_content = get_field('footer_right_content','options');
	$footer_right_content_link = get_field('footer_right_content_link','options');
	$footer_right_content_link_text = get_field('footer_right_content_link_text','options');
	?>
	<div class="footer-top" style="background-image: url(<?php echo $footer_top_background['sizes']['full_hd']; ?>);">
		<div class="row">
			<div class="medium-6 small-12 columns">
				<?php if ( $footer_left_content ) :
					echo $footer_left_content;
				endif;
				if ( $footer_left_content_link && $footer_left_content_link_text ) : ?>
					<a class="custom-button" href="<?php echo $footer_left_content_link; ?>" ><?php echo $footer_left_content_link_text; ?></a>
				<?php endif; ?>
			</div>
			<div class="medium-6 small-12 columns left-padding">
				<?php if ( $footer_right_content ) :
					echo $footer_right_content;
				endif;
				if ( $footer_right_content_link && $footer_right_content_link_text ) : ?>
					<a class="custom-button" href="<?php echo $footer_right_content_link; ?>" ><?php echo $footer_right_content_link_text; ?></a>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<div class="footer-bottom">
		<div class="row">
			<?php if ( $footer_address = get_field('footer_address','options') ) : ?>
				<div class="medium-6 small-12 columns footer-bottom-address">
					<?php echo $footer_address; ?>
				</div>
			<?php endif; ?>
			<div class="medium-6 small-12 columns text-right small-only-text-left left-padding">
				<?php if ( $counties_served = get_field('counties_served','options') ) : ?>
					<span class="footer-bottom-counties">
						<?php echo $counties_served; ?>
					</span>
				<?php endif;
				if (have_rows('all_socials','options')) : ?>
					<div class="footer-bottom-socials">
						<?php while(have_rows('all_socials','options')) : the_row();
							$icon_class = get_sub_field('icon_class');
							$link = get_sub_field('link');
							if ( $icon_class && $link ) : ?>
								<a href="<?php echo $link; ?>" target="_blank">
									<i class="fa fa-<?php echo $icon_class; ?>" aria-hidden="true"></i>
								</a>
							<?php endif;
						endwhile; ?>
					</div>
				<?php endif;
				if ( $copyright = get_field('copyright','options') ) : ?>
					<span class="footer-bottom-copyright"><?php echo $copyright; ?></span>
				<?php endif;
				if (has_nav_menu('footer-menu')) {
					wp_nav_menu( array( 'theme_location' => 'footer-menu', 'menu_class' => 'footer-menu','depth'=>1));
				} ?>
			</div>
		</div>
	</div>
</footer>
<!-- END of footer -->

<?php wp_footer(); ?>
</body>
</html>
