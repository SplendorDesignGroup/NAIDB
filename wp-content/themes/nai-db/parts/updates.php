<?php $arg = array(
    'post_type'	    => 'any',
    'order'		    => 'DESC',
    'orderby'	    => 'menu_order',
    'posts_per_page'    => 20,
    'meta_query' => array(
        'relation' => 'AND',
        array(
            'key' => 'updates',
            'value' => '1',
            'compare' => 'LIKE'
        )
    )
);
$posts = get_posts($arg);
if ( $posts ) : ?>
    <div class="row columns relative-position">
        <div class="small-1 columns prev updates-prev matchHeight"></div>
        <div class="updates medium-10 small-12 columns text-center matchHeight">
            <?php foreach ($posts as $one) : ?>
                <div class="slick-slide">
                    <span><?php echo get_the_date('F j, Y',$one); ?></span><h6><?php echo $one->post_title; ?></h6>
                    <?php if ( $post_description = get_field('post_description',$one->ID) ) : ?>
                        <p><?php echo $post_description; ?> <a href="<?php echo get_permalink($one->ID); ?>"><?php _e('Read More »'); ?></a></p>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
            <?php //var_dump($posts) ?>
        </div>
        <div class="small-1 columns next updates-next matchHeight"></div>
    </div>
<?php endif; ?>