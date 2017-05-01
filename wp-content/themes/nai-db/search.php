<?php
/**
 * Index
 *
 * Standard loop for the search result page
 */
get_header(); ?>
<div class="top-block" style="background-image: url(<?php echo has_post_thumbnail() ? the_post_thumbnail_url() : bloginfo('template_url').'/images/default.png' ?>);">
	<div class="row columns">
		<h2>Search Results for: <?php echo $s; ?></h2>
	</div>
</div>
<article id="single-property" class="single-property properties-page">
	<div class="single-property-content">
		<div class="row">
			<?php if ( $property_page_top_title = get_field('property_page_top_title','options') ) : ?>
				<div class="medium-8 medium-centered small-12 columns text-center">
					<h1 class="single-property-title"> <?php echo $property_page_top_title; ?></h1>
				</div>
			<?php endif; ?>
			<div class="large-8 medium-7 small-12 columns single-property-content-images">
				<div class="acf-map-container" id="acf-map-container">
					<div class="acf-map">
						<?php if (have_posts()) :
							$pr_countries = array();
							$pr_cities = array();
							while (have_posts()) : the_post();
								$lat = get_field('latitude');
								$lon = get_field('longitude');
								$country = get_field('country');
								$city = get_field('city');
								$property_address = get_field('property_address');
								$link = get_permalink($post->ID);
								$property_type = get_field('property_type');
								//set types for markers colors
								if( count($property_type) == 1 ):
									$pr_type = strtolower($property_type[0]);
								else:
									if ( in_array('Office', $property_type ) ) {
										$pr_type = 'office';
									} elseif( in_array('Retail', $property_type ) ){
										$pr_type = 'retail';
									} elseif( in_array('Land', $property_type ) ){
										$pr_type = 'land';
									} else{
										$pr_type = 'empty';
									}
								endif;
								//fill countries array
								if( $country ):
									if ( !in_array($country, $pr_countries) ) {
										array_push($pr_countries, $country);
									}
								endif;
								//fill cities array
								if( $city ):
									if ( !in_array($city, $pr_cities) ) {
										array_push($pr_cities,$city);
									}
								endif; ?>
								<div class="marker" data-lat="<?php echo $lat; ?>" data-lng="<?php echo $lon; ?>" data-type="<?php echo $pr_type; ?>">
									<h6><?php echo $property_address; ?></h6>
									<h6><?php echo $city,', ',$country; ?></h6>
									<a href="<?php echo $link; ?>"><?php _e('click here for more details'); ?></a>
								</div>
							<?php endwhile;
						else:
							$arg = array(
								'post_type'	    => 'properties',
								'posts_per_page'    => 50,
								'post_status'  => 'publish'
							);
							$the_properties = get_posts( $arg );
							if( $the_properties ) :
								$pr_countries = array();
								$pr_cities = array();
								foreach( $the_properties as $pr ):
									$lat = get_field('latitude', $pr->ID);
									$lon = get_field('longitude', $pr->ID);
									$country = get_field('country', $pr->ID);
									$city = get_field('city', $pr->ID);
									$property_address = get_field('property_address', $pr->ID);
									$link = get_permalink($pr->ID);
									$property_type = get_field('property_type', $pr->ID);
									//set types for markers colors
									if( count($property_type) == 1 ):
										$pr_type = strtolower($property_type[0]);
									else:
										if ( in_array('Office', $property_type ) ) {
											$pr_type = 'office';
										} elseif( in_array('Retail', $property_type ) ){
											$pr_type = 'retail';
										} elseif( in_array('Land', $property_type ) ){
											$pr_type = 'land';
										} else{
											$pr_type = 'empty';
										}
									endif;
									//fill countries array
									if( $country ):
										if ( !in_array($country, $pr_countries) ) {
											array_push($pr_countries, $country);
										}
									endif;
									//fill cities array
									if( $city ):
										if ( !in_array($city, $pr_cities) ) {
											array_push($pr_cities,$city);
										}
									endif; ?>
									<div class="marker" data-lat="<?php echo $lat; ?>" data-lng="<?php echo $lon; ?>" data-type="<?php echo $pr_type; ?>">
										<h6><?php echo $property_address; ?></h6>
										<h6><?php echo $city; ?></h6>
										<h6><?php echo $country; ?></h6>
										<a class="acf-map-link" href="<?php echo $link; ?>"><?php _e('Click here for more details'); ?></a>
									</div>
								<?php endforeach;
							endif;
						endif; ?>
					</div>
				</div>
			</div>
			<div class="large-4 medium-5 small-12 columns properties-page-filters">
				<?php show_template('filters-html', array('pr_countries'=>$pr_countries,'pr_cities'=>$pr_cities)); ?>
			</div>
		</div>
	</div>
</article>
<div class="row properties">
	<h3 class="no-results"><?php _e('No properties match your search criteria. Please try a new search.'); ?></h3>
	<?php if (have_posts()) :
		while (have_posts()) : the_post();
			get_template_part('parts/property-grid');
		endwhile; ?>
		<div class="small-12 columns text-center properties-pagination">
			<?php foundation_pagination(); ?>
		</div>
	<?php endif; ?>
</div>
<div class="row">
	<div class="small-12 columns">
		<?php get_template_part('parts/updates'); ?>
	</div>
</div>

<?php get_footer(); ?>