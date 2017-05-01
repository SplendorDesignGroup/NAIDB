<?php
/*
 * Single Properties Page
 */
get_header();

if ( have_posts() ) :
    while ( have_posts() ) : the_post(); ?>
        <div class="top-block" style="background-image: url(<?php echo has_post_thumbnail() ? the_post_thumbnail_url() : bloginfo('template_url').'/images/default.png' ?>);">
            <div class="row columns">
                <h2><?php _e('Properties'); ?></h2>
            </div>
            <?php dynamic_sidebar('Top Right Sidebar'); ?>
        </div>
        <article class="single-property">
            <div class="single-property-content">
                <div class="row">
                    <div class="medium-8 medium-centered small-12 columns text-center">
                        <h1 class="single-property-title"><?php the_field('property_address'); ?></h1>
                    </div>
                    <div class="medium-7 small-12 columns single-property-content-images">
                       <?php if (have_rows('property_images')) : ?>
                           <div class="relative-position">
                               <div class="property-prev prev"></div>
                               <div class="property-next next"></div>
                               <div class="property-big-slider">
                                   <?php while(have_rows('property_images')) : the_row();
                                       $image = get_sub_field('image'); ?>
                                       <div class="slick-slide" style="background-image: url(<?php echo $image; ?>);">
                                       </div>
                                   <?php endwhile; ?>
                               </div>
                           </div>
                           <div class="property-small-slider">
                               <?php while(have_rows('property_images')) : the_row();
                                   $image = get_sub_field('image'); ?>
                                   <div class="slick-slide">
                                       <div class="property-small-slider-image" style="background-image: url(<?php echo $image; ?>);"></div>
                                   </div>
                               <?php endwhile; ?>
                           </div>
                       <?php endif; ?>
                    </div>
                    <div class="medium-5 small-12 columns">
                        <?php if ( $property_type = get_field('property_type') ) :
                            foreach($property_type as $item): ?>
                                <span class="pr-type"><?php echo $item; ?></span>
                            <?php endforeach;
                        endif;
                        if ( $property_status = get_field('property_status') ) :
                        foreach($property_status as $item): ?>
                        <span class="pr-status"><?php echo $item; ?></span>
                        <?php endforeach;
                        endif;
                        
                        the_content();
                        if (have_rows('comments')) : ?>
                            <ul>
                                <?php while(have_rows('comments')) : the_row();
                                    $comment = get_sub_field('comment');
                                    if ( $comment && $comment != '[]' ) :?>
                                        <li>
                                            <p><?php echo $comment; ?></p>
                                        </li>
                                    <?php endif;
                                endwhile; ?>
                            </ul>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="single-property-detail">
                <div class="row">
                    <div class="medium-5 small-12 columns single-property-detail-info">
                        <?php if ( $property_details_title = get_field('property_details_title','options') ) : ?>
                            <h3 class="single-property-subtitle"><?php echo $property_details_title; ?></h3>
                        <?php endif; ?>
                        <table>
                            <?php if ( $total_building_size = get_field('total_building_size') ) : ?>
                                <tr>
                                    <td><?php _e('Total Building Size') ?></td>
                                    <td><?php echo $total_building_size; ?></td>
                                </tr>
                            <?php endif;
                            if ( $available_space = get_field('available_space') ) : ?>
                                <tr>
                                    <td><?php _e('Available Space') ?></td>
                                    <td><?php echo $available_space; ?></td>
                                </tr>
                            <?php endif;
                            if ( $number_of_floors = get_field('number_of_floors') ) : ?>
                                <tr>
                                    <td><?php _e('Number of Floors') ?></td>
                                    <td><?php echo $number_of_floors; ?></td>
                                </tr>
                            <?php endif;
                            if ( $office_space = get_field('office_space') ) : ?>
                                <tr>
                                    <td><?php _e('Office Space') ?></td>
                                    <td><?php echo $office_space; ?></td>
                                </tr>
                            <?php endif;
                            if ( $loading = get_field('loading') ) : ?>
                                <tr>
                                    <td><?php _e('Loading') ?></td>
                                    <td><?php echo $loading; ?></td>
                                </tr>
                            <?php endif;
                            if ( $ceiling_height = get_field('ceiling_height') ) : ?>
                                <tr>
                                    <td><?php _e('Ceiling Height') ?></td>
                                    <td><?php echo $ceiling_height; ?></td>
                                </tr>
                            <?php endif;
                            if ( $min_ceiling_clearance = get_field('min_ceiling_clearance') ) : ?>
                                <tr>
                                    <td><?php _e('Min Ceiling Clearance	') ?></td>
                                    <td><?php echo $min_ceiling_clearance; ?></td>
                                </tr>
                            <?php endif;
                            if ( $sprinklers = get_field('sprinklers') ) : ?>
                                <tr>
                                    <td><?php _e('Sprinklers') ?></td>
                                    <td><?php echo $sprinklers; ?></td>
                                </tr>
                            <?php endif;
                            if ( $divides_to = get_field('divides_to') ) : ?>
                                <tr>
                                    <td><?php _e('Divides To') ?></td>
                                    <td><?php echo $divides_to; ?></td>
                                </tr>
                            <?php endif;
                            if ( $property_size = get_field('property_size') ) : ?>
                                <tr>
                                    <td><?php _e('Property Size') ?></td>
                                    <td><?php echo $property_size; ?></td>
                                </tr>
                            <?php endif;
                            if ( $zoning = get_field('zoning') ) : ?>
                                <tr>
                                    <td><?php _e('Zoning') ?></td>
                                    <td><?php echo $zoning; ?></td>
                                </tr>
                            <?php endif;
                            if ( $parking = get_field('parking') ) : ?>
                                <tr>
                                    <td><?php _e('Parking') ?></td>
                                    <td><?php echo $parking; ?></td>
                                </tr>
                            <?php endif;
                            if ( $sale_price = get_field('sale_price') ) : ?>
                                <tr>
                                    <td><?php _e('Sale Price') ?></td>
                                    <td><?php echo $sale_price; ?></td>
                                </tr>
                            <?php endif;
                            if ( $rental_price = get_field('rental_price') ) : ?>
                                <tr>
                                    <td><?php _e('Rental Price') ?></td>
                                    <td><?php echo $rental_price; ?></td>
                                </tr>
                            <?php endif; ?>
                        </table>
                    </div>
                    <div class="medium-7 small-12 columns">
                        <?php
                        $latitude = get_field('latitude');
                        $longitude = get_field('longitude');
                        $property_type = get_field('property_type');
                        if ( $property_type ) :
                            $pr_type = strtolower($property_type[0]);
                        else:
                            $pr_type = 'empty';
                        endif;
                        if( $longitude && $longitude ):?>
                            <div class="acf-map-container">
                                <div class="acf-map">
                                    <div class="marker" data-lat="<?php echo $latitude; ?>" data-lng="<?php echo $longitude; ?>" data-type="<?php echo $pr_type;  ?>"></div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    <?php if ( $property_bottom_contact_title = get_field('property_bottom_contact_title','options') ) : ?>
                        <div class="small-12 columns text-center single-property-bottom">
                            <h3 class="single-property-subtitle"> <?php echo $property_bottom_contact_title; ?></h3>
                        </div>
                    <?php endif; ?>
                    <div class="medium-6 small-12 columns single-property-detail-info">
                       <?php
                       if ( $property_form = get_field('property_form','options') ) :
                           echo do_shortcode('[gravityform id="' . $property_form['id'] . '" title="false" description="false" ajax="true"]');
                       endif;
                       ?>
                    </div>
                    <div class="medium-5 medium-offset-1 small-12 columns single-property-contact">
                        <?php
                        $contact_one_name = get_field('contact_one_name');
                        $contact_two_name = get_field('contact_two_name');
                        $contact_three_name = get_field('contact_three_name');
                        $contact_one_email = get_field('contact_one_email');
                        $contact_two_email = get_field('contact_two_email');
                        $contact_three_email = get_field('contact_three_email');
                        $contact_one_phone = get_field('contact_one_phone');
                        $contact_two_phone = get_field('contact_two_phone');
                        $contact_three_phone = get_field('contact_three_phone');
                        if ( $contact_one_name || $contact_two_name || $contact_three_name  ) : ?>
                            <h6><?php _e('CONTACT:'); ?></h6>
                        <?php endif; ?>
                        <div class="row">
                           <?php if ( $contact_one_name || $contact_one_email || $contact_one_phone ) : ?>
                                <div class="large-4 medium-12 small-12 columns">
                                    <?php if ( $contact_one_name ) : ?>
                                        <p>
                                            <strong>
                                                <?php echo $contact_one_name; ?>
                                            </strong>
                                        </p>
                                    <?php endif;
                                    if ( $contact_one_email ) : ?>
                                        <a href="mailto:<?php echo $contact_one_email; ?>"><?php echo $contact_one_email; ?></a>
                                    <?php endif;
                                    if ( $contact_one_phone ) : ?>
                                        <p><?php echo $contact_one_phone; ?></p>
                                    <?php endif; ?>
                                </div>
                            <?php endif;
                            if ( $contact_two_name || $contact_two_email || $contact_two_phone ) : ?>
                                <div class="large-4 medium-12 small-12 columns">
                                    <?php if ( $contact_two_name ) : ?>
                                        <p>
                                            <strong>
                                                <?php echo $contact_two_name; ?>
                                            </strong>
                                        </p>
                                    <?php endif;
                                    if ( $contact_two_email ) : ?>
                                        <a href="mailto:<?php echo $contact_two_email; ?>"><?php echo $contact_two_email; ?></a>
                                    <?php endif;
                                    if ( $contact_two_phone ) : ?>
                                        <p><?php echo $contact_two_phone; ?></p>
                                    <?php endif; ?>
                                </div>
                            <?php endif;
                            if ( $contact_three_name || $contact_three_email || $contact_three_phone ) : ?>
                                <div class="large-4 medium-12 small-12 columns">
                                    <?php if ( $contact_three_name ) : ?>
                                        <p>
                                            <strong>
                                                <?php echo $contact_three_name; ?>
                                            </strong>
                                        </p>
                                    <?php endif;
                                    if ( $contact_three_email ) : ?>
                                        <a href="mailto:<?php echo $contact_three_email; ?>"><?php echo $contact_three_email; ?></a>
                                    <?php endif;
                                    if ( $contact_three_phone ) : ?>
                                        <p><?php echo $contact_three_phone; ?></p>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <?php if ( $pdf = get_field('pdf') ) : ?>
                            <a class="pdf" href="<?php echo $pdf; ?>" download>
                                <img src="<?php bloginfo('template_url') ?>/images/pdf.png" />
                                <?php _e('DOWNLOAD PDF LISTING'); ?>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="small-12 columns post-navigation text-center">
                    <span class="prev-post"><?php echo get_previous_post_link( '%link', 'PREVIOUS' ); ?></span>
                    <?php $property_back_link = get_field('property_back_link','options'); ?>
                    <a href="<?php echo $property_back_link ? $property_back_link : get_site_url(); ?>">
                        <img src="<?php bloginfo('template_url') ?>/images/post-icon.png" />
                    </a>
                    <span class="next-post"><?php echo get_next_post_link( '%link', 'NEXT'); ?></span>
                </div>
            </div>
            <?php if ( get_field('display_updates') == '1' ) : ?>
                <div class="row">
                    <div class="small-12 columns">
                        <?php get_template_part('parts/updates'); ?>
                    </div>
                </div>
            <?php  endif; ?>
        </article>
    <?php endwhile;
endif;

get_footer(); ?>