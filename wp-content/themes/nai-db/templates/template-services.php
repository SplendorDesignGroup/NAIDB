<?php
/*
 * Template Name: Service
 */
get_header();

if ( have_posts() ) :
    while ( have_posts() ) : the_post(); ?>
        <div class="service">
            <div class="top-block" style="background-image: url(<?php echo has_post_thumbnail() ? the_post_thumbnail_url() : bloginfo('template_url').'/images/default.png' ?>);">
                <div class="row columns">
                    <h2><?php echo get_the_title($post->post_parent) ? get_the_title($post->post_parent) : the_title(); ?></h2>
                </div>
                <?php dynamic_sidebar('Top Right Sidebar'); ?>
            </div>
            <div class="row">
                <article class="large-9 medium-8 small-12 columns">
                    <h1><?php the_title(); ?></h1>
                    <?php if (have_rows('service_content')):
                        while (have_rows('service_content')) : the_row();
                            if (get_row_layout() == 'text') {
                                if ( $text = get_sub_field('text') ) :
                                    echo $text;
                                endif;
                            } elseif (get_row_layout() == 'list') {
                                $list_columns = get_sub_field('list_columns');
                                if ( $list_title = get_sub_field('list_title') ) : ?>
                                    <h4 class="service-list-title"><?php echo $list_title; ?></h4>
                                <?php endif;
                                if (have_rows('list')) : ?>
                                    <ul class="row">
                                        <?php while(have_rows('list')) : the_row();
                                            if ( $item = get_sub_field('item') ) : ?>
                                                <li class="medium-<?php echo $list_columns ?> small-12 columns matchHeight">
                                                    <?php echo $item; ?>
                                                </li>
                                            <?php endif;
                                        endwhile; ?>
                                    </ul>
                                <?php endif;
                            }
                        endwhile;
                    endif; ?>
                </article>
                <div class="large-3 medium-4 small-12 columns sidebar">
                    <?php dynamic_sidebar('Services Sidebar'); ?>
                </div>
            </div>
        </div>
            <?php if ( get_field('show_updates_block') == '1' ) :
                get_template_part('parts/updates');
            endif; ?>
    <?php endwhile;
endif;

get_footer(); ?>