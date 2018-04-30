<?php get_header(); ?>

	<div class="hadding inner-hadding">
		<h2 class="pagetitle"><?php _e('Search Results'); ?></h2>
    </div>
	
	<div class="main-content">
		<?php get_template_part('loop', 'search') ?>
		<?php get_sidebar(); ?>
	</div>
	
<?php get_footer(); ?>