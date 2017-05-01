<?php

//Properties
function check_properties(){
    $properties_ids = array();
    $xml_ids = array();

    //get xmlids and insert them to array
    $astro_link = get_field('astro_link','options');
    if ( $astro_link ) :
        $astro_xml = simplexml_load_file($astro_link);
    endif;
    if($astro_xml):
        $json_string = json_encode($astro_xml);
        $result_array = json_decode($json_string, TRUE);
        foreach($result_array['item'] as $item):
            $item_id = $item['propertyID'];
            $item_status = $item['ActiveStatus'];
            if ( $item_status == 'active & exclusive' ){
                $item_status = 'a';
            } else{
                $item_status = 'c';
            }
            $item_element = $item_id.$item_status;

            array_push($xml_ids,$item_element);
        endforeach;
    endif;

    //get properties posts and insert meta id to array
    $arg = array(
        'post_type'	  => 'properties',
        'numberposts' => -1,
        'post_status' => 'publish'
    );
    $properties = get_posts( $arg );
    if ( $properties ) :
        foreach($properties as $property){
            $property_id = get_post_meta($property->ID, 'property_id',true);
            array_push($properties_ids, $property_id);
        }
    endif;

    //get properties data and check for add or update
    foreach($result_array['item'] as $item):
        $id_first_element = $item['propertyID'];
        $pr_status = $item['ActiveStatus'];
        $status = array();
        if ( $pr_status == 'active & exclusive' ){
            $id_element = 'a';
            array_push($status, 'active');
        } else{
            $id_element = 'c';
            array_push($status, 'closed');
        }
        $pr_id = $id_first_element.$id_element;

        //types
        $arr_values = ['none','industrial','office','land','retail'];
        $arr_types = [intval($item['propertyType']),intval($item['propertyType2']),intval($item['propertyType3']),intval($item['propertyType4'])];
        $arr_final = array();
        for($i=1;$i<5;$i++):
            if ( in_array( $i, $arr_types) ){
                array_push($arr_final,$arr_values[$i]);
            }
        endfor;
        //characteristics
        $forsale = $item['forsale'];
        $forlease = $item['forlease'];
        $pr = array();
        if ($forsale == '1'):
            array_push($pr, 'forsale');
        endif;
        if ($forlease == '1'):
            array_push($pr, 'forlease');
        endif;

        $name = $item['name'];
        $headline = $item['headline'];
        $description = $item['description'];
        if( $description === 'NULL' ){
            $description = '';
        }
        //images
        $all_images = array();
		$pr_image['image'] = $item['picture_url'];
		if( $pr_image['image'] ):
			array_push($all_images, $pr_image);
		endif;
		$pr_images = $item['picture_links'];
        if($pr_images){
            $pr_images = explode(',', $pr_images);
            foreach($pr_images as $image):
                $one_image['image'] = $image;
                if( $one_image['image'] ):
                    array_push($all_images, $one_image);
                endif;
            endforeach;
        }
        //options
        $totalBuildingSize = $item['totalBuildingSize']? $item['totalBuildingSize'] : '';
        $availableSpace = $item['availableSpace'] ? $item['availableSpace'] : '';
        $numberOfFloors = $item['numFloors'] ? $item['numFloors'] : '';
        $officeSpace = $item['sortspace'] ? $item['sortspace'] : '';
        $loading = $item['loading']? $item['loading'] : '';
        $ceilingHeight = $item['ceilingHeight'] ? $item['ceilingHeight'] : '';
        $minCeilingClearance = $item['ceilingHeight2'] ? $item['ceilingHeight2'] : '';
        $sprinklers = $item['sprinklers'] ? $item['sprinklers'] : '';
        $dividesTo = $item['dividesTo'] ? $item['dividesTo'] : '';
        $propertySize = $item['propertySize'] ? $item['propertySize'] : '';
        $zoning = $item['zoning'] ? $item['zoning'] : '';
        $parking = $item['parking'] ? $item['parking'] : '';
        $salePrice = $item['salePrice'] ? $item['salePrice'] : '';
        $rentalPrice = $item['rentalPrice'] ? $item['rentalPrice'] : '';

        //address
        $country = $item['county'] ? $item['county'] : '';
        $city = $item['city'] ? $item['city'] : '';
        $state = $item['state'] ? $item['state'] : '';
        $pr_address = $item['address'];

        //comments
        $all_comments = array();
        $one_comments['comment'] = $item['comments'];
        if( $one_comments ):
            array_push($all_comments, $one_comments);
        endif;
        for($i = 1; $i < 15; $i++):
            $fnc = 'comments' . $i;
            $one_comment['comment'] = $item[$fnc];
            if( $one_comment['comment'] ):
                array_push($all_comments, $one_comment);
            else:
                break;
            endif;
        endfor;

        //contacts
        $contactName = $item['contactName'] ? $item['contactName'] : '';
        $contactPhone = $item['contactPhone'] ? $item['contactPhone'] : '';
        $contactEmail = $item['contactEmail'] ? $item['contactEmail'] : '';
        $contactName2 = $item['contactName2'] ? $item['contactName2'] : '';
        $contactPhone2 = $item['contactPhone2'] ? $item['contactPhone2'] : '';
        $contactEmail2 = $item['contactEmail2'] ? $item['contactEmail2'] : '';
        $contactName3 = $item['contactName3'] ? $item['contactName3'] : '';
        $contactPhone3 = $item['contactPhone3'] ? $item['contactPhone3'] : '';
        $contactEmail3 = $item['contactEmail3'] ? $item['contactEmail3'] : '';

        //map
        $latitude = $item['latitude'] ? $item['latitude'] : '';
        $longitude = $item['longitude'] ? $item['longitude'] : '';

        //pdf
        $flyer = $item['flyer'] ? $item['flyer'] : '';


        if ( !in_array( $pr_id, $properties_ids) ){
            $property_post = array(
                'post_title'	=> $name,
                'post_type'		=> 'properties',
                'post_status'	=> 'publish',
                'post_author'   => 1,
                'post_content'  => $description
            );
            $post_id = wp_insert_post( $property_post );
            array_push($properties_ids, $pr_id);
            //id
            update_field( 'property_id', $pr_id, $post_id );
        } else{
            $args = array(
                'post_type' => 'properties',
                'meta_key' => 'property_id',
                'meta_value' => $id_first_element,
            );
            $upd_post = get_posts($args);
            $post_id = $upd_post[0]->ID;
        }
        //status
        update_field( 'property_activestatus', $status, $post_id );
        //types
        update_field( 'property_type', $arr_final, $post_id );
        //property
        update_field( 'property_status', $pr, $post_id );
        //headline
        update_field( 'headline', $headline, $post_id );
        //options
        update_field( 'total_building_size', $totalBuildingSize, $post_id );
        update_field( 'available_space', $availableSpace, $post_id );
        update_field( 'number_of_floors', $numberOfFloors, $post_id );
        update_field( 'office_space', $officeSpace, $post_id );
        update_field( 'loading', $loading, $post_id );
        update_field( 'ceiling_height', $ceilingHeight, $post_id );
        update_field( 'min_ceiling_clearance', $minCeilingClearance, $post_id );
        update_field( 'sprinklers', $sprinklers, $post_id );
        update_field( 'divides_to', $dividesTo, $post_id );
        update_field( 'property_size', $propertySize, $post_id );
        update_field( 'zoning', $zoning, $post_id );
        update_field( 'parking', $parking, $post_id );
        update_field( 'sales_price', $salePrice, $post_id );
        update_field( 'lease_rate', $rentalPrice, $post_id );
        update_field( 'property_address', $pr_address, $post_id );
        update_field( 'country', $country, $post_id );
        update_field( 'city', $city, $post_id );
        update_field( 'state', $state, $post_id );
        //images
        if($all_images){
            update_field( 'property_images', $all_images, $post_id );
        }
        //comments
        if($all_comments){
            update_field( 'comments', $all_comments, $post_id );
        }
        //contacts
        update_field( 'contact_one_name', $contactName, $post_id );
        update_field( 'contact_two_name', $contactName2, $post_id );
        update_field( 'contact_three_name', $contactName3, $post_id );
        update_field( 'contact_one_email', $contactEmail, $post_id );
        update_field( 'contact_two_email', $contactEmail2, $post_id );
        update_field( 'contact_three_email', $contactEmail3, $post_id );
        update_field( 'contact_one_phone', $contactPhone, $post_id );
        update_field( 'contact_two_phone', $contactPhone2, $post_id );
        update_field( 'contact_three_phone', $contactPhone3, $post_id );
        //lat
        update_field( 'latitude', $latitude, $post_id );
        //lon
        update_field( 'longitude', $longitude, $post_id );
        //pdf
        update_field( 'pdf', $flyer, $post_id );

    endforeach;
}

//add_action( 'wp_loaded', 'check_properties' );

function delete_properties(){
    $xml_ids = array();

    //get xmlids and insert them to array
    $astro_link = get_field('astro_link','options');
    if ( $astro_link ) :
        $astro_xml = simplexml_load_file($astro_link);
    endif;
    if($astro_xml):
        $json_string = json_encode($astro_xml);
        $result_array = json_decode($json_string, TRUE);
        foreach($result_array['item'] as $item):
            $item_id = $item['propertyID'];
            $item_status = $item['ActiveStatus'];
            if ( $item_status == 'active & exclusive' ){
                $item_status = 'a';
            } else{
                $item_status = 'c';
            }
            $item_element = $item_id.$item_status;
            array_push($xml_ids,$item_element);
        endforeach;
    endif;

    //get properties posts
    $arg = array(
        'post_type'	  => 'properties',
        'numberposts' => -1,
        'post_status' => 'publish'
    );
    $properties = get_posts( $arg );
    if ( $properties ) :
        foreach($properties as $property){
            if ( !in_array(get_post_meta($property->ID, 'property_id',true), $xml_ids) ){
                wp_delete_post(intval($property->ID));
            }
        }
    endif;
}

//add interval in 10 minutes to update events categories
add_filter( 'cron_schedules', 'cron_add_one_min' );
function cron_add_one_min( $schedules ) {
    $schedules['ten_minutes'] = array(
        'interval' => 60 * 10,
        'display' => 'every ten minutes'
    );
    return $schedules;
}


add_action( 'wp', 'check_pr' );
add_action( 'wp', 'delete_pr' );

function check_pr() {
    if ( ! wp_next_scheduled( 'update_properties' ) ) {
        wp_schedule_event(time(), 'twicedaily', 'update_properties');
        //wp_schedule_event(time(), 'ten_minutes', 'update_properties');
    }
}
add_action( 'update_properties', 'check_properties' );

function delete_pr() {
    if ( ! wp_next_scheduled( 'del_properties' ) ) {
        wp_schedule_event(time(), 'twicedaily', 'del_properties');
       // wp_schedule_event(time(), 'ten_minutes', 'del_properties');
    }
}
add_action( 'del_properties', 'delete_properties' );


