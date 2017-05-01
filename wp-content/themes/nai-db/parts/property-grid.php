<div class="medium-6 small-12 columns property">
    <div class="row columns property-one matchHeight">
        <?php $main_image = get_field('property_images')[0]['image']; ?>
        <div class="large-6 medium-12 small-12 columns property-one-image" style="background-image: url(<?php echo $main_image ? $main_image : bloginfo('template_url').'/images/default3.png'; ?>);">
            <a class="small-9 details" href="<?php echo get_permalink(); ?>"><?php _e('Details'); ?></a>
            <?php
            $property_type = get_field('property_type', $post->ID);
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
            endif; ?>
            <a class="map_it" href="#acf-map-container"
                data-lat="<?php the_field('latitude',$post->ID); ?>"
                data-lon="<?php the_field('longitude',$post->ID); ?>"
                data-activestatus="<?php the_field('property_activestatus',$post->ID); ?>"
                data-type="<?php echo $pr_type; ?>"
                data-address="<?php the_field('property_address',$post->ID); ?>"
                data-city="<?php the_field('city',$post->ID); ?>"
                data-country="<?php the_field('country',$post->ID); ?>"
                data-link="<?php echo get_permalink($pr->ID); ?>">
                <i class="fa fa-map-marker small-3" aria-hidden="true"></i>
                <?php _e('MAP IT'); ?>
            </a>
        </div>
        <div class="large-6 medium-12 small-12 columns property-one-content">
            <?php if ( $property_type = get_field('property_type') ) : ?>
                <div>
                    <?php foreach($property_type as $item): ?>
                        <span class="pr-type"><?php echo $item; ?></span>
                    <?php endforeach; ?>
                </div>
            <?php endif;
            if ( $property_status = get_field('property_status') ) :
                foreach($property_status as $item): ?>
                    <span class="pr-status"><?php echo $item; ?></span>
                <?php endforeach;
            endif;
            if ( $property_address = get_field('property_address') ) : ?>
                <address><?php echo $property_address; ?></address>
            <?php endif;
            if ( $sales_price = get_field('sales_price') ) : ?>
                <p><?php echo 'SALES PRICE - '.$sales_price; ?></p>
            <?php endif;
            if ( $lease_rate = get_field('lease_rate') ) : ?>
                <p><?php echo 'LEASE RATE - '.$lease_rate; ?></p>
            <?php endif;
            if ( $total_building_size = get_field('total_building_size') ) : ?>
                <p><?php echo 'BUILDING - '.$total_building_size; ?></p>
            <?php endif;
            if ( $available_space = get_field('available_space') ) : ?>
                <p><?php echo 'AVAILABLE - '.$available_space; ?></p>
            <?php endif; ?>
        </div>
    </div>
</div>