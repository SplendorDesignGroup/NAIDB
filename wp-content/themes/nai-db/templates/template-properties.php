<?php
/*
 * Template Name: Properties
 */
get_header();

if (have_posts()) :
    while (have_posts()) : the_post(); ?>
        <div class="top-block"
             style="background-image: url(<?php echo has_post_thumbnail() ? the_post_thumbnail_url() : bloginfo('template_url') . '/images/default.png' ?>);">
            <div class="row columns">
                <h2><?php echo the_title(); ?></h2>
            </div>
        </div>
        <article id="single-property" class="single-property properties-page">
            <div class="single-property-content">
                <div class="row">
                    <?php if ($properties_page_top_title = get_field('properties_page_top_title')) : ?>
                        <div class="medium-8 medium-centered small-12 columns text-center">
                            <h1 class="single-property-title"> <?php echo $properties_page_top_title; ?></h1>
                        </div>
                    <?php endif; ?>
                    <div class="large-8 medium-7 small-12 columns single-property-content-images">
                        <?php
                        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                        $properties_status = $_POST['status'];
                        $meta_array = array('relation' => 'AND');
                        $arg = array(
                            'post_type' => 'properties',
                            'posts_per_page' => 50,
                            'post_status' => 'publish',
                            'paged' => $paged
                        );
                        if ($properties_status == 'closed') {
                            $status_array = array(
                                'key' => 'property_activestatus',
                                'value' => 'closed',
                                'compare' => 'LIKE'
                            );
                            array_push($meta_array,$status_array);
                            $arg['meta_query'] = $meta_array;
                        } elseif($properties_status == 'both') {
                            $status_array = array(
                                'key' => 'property_activestatus',
                                'value' => array('active','closed'),
                                'compare' => 'LIKE'
                            );
                            array_push($meta_array,$status_array);
                            $arg['meta_query'] = $meta_array;
                        } else {
                            $status_array = array(
                                'key' => 'property_activestatus',
                                'value' => 'active',
                                'compare' => 'LIKE'
                            );
                            array_push($meta_array,$status_array);
                            $arg['meta_query'] = $meta_array;
                        }
                        $the_properties = get_posts($arg);
                        if ($the_properties) : ?>
                            <div class="acf-map-container" id="acf-map-container">
                                <div class="acf-map">
                                    <?php
                                    $pr_countries = array();
                                    $pr_cities = array();
                                    foreach ($the_properties as $pr):
                                        $lat = get_field('latitude', $pr->ID);
                                        $lon = get_field('longitude', $pr->ID);
                                        $country = get_field('country', $pr->ID);
                                        $city = get_field('city', $pr->ID);
                                        $property_address = get_field('property_address', $pr->ID);
                                        $link = get_permalink($pr->ID);
                                        $property_type = get_field('property_type', $pr->ID);
                                        //set types for markers colors
                                        if (count($property_type) == 1):
                                            $pr_type = strtolower($property_type[0]);
                                        else:
                                            if (in_array('Office', $property_type)) {
                                                $pr_type = 'office';
                                            } elseif (in_array('Retail', $property_type)) {
                                                $pr_type = 'retail';
                                            } elseif (in_array('Land', $property_type)) {
                                                $pr_type = 'land';
                                            } else {
                                                $pr_type = 'empty';
                                            }
                                        endif;
                                        //fill countries array from query
                                        if ($country):
                                            if (!in_array($country, $pr_countries)) {
                                                array_push($pr_countries, $country);
                                            }
                                        endif;
                                        //fill cities array from query
                                        if ($city):
                                            if (!in_array($city, $pr_cities)) {
                                                array_push($pr_cities, $city);
                                            }
                                        endif; ?>
                                        <div class="marker" data-lat="<?php echo $lat; ?>"
                                             data-lng="<?php echo $lon; ?>" data-type="<?php echo $pr_type; ?>">
                                            <h6><?php echo $property_address; ?></h6>
                                            <h6><?php echo $city, ', ', $country; ?></h6>
                                            <a class="acf-map-link"
                                               href="<?php echo $link; ?>"><?php _e('Click here for more details'); ?></a>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="large-4 medium-5 small-12 columns properties-page-filters">
                        <?php show_template('filters-html', array('pr_countries'=>$pr_countries,'pr_cities'=>$pr_cities)); ?>
                    </div>
                </div>
            </div>
        </article>
        <div class="row properties">
            <h3 class="no-results"><?php _e('No properties match your search criteria. Please try a new search.'); ?></h3>
            <?php
            $arg = array(
                'post_type' => 'properties',
                'order' => 'DESC',
                'orderby' => 'date',
                'posts_per_page' => 50,
                'paged' => $paged,
                'meta_query' => $meta_array
            );
            $all_properties = new WP_Query($arg);
            if ($all_properties->have_posts()) :
                while ($all_properties->have_posts()) : $all_properties->the_post();
                    get_template_part('parts/property-grid');
                endwhile;
            endif;
            wp_reset_query(); ?>
            <div class="small-12 columns text-center properties-pagination">
                <?php foundation_pagination($all_properties); ?>
            </div>
        </div>
        <div class="row">
            <div class="small-12 columns">
                <?php get_template_part('parts/updates'); ?>
            </div>
        </div>
    <?php endwhile;
endif;

get_footer(); ?>