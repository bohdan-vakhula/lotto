<?php get_header(); ?>

    <div class="hadding inner-hadding">
        <h1><?php _e('Oops !, Page not found', 'twentythirteen'); ?></h1>
    </div>
    <div class="main-content">
    <?php 
        printf(__('<p>Please check the URL for proper spelling and capitalization.<br />If you\'re having trouble locating a destination, try visiting the <a href="%1$s">home page</a>.</p>', 'crb'), home_url('/'));
    ?>
    </div>
    
<?php get_footer(); ?>