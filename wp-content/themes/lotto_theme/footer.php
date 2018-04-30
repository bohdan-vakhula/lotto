</div><!-- ./.wrap -->
</div><!-- ./#content -->
<footer>
    <div class="wrap center-mid">
        <div class="footer_part2">
            <div class="footer_part2_right">
                <div class="footer_nav">
                    <ul>
                        <li><a class="footerheading"><h1><?php _e('Company') ?></h1></a></li>
                        <?php
                            wp_nav_menu(array(
                            'theme_location' => '',
                            'menu' => 'Support',));
                        ?>
                        <div class="socialicons2">
                            <a href="https://www.pinterest.com/#" target="_blank"><img src="<?php echo bloginfo("template_directory"); ?>/images/pininterest_ico2.png" alt="orolotto on Pinterest"/></a>
                            <a href="https://www.facebook.com/pages/#" target="_blank"><img src="<?php echo bloginfo("template_directory"); ?>/images/facebook_ico2.png" alt="orolotto FaceBook page"/></a>
                            <a href="https://twitter.com/#" target="_blank"><img src="<?php echo bloginfo("template_directory"); ?>/images/twitter_ico2.png" alt="follow orolotto on twitter"/></a>
                            <!--<div class="footer_logo">
                            <img src="<?php echo TEMPLATE_URL ?>/images/lottoyard.png" alt="Powered by LottoYard" />
                            </div>-->
                        </div>
                    </ul>
                    <ul>
                        <li><a href="<?php echo esc_url(get_permalink(get_page_by_title('View all lottery'))); ?>" class="footerheading"><h1><?php _e('Play Lottery') ?></h1></a></li>

                        <?php
                            wp_nav_menu(array(
                            'theme_location' => '',
                            'menu' => 'Play Lottery',));
                        ?>
                    </ul>

                    <ul>
                        <li><a href="<?php echo get_permalink(244); ?>" class="footerheading"><h1><?php _e('Lottery Results') ?></h1></a></li>
                        <?php
                            wp_nav_menu(array(
                            'theme_location' => '',
                            'menu' => 'Lottery Results',));
                        ?>
                    </ul>

                    <ul>
                        <li><a href="<?php echo get_permalink(285); ?>" class="footerheading"><h1><?php _e('Lottery Info') ?></h1></a></li>
                        <?php
                            wp_nav_menu(array(
                            'theme_location' => '',
                            'menu' => 'Lottery Info',));
                        ?>
                    </ul>
                    <ul>
                       <?php /*
                       
                        <li><a href="#" class="footerheading"><h1><?php _e('Banking') ?></h1></a></li>
                        <div class="banking-pic"></div>
                        
                        */ ?>
                        <li><a href="#" class="footerheading"><h1><?php _e('Contact Us') ?></h1></a></li>
                        <div class="contactus-pic">
                            <a href="">Live Chat</a>
                            <a href="mailto:support@orolotto.com">Write Us</a>
                            <a href="">+44-203-5145447</a>
                        </div>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="footer_down">
        <div class="wrap">
            <?php if (wp_is_mobile()){ ?>
                <div class="footer_part1">
                    <?php /*
                    <div class="footerpayments"><img src="<?php echo TEMPLATE_URL ?>/images/128bitSecurity.png" alt="orolotto Site Security Protocol"/></div>
                    <div class="footerpayments"><img src="<?php echo TEMPLATE_URL ?>/images/ticketscan.png" alt="orolotto Ticket Scan System"/></div>
                    <div class="footerpayments"><img src="<?php echo TEMPLATE_URL ?>/images/customer-service.png" alt="orolotto Best Customer Service"/></div>
                    <!-- <div class="footerpayments"><img src="<?php echo TEMPLATE_URL ?>/images/poweredby.png" alt="orolotto system service"/></div> -->
                    */?>
                    <img src="<?php echo TEMPLATE_URL ?>/images/lottery-payment.png" alt="orolotto Site Payments Protocol"/>
                </div>
                <?php } else { ?>
                <div class="footer_part1">
                    <?php /*
                    <div class="footerpayments inline"><img src="<?php echo TEMPLATE_URL ?>/images/128bitSecurity.png" alt="orolotto Site Security Protocol"/></div>
                    <div class="footerpayments inline"><img src="<?php echo TEMPLATE_URL ?>/images/ticketscan.png" alt="orolotto Ticket Scan System"/></div>
                    <div class="footerpayments inline"><img src="<?php echo TEMPLATE_URL ?>/images/customer-service.png" alt="orolotto Best Customer Service"/></div>
                    <!-- <div class="footerpayments inline"><img src="<?php echo TEMPLATE_URL ?>/images/poweredby.png" alt="orolotto system service"/></div> -->
                    
                    */?>
                    <img src="<?php echo TEMPLATE_URL ?>/images/lottery-payment.png" alt="orolotto Site Payments Protocol"/>
                </div>
                <?php } ?>
        </div>
        <!-- dynamic fire pixel-->
        <iframe id="dynamic_fire_pixel" width="1px" height="1px" src="" frameborder="0" scrolling="no"></iframe>
    </div>
    <div class="footer_part3">
        <div class="copyright">
            <p>
                <a href="http://www.lottoworldgroup.com/" target="_blank">www.lottoworldgroup.com</a> &nbsp;
                <span id="Label17">is owned and operated by LWGL Lotto World Group Ltd.</span>
            </p>
            <p>
                <span id="address">Our office is located at 17, Dimitriou Mitropoulou SKIATHOS 33 COURT Strovolos, 2013 Nicosia, Cyprus, company registration number HE340709</span>
            </p>
        </div>
    </div>
</footer>
</main>
<?php
    if (!isset($_SESSION['user_data'])) {
        # code...
        get_template_part('fragments/popup-sign-in-form');
        get_template_part('fragments/popup-sign-up-form');
    }
?>
<?php /*
    <!--Start of Zopim Live Chat Script-->
    <script type="text/javascript">
    window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
    d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
    _.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute("charset","utf-8");
    $.src="//v2.zopim.com/?4DRlFyUEIFavryIXn7S5zjDqwF69u7QE";z.t=+new Date;$.
    type="text/javascript";e.parentNode.insertBefore($,e)})(document,"script");
    </script>
    <!--End of Zopim Live Chat Script-->

*/ ?>


<!-- <script type='text/javascript' src='https://novomidas.com/cn/cn2.php?id=1005'></script> -->

</body>
<?php wp_footer(); ?>
</html>
