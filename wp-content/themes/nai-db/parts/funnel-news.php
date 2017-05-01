<div class="large-7 medium-12 small-12 columns">

    <?php

    $funnel_news_link = get_field('funnel_news_link','options');

    if ( $funnel_news_link ) :

        $funnel_rss = simplexml_load_file($funnel_news_link);

    endif;

    if($funnel_rss):



        $i = 1;

        if ( $funnel_news_title = get_field('funnel_news_title','options') ) : ?>

            <h4><?php echo $funnel_news_title; ?></h4>

        <?php endif; ?>

        <div class="funnel-slider">

            <?php foreach ($funnel_rss->channel->item as $item) :

                if($i++ < 21) : ?>

                    <div class="slick-slide">

                        <?php

			error_reporting(0);

                        $thumbAttr = $item->children('media', true)->content->attributes();

                        $thumbAttr = $item->children('http://search.yahoo.com/mrss/')->content->attributes();

			if($thumbAttr):

                            $image_url = $thumbAttr['url'];

                        endif;

                        ?>

                        <div class="row">

                            <div class="medium-5 small-12 columns funnel-slider-image"

                                 style="background-image: url(<?php echo $thumbAttr ? $image_url : bloginfo('template_url').'/images/default1.png' ?>);">

                                <?php

                                $old_date_timestamp = strtotime($item->pubDate);

                                $new_date = date('m.d.y', $old_date_timestamp);

                                ?>

                                <a href="<?php echo $item->link; ?>" target="_blank"></a>

                                <span><?php echo $new_date; ?></span>

                            </div>

                            <div class="medium-7 small-12 columns funnel-slider-content">

                                <h5><?php echo $item->title; ?></h5>

                                <p><?php echo substr($item->description,0,180).'...'; ?> <a href="<?php echo $item->link; ?>" target="_blank"><?php _e('Read More');  ?></a></p>

                            </div>

                        </div>

                    </div>

                <?php else :

                    break;

                endif;

            endforeach; ?>

        </div>

    <img class="funnel-prev" src="<?php bloginfo('template_url') ?>/images/prev.png" />

    <img class="funnel-next" src="<?php bloginfo('template_url') ?>/images/prev.png" />

    <?php endif; ?>

</div>