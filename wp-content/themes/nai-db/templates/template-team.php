<?php
/*
 * Template Name: Team
 */
get_header();

if ( have_posts() ) :
    while ( have_posts() ) : the_post(); ?>
        <div class="top-block" style="background-image: url(<?php echo has_post_thumbnail() ? the_post_thumbnail_url() : bloginfo('template_url').'/images/default.png' ?>);">
            <div class="row columns">
                <?php $post_parent = $post->post_parent;
                if( $post_parent ): ?>
                    <h2><?php echo get_the_title($post_parent); ?></h2>
                <?php else: ?>
                    <h2><?php the_title(); ?></h2>
                <?php endif; ?>
            </div>
            <?php dynamic_sidebar('Top Right Sidebar'); ?>
        </div>
        <div class="row team-page">
            <h1 class="columns"><?php the_title(); ?></h1>
            <?php
            $team_cats = get_terms('team_positions');
            foreach( $team_cats as $one_cat ): ?>
                <div class="small-12 columns">
                    <h4><?php echo $one_cat->name; ?></h4>
                </div>
                <?php $arg = array(
                    'post_type'	    => 'team',
                    'order'		    => 'DESC',
                    'orderby'	    => 'menu_order',
                    'posts_per_page'    => -1,
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'team_positions',
                            'field' => 'id',
                            'terms' => array( $one_cat->term_id ),
                            'operator' => 'IN'
                        )
                    )
                );
                $team_members = get_posts( $arg );
                if ( $team_members ) : ?>
                    <div class="small-12 columns members">
                    <?php foreach( $team_members as $member ): ?>
                        <div class="large-3 medium-4 small-12 columns member-one">
                            <div class="member-one-content"
                               style="background-image: url(<?php echo get_the_post_thumbnail_url($member,'thumbnail') ? get_the_post_thumbnail_url($member,'large') : bloginfo('template_url').'/images/default2.png' ?>);">
                                <a class="member-one-content-link" href="<?php echo get_permalink($member->ID); ?>"></a>
                                <?php if ( $vcard_address = get_field('vcard_address',$member->ID) ) : ?>
                                    <a class="member-one-content-address" href="<?php echo $vcard_address; ?>" download>
                                        <img src="<?php bloginfo('template_url') ?>/images/icon.png" />
                                    </a>
                                <?php endif; ?>
                                <div class="member-one-content-info">
                                    <h6><?php echo $member->post_title; ?></h6>
                                     <hr />
                                    <?php if ( $member_position = get_field('member_position',$member->ID) ) : ?>
                                        <p><?php echo $member_position; ?></p>
                                     <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    </div>
                <?php endif;
            endforeach;?>
        </div>
    <?php endwhile;
endif;

get_footer(); ?>