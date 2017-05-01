<?php
/*
 * Single Team Page
 */
get_header();

if ( have_posts() ) :
    while ( have_posts() ) : the_post(); ?>
    <div class="top-block" style="background-image: url(<?php echo bloginfo('template_url').'/images/default.png' ?>);">
        <div class="row columns">
            <h2><?php _e('About Us'); ?></h2>
        </div>
        <?php dynamic_sidebar('Top Right Sidebar'); ?>
    </div>
    <div class="row s-team">
        <div class="large-3 medium-4 small-12 columns">
            <?php if (has_post_thumbnail()) : ?>
                <a href="<?php echo the_post_thumbnail_url(); ?>" class="fancybox" title="<?php the_title_attribute(); ?>">
                    <?php the_post_thumbnail('large'); ?>
                </a>
            <?php endif; ?>
            <div class="columns">
                <h4><?php the_title(); ?></h4>
                <?php
                if ( $member_position = get_field('member_position') ) : ?>
                    <p class="s-team-position"><?php echo $member_position; ?></p>
                <?php endif;
                if ( $member_telephone = get_field('member_telephone') ) : ?>
                    <a class="s-team-contact" href="tel:<?php echo preparePhone($member_telephone); ?>" ><?php echo $member_telephone; ?></a>
                <?php endif;
                if ( $member_email = get_field('member_email') ) : ?>
                    <a class="s-team-contact" href="mailto:<?php echo $member_email; ?>" ><?php echo $member_email; ?></a>
                <?php endif;
                if ( $vcard_address = get_field('vcard_address') ) : ?>
                    <a href="<?php echo $vcard_address; ?>" download>
                        <img class="s-team-address" src="<?php bloginfo('template_url') ?>/images/icon_black.png" />
                    </a>
                <?php endif; ?>
            </div>
        </div>
        <div class="large-9 medium-8 small-12 columns">
            <h1 class="s-team-title"><?php the_title(); ?></h1>
            <?php the_content('',true); ?>
        </div>
    </div>
    <?php endwhile;
endif;

get_footer(); ?>
