<?php
/*
 * Template Name: FAQ Page
 *
 */
get_header(); ?>

    <div class="hadding inner-hadding">
        <h1><?php the_title(); ?></h1>
    </div>
	<?php while ( have_posts() ) : the_post(); ?>
		<div class="main-content row">
			
			<?php the_content(); ?>

			<div class="col-md-4">
				<?php if( have_rows('faqs') ): ?>
				<ul class="faq-nav">
				<?php
				$question_count = 1;
			    while ( have_rows('faqs') ) : the_row(); ?>
					<li data-question="<?php echo $question_count; ?>"><?php the_sub_field('question'); ?></li>
				<?php 
				$question_count ++;
			    endwhile;
				?>
				</ul>
				<?php endif ?>
			</div>
			
			<div class="col-md-8">
				<?php if( have_rows('faqs') ): ?>
				<ul class="faq-main">
				<?php
				$question_count = 1;
			    while ( have_rows('faqs') ) : the_row(); ?>
					<li data-question-content="<?php echo $question_count; ?>">
				    	<h3 class="question-title"><i class="ico-plus-minus"></i><?php the_sub_field('question'); ?></h3>
				    	<div class="answer-content">
				    		<?php the_sub_field('answer'); ?>
				    	</div>
				    </li>
				<?php 
				$question_count ++;
			    endwhile;
				?>
				</ul>
				<?php endif ?>
			</div>

		</div>
	<?php endwhile; ?>
	
<?php get_footer(); ?>
