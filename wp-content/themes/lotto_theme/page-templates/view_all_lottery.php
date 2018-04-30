<?php
    /**
    * Template Name: View all lottery
    *
    */
    get_header();
?>
<div id="middle" class="innerbg" style="margin-top: 0px;">
    <div class="wrap">
        <div class="innerpage">
            <!--<h1><?php the_title(); ?></h1>-->
            <div class="all-lot-title">
                <h1>Coming Lottery games at LWG</h1>
            </div>
            <!--<div class="clear_inner">&nbsp;</div>-->
            <?php get_template_part('fragments/all-brand-draw-table'); ?>
            <div class="clear_inner">&nbsp;</div>
            <div class="resultschecker">
                <?php while (have_posts()) : the_post(); ?>
                    <?php the_content(); ?>
                    <?php endwhile; ?>
            </div>
        </div>
    </div>
    </div>
<?php
get_footer();
