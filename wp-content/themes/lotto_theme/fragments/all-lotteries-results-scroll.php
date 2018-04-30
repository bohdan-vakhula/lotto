<?php
global $lotteries_results;

$response = '<ul class="container" id="scroller">';
foreach ($lotteries_results as $key => $val) {
    $green2 = $green = $blue = '';
    if (isset($val->WinningResult) && $val->WinningResult != "") {
        $temp = explode("#", $val->WinningResult);
        if (isset($temp[1]) && $temp[1] != "") {
            $temp_1 = explode(",", $temp[1]);
            $green = (count($temp_1) > 1) ? '<li class="ellipse_green">' . implode('</li><li class="ellipse_green">', $temp_1) . "</li>" : '<li class="ellipse_green">' . $temp[1] . '</li>';
        } else {
            $green = "";
        }


        $lotteryname = strtolower(ChangeLotteryNameForUrl($val->LotteryName));


        $response .= '<li class="block">';


        $temp1 = explode(",", $temp[0]);
        $blue = '<li class="ellipse_blue">' . implode('</li><li class="ellipse_blue">', $temp1) . "</li>";

        if ($val->BonusNumber > 0) {
            $temp2 = explode(",", $val->BonusNumber);
            $green2 = '<li class="ellipse_green special">' . implode('</li><li class="ellipse_green special">', $temp2) . "</li>";
        } else {
            $green2="";
        }
        $thedate = date("d M", changeDate($val->LotteryName, strtotime($val->DrawDate)));
        $datenum = preg_replace('/[^0-9]/', '', $thedate);
        $dateletters = preg_replace('/[^a-zA-Z]/', '', $thedate);
        $response .= '<a href = "' . HOME_URL . '/' . $lotteryname . '-results/" class = "item">';
//                    $response .= '<li class="block">';

        $response .= '<div class="newres">';
        $response .= '<div class="datetxtres"><div class="datenum">'. $datenum . '</div><div class="dateletters">' . $dateletters . '</div></div>';
        $response .= '<div class="hadding">
                            <div class="name">' . $val->LotteryName . '</div>
                          </div>';
        $response .= '<div class="result"><ul>';
        $response .= $blue . $green . $green2;
        $response .= '</ul></div>';
        $response .='</a>';
        $response .='</a>';
        $response .='</li>';
        $response .='</div>';
    }
}
$response .= '</ul>';
?>

<script type="text/javascript">
    jQuery(".lotteryresultslist").html('').removeAttr('style');
    jQuery(".lotteryresultslist").html('<?php echo trim(preg_replace('/\s+/', ' ', $response)); ?>');
    jQuery(function() {
        jQuery("#scroller").simplyScroll({
            customClass: 'vert',
            orientation: 'vertical',
            auto: true,
            manualMode: 'loop',
            speed: 1,
            pauseOnTouch: true
        });
    });
</script>
