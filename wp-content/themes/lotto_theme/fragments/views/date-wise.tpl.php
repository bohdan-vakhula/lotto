<?php $lotteryName = $this->data[0]['LotteryName']; ?>
<div class="l-results-header">
<h4><?php echo $lotteryName; ?> <?php _e('Results & Winning Numbers','twentythirteen') ?></h4>
<div class="winning_number_dropdown">
    <div class="dropdown2">
        <select class="datewiseresult" name="">
            <?php foreach ($this->data as $key => $value) : ?>
                <option value="<?php echo $key; ?>" data-id="<?php echo $value['DrawId']; ?>" data-date="<?php echo date("l d M Y", changeDate($value['LotteryName'], $value['DrawDate'])); ?>"><?php echo date("d/m/Y", changeDate($value['LotteryName'], $value['DrawDate'])); ?></option>
            <?php endforeach; ?>
        </select>
    </div>
</div>
</div>

<div class="winning_number_count">
<div class="clear_inner displaydate"><span><?php echo $lotteryName; ?> Results for <span id="replace-date"> &nbsp; </span></span></div>
<ul>
<?php
foreach ($this->data as $key => $value) {
    $class = "hide";
    if ($key == 0) {
        $class = "";
    }

    if (isset($value['WinningResult']) && $value['WinningResult'] != "") {
        $temp = explode("#",
            $value['WinningResult']);
        if (isset($temp[1]) && $temp[1] != "") {
            $temp_1 = explode(",",
                $temp[1]);
            $green = (count($temp_1) > 1) ? '<li class="ellipse_green ' . $class . " " . $key . '" >' . implode('</li><li class="ellipse_green ' . $class . " " . $key . '">',
                    $temp_1) . "</li>" : '<li class="ellipse_green ' . $class . " " . $key . '">' . $temp[1] . '</li>';
        } else {
            $green = "";
        }

        if ($value['BonusNumber'] > 0) {
            $temp2 = explode(",",
                $value['BonusNumber']);
            $green2 = '<li class="ellipse_green special ' . $class . " " . $key . '">' . implode('</li><li class="ellipse_green special ' . $class . " " . $key . '">',
                    $temp2) . "</li>";
        } else {
            $green2 = "";
        }

        $temp1 = explode(",",
            $temp[0]);
        $blue = '<li class="ellipse_blue ' . $class . " " . $key . '">' . implode('</li><li class="ellipse_blue ' . $class . " " . $key . '">',
                $temp1) . "</li>";

        $response .= $blue . $green . $green2;
    }
}
$response .= '</ul></div>';

echo $response;
