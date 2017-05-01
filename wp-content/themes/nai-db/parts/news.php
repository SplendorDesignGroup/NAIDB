<div class="row news">
    <?php
    $site_news_link = get_field('site_news_link','options');
    $site_news_title = get_field('site_news_title','options');
    if ( $site_news_title && $site_news_link ) : ?>
        <a href="<?php echo $site_news_link; ?>">
            <h4><?php echo $site_news_title; ?></h4>
        </a>
    <?php endif;
    $arg = array(
        'post_type'	    => 'post',
        'order'		    => 'DESC',
        'orderby'	    => 'date',
        'posts_per_page'    => 20
    );
    if ( !$big ) :
        $arg['meta_query'] = array(
            'relation' => 'AND',
            array(
                'key' => 'featured_on_homepage',
                'value' => '1',
                'compare' => 'LIKE'
            )
        );
    endif;
    $posts = get_posts($arg);
    if ( $posts ) : ?>
        <div class="news-prev prev"></div>
        <div class="<?php echo $big ? 'news-big-slider' : 'news-slider'; ?>">
            <?php foreach ($posts as $one) : ?>
                <div class="slick-slide news-slider-one">
                    <div class="news-slider-one-content"
                         style="background-image: url(<?php echo get_the_post_thumbnail_url($one) ? get_the_post_thumbnail_url($one) : bloginfo('template_url').'/images/default2.png' ?>);">
                        <a class="news-slider-one-content-link" href="<?php echo get_permalink($one->ID); ?>"></a>
                        <div class="news-slider-one-content-info">
                            <span><?php echo get_the_date('m.d.y',$one); ?></span>
                            <div class="news-slider-one-content-info-black matchHeight">
                                <?php $cats = get_the_category($one->ID);
                                foreach( $cats as $one_cat ) :
                                    if($one_cat->parent != 0) :?>
                                        <h6 class="cat"><?php echo $one_cat->name; ?></h6>
                                    <?php endif;
                                endforeach; ?>
                                <h6><?php echo $one->post_title; ?></h6>
                                <p><?php echo get_the_excerpt($one->ID); ?></p>
                                <a href="<?php echo get_permalink($one->ID); ?>"><?php _e('Read More'); ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            <?php //var_dump($posts) ?>
        </div>
        <div class="news-next next"></div>
    <?php endif; ?>
</div>