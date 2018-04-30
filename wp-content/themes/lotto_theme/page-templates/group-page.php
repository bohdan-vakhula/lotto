<?php
/**
 * Template Name: Group Page
 *
 */
get_header();
?>
    <div id="middle" class="innerbg">
        <div class="wrap">
            <div class="innerpage">
                    <h1><?php the_title(); ?></h1>
					<div class="clear_inner">&nbsp;</div>
                    <?php get_template_part('fragments/all-brand-group'); ?>
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
