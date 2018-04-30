<?php get_header(); ?>

  	<div class="hadding inner-hadding">
        <h1><?php _e('News'); ?></h1>
    </div>
	<div class="main-content">
		<?php get_template_part( 'loop' ) ?>
		<?php get_sidebar(); ?>
	</div>
    
<?php get_footer(); ?>
