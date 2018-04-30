<?php
global $all_brand_draws;
if (!empty($all_brand_draws)):
?>
<div id="agpage">
<style>
#agpage .all-group {
	clear: both;
	padding: 0px;
	margin: 0px;
	width:100%;
}
#agpage .group-item {
	box-shadow:0 1px 2px rgba(0,0,0,0.15);
	position:relative;
	display: block;
	float:left;
	margin-right:4%;
	width: 20.8%;
	border:1px solid #e6edff;
	border-radius: 3px;
	height:290px;
	text-align:center;
	background: rgb(223,236,255); /* Old browsers */
	background: -moz-linear-gradient(top,  rgba(223,236,255,1) 0%, rgba(223,236,255,1) 45%, rgba(255,255,255,1) 60%, rgba(255,255,255,1) 100%); /* FF3.6-15 */
	background: -webkit-linear-gradient(top,  rgba(223,236,255,1) 0%,rgba(223,236,255,1) 45%,rgba(255,255,255,1) 60%,rgba(255,255,255,1) 100%); /* Chrome10-25,Safari5.1-6 */
	background: linear-gradient(to bottom,  rgba(223,236,255,1) 0%,rgba(223,236,255,1) 45%,rgba(255,255,255,1) 60%,rgba(255,255,255,1) 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#dfecff', endColorstr='#ffffff',GradientType=0 ); /* IE6-9 */
	margin-bottom:15px;
	-webkit-transform:translateY(0);
	-webkit-transition:all .6s cubic-bezier(0.165, 0.84, 0.44, 1);
	transition:all .6s cubic-bezier(0.165, 0.84, 0.44, 1);
}
#agpage .group-item:after {
	border-radius: 3px;
	position:absolute;
	top:0;
	left:0;
	width:100%;
	height:100%;
	box-shadow:0 5px 15px rgba(0,0,0,0.3);
	opacity:1;
	-webkit-transition:all .6s cubic-bezier(0.165, 0.84, 0.44, 1);
	transition:all .6s cubic-bezier(0.165, 0.84, 0.44, 1);
}
#agpage .group-item:hover:after {
	opacity:0;
}
#agpage .group-item:hover {
	-webkit-transform:scale(1.15, 1.15);
	transform:scale(1.15, 1.15);
	z-index:999;
}
#agpage .group-item > * {outline:0;}
#agpage .group-item:hover > * {outline:0;}
#agpage .lotname {
  font-size: 26px;
  font-family: "Robotoregular";
  color: rgb(29, 50, 101);
  text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.42);
}
#agpage .gjackpot-col {width:100%;text-align:center;}
#agpage .gcurrency {
  font-size: 16px;
  font-family: "Robotobold";
  color: rgb(29, 50, 101);
  text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.42);
  line-height:36px;
  margin-right:5px;
}
#agpage .gjackpot {
  font-size: 26px;
  font-family: "Robotobold";
  color: rgb(29, 50, 101);
  text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.42);
  
}
#agpage .group_box {width:100%;border-bottom:1px solid #e6edff;padding-bottom:5px;}
#agpage .group_middle {padding:5px;color: rgb(29, 50, 101);}
#agpage .group_middle a {color: rgb(29, 50, 101);}
#agpage .group_play_button {
	background: #1d3265;
	padding: 5px;
	width: 80%;
	display:block;
	border-radius: 3px;
	box-shadow: 1px 1px 2px 0 rgba(50, 50, 50, 0.25);
	box-sizing: border-box;
	text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.42);
	margin: 0 auto;
	color: #fff;
}
#agpage .group_play_button:hover {
	color: #fff;
}
#agpage .allgroup_img img{width:110px;height:126px;padding-top:10px;}
/*  GROUPING  */
#agpage .all-group:before,
#agpage .all-group:after { content:""; display:table; }
#agpage .all-group:after { clear:both;}
#agpage .all-group { zoom:1; /* For IE 6/7 */ }


/*  GO FULL WIDTH ALL GROUP PAGE BELOW 768 PIXELS */
@media only screen and (max-width: 768px) {
	#agpage .group-item {  margin: 1% 0 1% 0%; }
	#agpage .group-item { width: 100%; }
}
</style>
	<div class="all-group">
	<?php foreach ($all_brand_draws as $key => $value) :
		$price = ($value->PricePerShare / 8);
		$lotteryname = strtolower(ChangeLotteryNameForUrl($value->LotteryName));
		$logo = TEMPLATE_URL . '/images/logos/' . $lotteryname . '1.png';        
		$link = HOME_URL . '/quickpick/' . strtolower(ChangeLotteryNameForUrl($value->LotteryName) . '/group/1/1/0/0/0/');
		if ($value->Jackpot < 0) {
			$jackpot = '<div class="gjackpot">PENDING</div>';
		} else {
			$jackpot = '<div class="gjackpot"><span class="gcurrency">'. $value->LotteryCurrency2 . '</span>' . ($value->Jackpot / 1000000) . ' ' . __('Million','twentythirteen') . '</div>';
		}
	?>
	<div class="group-item">
		<a href = "<?php echo $link; ?>">
		<div class="group_box">
			<div class ="allgroup_img"><img src="<?php echo $logo; ?>"/></div>
			<div class="lotname"><?php echo $value->LotteryName; ?></div>
			<div class="gjackpot-col"><?php echo $jackpot; ?></div>
		</div>
		<div class="group_middle"><strong>50</strong> Lines <strong>150</strong> Shares</div>		
		<div class="group_boxfooter">
			<a href="<?php echo $link; ?>" class="group_play_button"> 1 share € <?php echo  number_format($price, 2) ; ?></a>
		</div>
		</a>
	</div>
	<?php endforeach; ?>
	</div>
</div>
<?php endif; ?>