<style type="text/css">
#scroller > li:nth-of-type(even) {background-color:rgb(219, 224, 238);}
</style>
<?php
global $lotteries_results;
if (!empty($lotteries_results)):
?>
<ul class="container" id="scroller">
<?php	
	$foreachindex = '';
    foreach ($lotteries_results as $key => $val) :
	if(($val->LotteryTypeId == 27) || ($val->LotteryTypeId == 13) || ($val->LotteryTypeId == 24) ) continue; //hide fathersday, navidad, elnino
        $green2 = $green = $blue = '';
        if (isset($val->WinningResult) && $val->WinningResult != "") :
            $temp = explode("#", $val->WinningResult);
            if (isset($temp[1]) && $temp[1] != "") {
                $temp_1 = explode(",", $temp[1]);
                $green = (count($temp_1) > 1) ? '<li class="ellipse_green">' . implode('</li><li class="ellipse_green">',
                        $temp_1) . "</li>" : '<li class="ellipse_green">' . $temp[1] . '</li>';
            } else {
                $green = "";
            }
            $lotteryname = strtolower(ChangeLotteryNameForUrl($val->LotteryName)); ?>
            <li class="block" <?php // if($foreachindex % 2 == 0){ echo "style='background-color:rgb(219, 224, 238);'";} ?>>
            <?php
			$temp1 = explode(",", $temp[0]);
            $blue = '<li class="ellipse_blue">' . implode('</li><li class="ellipse_blue">', $temp1) . "</li>";
            if ($val->BonusNumber > 0) {
                $temp2 = explode(",", $val->BonusNumber);
                $green2 = '<li class="ellipse_green special">' . implode('</li><li class="ellipse_green special">',
                        $temp2) . "</li>";
            } else {
                $green2 = "";
            }
            ?>
                <a href="<?php echo home_url() . '/' . $lotteryname; ?>-results/" class="item">
					<div class="datetxtres"><div class="datenum"><?php echo date("d ", changeDate($val->LotteryName, $val->DrawDate)); ?></div><div class="dateletters"><?php echo date("M", changeDate($val->LotteryName, $val->DrawDate)); ?></div></div>
                    <div class="hadding">
                        <div class="name"><?php echo $val->LotteryName; ?></div>
                    </div>
                    <div class="result">
                        <ul>
                            <?php echo $blue . $green . $green2; ?>
                        </ul>
                    </div>
                </a>
            </li>
        <?php endif; ?>
        <?php $foreachindex++; ?>
    <?php endforeach; ?>
</ul>
<?php endif; ?>
