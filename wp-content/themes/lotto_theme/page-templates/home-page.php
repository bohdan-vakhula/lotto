<?php
    /**
    * Template Name: Home Page
    */
    get_header();
?>

<?php get_template_part('fragments/banner');?>

<div style="min-height: 715px; position:relative; width: 100%;">
    <div id="middle_about" class="homeleft">
        <div class="lotteryresults">
            <h1><?php _e('Latest Lottery Result','twentythirteen'); ?></h1>
            <div class="lotteryresultslist">
                <?php
                    get_template_part('fragments/home-lottery-result-sroll');
                ?>
            </div>
            <a style="float:right" href="<?php echo HOME_URL ?>/lottery-results/"><?php _e('Check all Results', 'twentythirteen'); ?><i class="ico-arrow-right"></i></a>
        </div>
        <!--<div class="videospace">
        <img src="<?php echo TEMPLATE_URL; ?>/images/video.png" class="video"></img>
        </div>-->
    </div>

    <div id="middle_about" class="homeright" >
        <div class="news">
            <h1><?php _e('How Groups Work', 'twentythirteen'); ?></h1>

            <div style="border-bottom:1px solid rgb(219,224,238); margin-bottom:5px; line-height:20px;" class="col3">
                <div style="float:left;width:100%;">
                    <?php _e('Joining a group allows you to purchase 50 lines per draw + all the bonus combination at a fraction of the cost.
                        Currently we create the groups for our members making sure all bonus combinations are covered and hence winning is almost guaranteed.
                        Each group has 150 shares and anyone can join as long as shares last. Don’t miss your chance to join and win at a fraction of the cost.
                        Groups are a fun way to play the world’s most rewarding lotteries while increasing winning chances by 4,500%.</br><b>Coming soon:</b>
                        Create your own group – we will soon allow our most valuable members to create their own groups for their lottery of choice, selecting THEIR
                        OWN lucky numbers and invite their friends to join. Stay tuned! Coming soon. Click here to preregister as a group moderator.
                        ', 'twentythirteen'); ?> <br />
                </div>
            </div>
            <a style="margin-bottom:40px;" href="https://www.orolotto.com/all-group/<?php echo HOME_URL ?>/" class="right"><?php _e( 'See all group options >', 'twentythirteen'); ?><i class="ico-arrow-right"></i></a>
            <?php $testimonials = query_posts('post_type=testimonial&posts_per_page=-1&orderby=rand'); ?>
            <?php if ($testimonials): ?>
                <?php /*
                    <!--<div id="box-testimonials" class="part">
                    <h1><?php _e( 'Testimonials', 'twentythirteen' ); ?></h1>
                    <div class="testimonials-nav">
                    <a href="#" class="lotto_control_next"><i class="ico-arrow-left"></i><?php _e('Next', 'twentythirteen'); ?></a>
                    <a href="#" class="lotto_control_prev"><?php _e('Prev', 'twentythirteen'); ?><i class="ico-arrow-right"></i></a>
                    </div>
                    <ul class="testimonials">
                    <?php
                    while(have_posts()){
                    the_post();
                    ?>
                    <li>
                    <span class="title-testimonials"><?php the_title(); ?></span>
                    <span class="auth-testimonials"><?php the_field('testimonial_author'); ?></span>
                    <div class="clear"></div>
                    <div class="text-testimonials">
                    <?php echo wp_trim_words(get_the_content(), $num_words = 30, $more = null); ?>
                    </div>
                    </li>
                    <?php
                    }
                    wp_reset_query();
                    ?>
                    </ul>
                    </div>-->
                */ ?>
                <?php endif ?>
                
            <div style="width:100%; height:393px;margin-top:220px;">
                <h1 style="margin-top:40px;"><?php _e('Latest news', 'twentythirteen'); ?></h1>
                <div id="box-news" class="clearfix">
                    <?php
                        $idObj = get_category_by_slug('latest-news');
                        $id = $idObj->term_id;
                        $catquery = new WP_Query('cat='.$id.'&posts_per_page=3');
                        while ($catquery->have_posts()) : $catquery->the_post();
                        ?>
                        <div class="partnews">
                            <?php
                                $thedate = get_the_date('d M');
                                $datenum = preg_replace('/[^0-9]/', '', $thedate);
                                $dateletters = preg_replace('/[^a-zA-Z]/', '', $thedate);
                            ?>
                            <div class="col3">
                                <div class="datetxt">
                                    <div class="datenum"><?php echo $datenum; ?></div>
                                    <div class="dateletters"><?php echo $dateletters; ?></div>
                                </div>
                                <h2>
                                    <a href="<?php the_permalink() ?>">
                                        <?php the_title(); ?>
                                    </a>
                                </h2>
                                <div class="textwidget">
                                    <?php
                                        $content = get_the_content();
                                        echo mb_substr($content, 0, 170).'...';
                                    ?>
                                </div>
                            </div>
                        </div>
                        <?php endwhile;
                    ?>
                </div>
            </div>
            
        </div>
        <a href="<?php echo HOME_URL ?>/news/" class="right"><?php _e( 'Read more', 'twentythirteen'); ?><i class="ico-arrow-right"></i></a>
    </div>
</div>
<?php /*
    <div class="middle_part4">
    <div class="banner">
    <div class="round">
    <img src="<?php echo TEMPLATE_URL; ?>/images/24support.png" alt="" />
    </div>
    <div class="banner-part">
    <h3><?php _e('24/7 customer support', 'twentythirteen'); ?></h3>
    <div style="margin-top: 20px;"class="middle_part_text"><?php _e('Best of class customer support via Email, Chat and telephone.', 'twentythirteen'); ?></div>
    </div>
    </div>
    <div class="banner">
    <div class="round">
    <img src="<?php echo TEMPLATE_URL; ?>/images/100secure.png" alt="" />
    </div>
    <div class="banner-part">
    <h3><span class="larger"><?php _e('100', 'twentythirteen');?></span><?php _e('% Secure', 'twentythirteen'); ?></h3>
    <div class="middle_part_text"><?php _e('All transactions made on this site are protected by GeoTrust 128-bit SSL security layer.', 'twentythirteen'); ?></div>
    </div>
    </div>
    <div class="banner">
    <div class="round">
    <img src="<?php echo TEMPLATE_URL; ?>/images/money-back-guarantee.png" alt="" />
    </div>
    <div class="banner-part no-border">
    <h3><?php _e('Money Back Guarantee', 'twentythirteen'); ?></h3>
    <div style="margin-top: 20px;" class="middle_part_text"><?php _e('If, for any reason you are dissatisfied with our service, we will refund your first purchase in full.', 'twentythirteen'); ?></div>
    </div>
    </div>
    </div>

*/?>

<div class="middle_part4">
    <div class="titleline osregular">
        <h2>
            <span id="ContentPlaceHolder1_Label64"><?php _e('security on', 'twentythirteen'); ?></span>
            <span class="blue">
                <span id="ContentPlaceHolder1_Label65"><?php _e('lotto', 'twentythirteen'); ?></span>
            </span>
            <span id="ContentPlaceHolder1_Label66"><?php _e('world', 'twentythirteen'); ?></span>
            <span class="blue">
                <span id="ContentPlaceHolder1_Label53"><?php _e('group', 'twentythirteen'); ?></span>
            </span>
        </h2>
        <div class="clear">
        </div>
    </div>
    <div class="hrtitlecontent"></div>
    <div class="banner">
        <div class="round">
            <img src="<?php echo TEMPLATE_URL; ?>/images/securitylwg1.png" alt="">
        </div>
        <div class="banner-part">
            <h3><?php _e('100% SATISFACTION GUARANTEED', 'twentythirteen'); ?></h3>
            <div class="hrtitlecontent"></div>
            <div class="contentcontentline">
                <p class="prizetxt">
                    <span id="ContentPlaceHolder1_Label51"><?php _e('We guarantee 100% satisfaction from our service.', 'twentythirteen'); ?></span>
                </p>
                <div class="clear"></div>
            </div>
        </div>
    </div>
    <div class="banner">
        <div class="round">
            <img src="<?php echo TEMPLATE_URL; ?>/images/securitylwg2.png" alt="">
        </div>
        <div class="banner-part">
            <h3><?php _e('100% Secure', 'twentythirteen'); ?></h3>
            <div class="hrtitlecontent"></div>
            <div class="contentcontentline">
                <p class="prizetxt">
                    <span id="ContentPlaceHolder1_Label52"><?php _e('We use the highest level of SSL protection on our website
                        To ensure all your payment details are safe and secure.', 'twentythirteen'); ?></span>
                </p>
                <div class="clear">
                </div>
            </div>
        </div>
    </div>
    <div class="banner">
        <div class="round">
            <img src="<?php echo TEMPLATE_URL; ?>/images/securitylwg3.png" alt="">
        </div>
        <div class="banner-part no-border">
            <h3><?php _e('CUSTOMER SUPPORT', 'twentythirteen'); ?></h3>
            <div class="hrtitlecontent"></div>
            <div class="contentcontentline">
                <p class="prizetxt">
                    <span id="ContentPlaceHolder1_Label54"><?php _e('Need help? Our customer support are here for you.
                        Either by phone, live-chat or email we are here for you 24/7.', 'twentythirteen'); ?></span>
                </p>
                <div class="clear">
                </div>
            </div>
        </div>
    </div>
</div>

</div>
</div>

<!--<div class="full-width">
<div class="wrap">
<h3><?php _e( 'Buying Lottery Tickets Online Has Never Been Easier!', 'twentythirteen'); ?></h3>
<div class="plus">+</div>
<div class="full-width-text" style="display: none;">
<p><?php _e( 'Not so long ago, playing the lottery meant going over to your neighborhood grocery’s lotto ticket-dispensing machine to buy tickets. Forget all that. You can now buy lottery tickets online, all from the comfort of your own home or office, and even from your mobile smartphone. As long as you’re online and can surf the Web, you can go to the Orolotto website (www.Orolotto.com), buy a virtual ticket, choose your lotto numbers, and view lottery results, all from the comfort of your own desk or phone. But the best part about getting onto Orolotto online lottery via is you’re no longer stuck to playing locally.', 'twentythirteen'); ?></p>
<p><?php _e( 'You can now gain access to other major lotteries from other countries, which now permit online participation. Examples of major lotteries you can access through Orolotto include Spain’s El Gordo de la Primitiva (sometimes called El Gordo for short), Canada’s Lotto 649, and the EU’s classic giant lottery, Euro Millions. Of course, access to the best and the biggest of American lotteries is also available. You can try your luck at Power Ball and Mega Millions. It’s not an online version of your grocery lotto dispenser machine. Orolotto gives you one distinct advantage, too: there are special group subscriptions and rewards (e.g., Tell A Friend) for you and your friends, which will let you participate in more lottery draws—thus, raising your chances of actually winning a prize in any of these online lotteries.', 'twentythirteen'); ?></p>
<p><?php _e( 'The site also acts like your lottery monitoring dashboard and odds-detector in one. For any of the lotteries mentioned, you can view the odds of winning the jackpot, the history of lottery results, details on any secondary prizes (plus the odds of winning those), and even information on which numbers are the least or most often drawn. Online payment for your purchased lottery tickets can be done through various means, which include major credit cards, Neteller, GiroPay, and iDeal. Should you win, the process of cashing out your prize can also be done online.', 'twentythirteen'); ?></p>
</div>
<script type="text/javascript">
var plusOpened = false;
jQuery(".plus").click(function (){
plusOpened = !plusOpened;
if (plusOpened) {
jQuery(this).html("-");
jQuery('.full-width-text').show();
} else {
jQuery(this).html("+");
jQuery('.full-width-text').hide();
}
})
</script>
</div>
</div>-->

<?php if (!empty($_SESSION['user_data'])): ?>
    <div id="middle_sec"></div>
    <?php else: ?>
    <script type="text/javascript">
        jQuery(function ($) {
            jQuery(this).find("#middle_sec")
            .click(function(){
                jQuery(".show-sign-up").click();
            });
        });
    </script>
    <div id="middle_sec" style="cursor:pointer;">
        <div class="bannersignup"></div>

    </div>
    <?php endif ?>

<div id="wrap" class="loyality_div">
    <div class="triangle"></div>
    <h2>Our exclusive Loyalty Program</h2>
    <div class="half">
        <div class="half-wrap right">
            <?php dynamic_sidebar("viployality"); ?>
        </div>
    </div>
    <div class="half">
        <div class="half-wrap">
            <?php dynamic_sidebar("money_back"); ?>
        </div>
    </div>
    </div>

<?php get_footer(); ?>
