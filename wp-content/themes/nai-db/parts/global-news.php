<div class="large-5 medium-12 small-12 columns">
    <?php
    $global_news_link = get_field('global_news_link','options');
    if ( $global_news_link ) :
        $global_rss = simplexml_load_file($global_news_link);
    endif;
    if($global_rss):
        $k = 1;
        if ( $global_news_title = get_field('global_news_title','options') ) : ?>
            <h4><?php echo $global_news_title; ?></h4>
        <?php endif; ?>
        <div class="global-slider">
            <?php foreach ($global_rss->channel->item as $item) :
                if($k++ < 21) : ?>
                    <div class="slick-slide">
                        <div class="row">
                            <div class="small-12 columns funnel-slider-content">
                                <?php
                                $old_date_timestamp = strtotime($item->pubDate);
                                $new_date = date('m.d.y', $old_date_timestamp);
                                ?>
                                <h5><span><?php echo $new_date; ?></span> <?php echo $item->title; ?></h5>
                                <p><?php echo substr($item->description,0,120).'...'; ?> <a href="<?php echo $item->link; ?>" target="_blank"><?php _e('Read More');  ?></a></p>
                            </div>
                        </div>
                    </div>
                <?php else :
                    break;
                endif;
            endforeach; ?>
        </div>
    <?php endif; ?>
</div>