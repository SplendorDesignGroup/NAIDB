<?php
/*
 * Template Name: News
 */
get_header();

//news block
show_template('news',array('big'=>1)); ?>
<div class="row rss-news">
    <?php
    //funnel news
    get_template_part('parts/funnel-news');
    //global news
    get_template_part('parts/global-news');
    ?>
</div>

<?php get_footer(); ?>