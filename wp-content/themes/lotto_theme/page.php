<?php get_header(); ?>

    <div class="hadding inner-hadding">
        <h1><?php the_title(); ?></h1>
    </div>
	<?php while ( have_posts() ) : the_post(); ?>
		<div class="main-content">
			<?php the_content(); ?>
		</div>
	<?php endwhile; ?>
	
<?php get_footer(); ?>
