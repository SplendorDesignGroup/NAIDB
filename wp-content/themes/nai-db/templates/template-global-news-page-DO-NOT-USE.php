<?php
/*
 * Template Name: NAIDB Global News Page
 */
get_header(); ?>

    <div class="row">
        <div class="columns">
            <h2 class="archive-title"><?php _e('NAIDB GLOBAL NEWS'); ?></h2>
        </div>
    </div>
    <!-- BEGIN of Archive Content -->
    <div class="row columns archive-content">
        <?php
        $global_news_link = get_field('global_news_link','options');
        if ( $global_news_link ) :
            $global_rss = simplexml_load_file($global_news_link);
        endif;
        if($global_rss):
            $k = 1;
            foreach ($global_rss->channel->item as $item) :
                    if($k++ < 21) :
                        $thumbAttr = $item->children('media', true)->content->attributes();
                        $thumbAttr = $item->children('http://search.yahoo.com/mrss/')->content->attributes();
                        $image_url = $thumbAttr['url'];
                        $old_date_timestamp = strtotime($item->pubDate);
                        $new_date = date('m.d.y', $old_date_timestamp); ?>
                        <article class="large-3 medium-6 small-12 columns one-news">
                            <div class="one-news-content"
                                 style="background-image: url(<?php echo $image_url ? $image_url : bloginfo('template_url').'/images/default2.png' ?>);">
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