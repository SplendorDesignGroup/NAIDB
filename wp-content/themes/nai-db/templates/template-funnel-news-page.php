<?php

/*

 * Template Name: NAIDB Funnel News Page

 */

get_header(); ?>



<div class="row">

    <div class="columns">

        <h2 class="archive-title"><?php _e('NEWS FUNNEL'); ?></h2>

    </div>

</div>

<!-- BEGIN of Archive Content -->

<div class="row columns archive-content">

    <?php

    $funnel_news_link = get_field('funnel_news_link','options');

    if ( $funnel_news_link ) :

        $funnel_rss = simplexml_load_file($funnel_news_link);

    endif;

    if($funnel_rss):

	error_reporting(0);

        $i = 1; ?>

            <?php foreach ($funnel_rss->channel->item as $item) :

                if($i++ < 21) :

                    $thumbAttr = $item->children('media', true)->content->attributes();

                    $thumbAttr = $item->children('http://search.yahoo.com/mrss/')->content->attributes();

		    if($thumbAttr):

                        $image_url = $thumbAttr['url'];

                    endif;

                    $image_url = $thumbAttr['url'];

                    $old_date_timestamp = strtotime($item->pubDate);

                    $new_date = date('m.d.y', $old_date_timestamp); ?>

                    <article class="large-3 medium-6 small-12 columns one-news">

                        <div class="one-news-content"

                             style="background-image: url(<?php echo $thumbAttr ? $image_url : bloginfo('template_url').'/images/default2.png' ?>);">

                            <div class="one-news-content-info">

                                <span><?php echo $new_date; ?></span>

                                <div class="one-news-content-info-black matchHeight">

                                    <h6><?php $item->title; ?></h6>

                                    <p><?php echo substr($item->description,0,180).'...'; ?></p>

                                    <a href="<?php echo $item->link; ?>" target="_blank"><?php _e('Read More'); ?></a>

                                </div>

                            </div>

                        </div>

                    </article>

                <?php else :

                    break;

                endif;

            endforeach;

    endif; ?>

</div>



<?php get_footer(); ?>