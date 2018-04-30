<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" >
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" >
<![endif]-->
<!--[if !(IE 7) & !(IE 8)]><!-->
<!--<![endif]-->
<html <?php language_attributes(); ?> ng-app="myApp" ng-controller="mainCtrl">
    <head  id="Head1">
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width">
        <title><?php wp_title('&laquo;', true, 'right'); ?></title>
        <link rel="profile" href="http://gmpg.org/xfn/11">
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo TEMPLATE_URL ?>/images/favicon.ico" />

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-87803675-1', 'auto');
  ga('send', 'pageview');

</script>
	
        <?php wp_head(); ?>





        <!--<script type="text/javascript">
            CONFIG.isMobile = false;
        </script>-->

        <!--[if lt IE 9]>
        <script src="<?php echo TEMPLATE_URL ?>/js/html5.js"></script>
        <![endif]-->

        <?php if (!empty($_SESSION['user_data'])): ?>
        <style type="text/css">
            .is-login { display: none !important; }
        </style>
        <?php endif ?>

    </head>
    <body <?php body_class(); ?>>
	
        <main>
            <header id="header" class="clearfix">
                <div class="wrap">
                    <a class="logo" href="<?php echo HOME_URL ?>"><?php echo get_bloginfo('name'); ?></a>

                    <a href="#" data-href="nav" class="mobile-trigger trigger-nav">
                        <i>
                            <span class="line-1"></span>
                            <span class="line-2"></span>
                            <span class="line-3"></span>
                        </i>
                    </a>

                    <div id="menu-container">
                        <div class="wrap-top-menu">
                            <?php
                                $arg = array(
                                    'menu'=>'Header menu',
                                    'container'=>'',
                                    'menu_class'=>'top-menu',
                                    'items_wrap'=>'<ul id="%1$s" class="%2$s">%3$s</ul>'
                                );
                                wp_nav_menu($arg);
                            ?>
                            <?php if (empty($_SESSION['user_data'])): ?>
                            <div class="wrap-cta">
                                <button type="button" class="show-sign-in"><i class="ico-sign-in"></i><?php _e('Sign in','twentythirteen');?></button>
                                <button type="button" class="show-sign-up"><i class="ico-sign-up"></i><?php _e('Sign up','twentythirteen');?></button>
                            </div>

                            <?php endif ?>
                            <ngcart-summary ng-cloak templateUrl="<?php echo CART_PARTIALS_URI ?>ngCart/summary.html"></ngcart-summary>

                        </div><!-- ./wrap-top-menu -->


                        <div class="wrap-popups hidden-xs">
                       <?php
                            get_template_part('fragments/dropdown-play-lottery');
                            get_template_part('fragments/dropdown-lotteries-results');
                            get_template_part('fragments/popup-user-box');
                        ?>
                        </div><!-- ./wrap-popups -->
                    </div><!-- ./menu-container -->

                </div><!-- ./wrap-header -->
            </header><!-- ./header -->

            <div id="main" class="clearfix">

                <?php if (is_front_page()): ?>
                <?php
                    get_template_part('fragments/home-phoenix-slider');
                    //get_template_part('fragments/home-owl-slider');
                ?>
                <div class="wrap last">
                    <div id="boxes">
                        <div data-content="1" class="col-4 box-style-1">
                            <h1><?php _e( 'Choose', 'twentythirteen' ); ?></h1>
                            <p><?php _e( 'Choose a lottery and your lucky numbers.', 'twentythirteen' ); ?></p><br /><br />
                        </div>
                        <div  data-content="2" class="col-4 box-style-1">
                            <h1><?php _e( 'Purchase', 'twentythirteen' ); ?></h1>
                            <p><?php _e( 'An official ticket is purchased on your behalf.', 'twentythirteen' ); ?></p><br />
                        </div>
                        <div  data-content="3" class="col-4 box-style-1">
                            <h1><?php _e( 'View', 'twentythirteen' ); ?></h1>
                            <p><?php _e( 'Your scanned ticket in your account.', 'twentythirteen' ); ?></p>
                        </div>
                        <div  data-content="4" class="col-4 box-style-1">
                            <h1><?php _e( 'Win', 'twentythirteen' ); ?></h1>
                            <p><?php _e( 'Winnings are credited directly to your account.', 'twentythirteen' ); ?></p><br />
                        </div>
                    </div>
                </div>
				<div class="clear">
				</div>
                <?php
                    get_template_part('fragments/home-owl-slider');
                    get_template_part('fragments/cart-partials/special-lottery-games');
                ?>

                <?php elseif (is_page_template('page-templates/buynow.php')): ?>

                    <div class="bg-inner-buy"></div>

                <?php else: ?>

                    <div class="bg-inner"></div>

                <?php endif ?>

                <div class="wrap">
