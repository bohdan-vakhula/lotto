<?php
/**
 * Template Name: Cart Page
 */
get_header();
?>
<div id="middle" class="innerbg innerbg_select_page singleresult">
    <div class="wrap">
        <div class="banner_txt">
        	<div class="hadding" style="padding: 50px 0px 0px 0px;">
        		<h1>Your order</h1>
        	</div>
        </div> 
		<ngcart-cart templateUrl="<?php echo CART_PARTIALS_URI ?>ngCart/cart.html"></ngcart-cart>
    </div>
</div>            
<?php get_footer(); ?>