<?php get_header(); the_post(); ?>
	
	<div class="hadding inner-hadding">
        <h2 class="posttitle"><?php the_title(); ?></h2>
    </div>

	<div class="main-content">

		<div <?php post_class() ?>>
			<div class="entry">
				<?php the_content(); ?>
			</div><!-- /div.entry -->
		</div> <!-- /div.post -->

		<div class="blog-navigation clearfix">
			<div class="left"><?php previous_post_link('<i class="ico-arrow-left"></i>%link') ?></div>
			<div class="right"><?php next_post_link('%link<i class="ico-arrow-right"></i>') ?></div>
		</div>
		
		<?php get_sidebar(); ?>
	</div>
	
<?php get_footer(); ?>