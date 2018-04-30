<?php
    /**
    * Template Name: Lottery Result
    *
    */
    get_header();
?>

<div id="middle" class="innerbg" style="margin-top: 0px;">
    <div class="innerpage">
        <!--<h1><?php the_title(); ?></h1>-->
        <div class="all-lot-res-title">
            <h1>Latest Lottery games results</h1>
        </div>
        <!--<div class="clear_inner">&nbsp;</div>-->
        <?php get_template_part('fragments/all-lottery-result-table'); ?>
        <div class="clear_inner">&nbsp;</div>
        <div class="results-page">
            <?php while (have_posts()) : the_post(); ?>
                <?php the_content(); ?>
                <?php endwhile; ?>
        </div>
    </div>
</div>
<?php
get_footer();
