<?php
/*
 * Template Name: NAIDB News Page
 */
get_header(); ?>

<div class="row">
    <div class="columns">
        <h2 class="archive-title"><?php _e('NAIDB NEWS'); ?></h2>
    </div>
</div>
<!-- BEGIN of Archive Content -->
<div class="row columns archive-content">
    <?php
    $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
    $arg = array(
        'post_type'	    => 'post',
        'order'		    => 'DESC',
        'orderby'	    => 'date',
        'posts_per_page'    => 20,
        'paged' => $paged
    );
    $the_query = new WP_Query( $arg );
        if ( $the_query->have_posts() ) :
            while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
            <article id="post-<?php the_ID(); ?>" class="large-3 medium-6 small-12 columns one-news">
                <div class="one-news-content"
                     style="background-image: url(<?php echo has_post_thumbnail() ? get_the_post_thumbnail_url() : bloginfo('template_url').'/images/default2.png' ?>);">
                    <div class="one-news-content-info">
                        <span><?php echo the_time('m.d.y'); ?></span>
                        <div class="one-news-content-info-black matchHeight">
                            <?php $cats = get_the_category($post->ID);
                            foreach( $cats as $one_cat ) :
                                if($one_cat->parent != 0) :?>
                                    <h6 class="cat"><?php echo $one_cat->name; ?></h6>
                                <?php endif;
                            endforeach; ?>
                            <h6><?php the_title(); ?></h6>
                            <p><?php the_excerpt(); ?></p>
                            <a href="<?php echo get_permalink($post->ID); ?>"><?php _e('Read More'); ?></a>
                        </div>
                    </div>
                </div>
            </article>
        <?php endwhile;
    endif; ?>
</div>
<div class="row pagination text-center">
    <?php foundation_pagination($the_query); ?>
</div>

<?php get_footer(); ?>