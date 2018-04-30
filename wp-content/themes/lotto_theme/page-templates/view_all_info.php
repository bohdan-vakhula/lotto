<?php
/**
 * Template Name: View all info
 *
 */
get_header();
?>
<div id="middle" class="innerbg">
    <div class="innerpage">
        <h1><?php the_title(); ?></h1>
        <div class="clear_inner">&nbsp;</div>
        <div class="results-page">
            <?php while (have_posts()) : the_post(); ?>
                <?php the_content(); ?>
            <?php endwhile; ?>
        </div>
        <?php get_template_part('fragments/all-lottery-info-table'); ?>
    </div>
</div>
<?php
get_footer();
