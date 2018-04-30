<?php
global $lotteries_results;
if (!empty($lotteries_results)):
?>
<div class="allresult_table">
    <table id="myTable" class="tablesorter" border="0" cellpadding="0" cellspacing="1">
        <thead>
        <tr>
            <th class="header"><?php _e('Country', 'twentythirteen') ?></th>
            <th class="header"><?php _e('Lottery', 'twentythirteen') ?></th>
            <th class="header"><?php _e('Last draw', 'twentythirteen') ?></th>
            <th class="header"><?php _e('Payout', 'twentythirteen') ?></th>
            <th style="background-image:none;"><?php _e('Winning Numbers', 'twentythirteen') ?></th>
        </tr>
        </thead>
        <tbody class="allresult">
            <?php
                foreach ($lotteries_results as $key => $value) {
					if(($value->LotteryTypeId == 27) || ($value->LotteryTypeId == 13) || ($value->LotteryTypeId == 24) ) continue; //hide fathersday, navidad, elnino
                    $LotteryNameChanged = strtolower(ChangeLotteryNameForUrl($value->LotteryName));
                    $flag = TEMPLATE_URL . '/images/flag_' . strtolower($value->CountryName) . '.png';
                    $resultlink = HOME_URL . '/' . strtolower($LotteryNameChanged) . '-results/';
                    $green = $blue = "";
                    if (isset($value->WinningResult) && $value->WinningResult != "") {
                        $temp = explode("#",
                            $value->WinningResult);
                        if (isset($temp[1]) && $temp[1] != "") {
                            $temp_1 = explode(",",
                                $temp[1]);
                            $green = (count($temp_1) > 1) ? '<li class="result_ellipse_green">' . implode('</li><li class="result_ellipse_green">',
                                    $temp_1) . "</li>" : '<li class="result_ellipse_green">' . $temp[1] . '</li>';
                        } else {
                            $green = "";
                        }

                        if ($value->BonusNumber > 0) {
                            $temp2 = explode(",",
                                $value->BonusNumber);
                            $green2 = '<li class="result_ellipse_green special">' . implode('</li><li class="result_ellipse_green special">',
                                    $temp2) . "</li>";
                        } else {
                            $green2 = "";
                        }

                        $temp1 = explode(",",
                            $temp[0]);
                        $blue = '<li class="result_ellipse_blue">' . implode('</li><li class="result_ellipse_blue">',
                                $temp1) . "</li>";
                    }

                    if ($green2 != "" || $green != "" || $blue != "") {
                        if ($value->RollOver == 0) {
                            $jackpot = 'RollOver';
                        } else {
                            $jackpot = $value->LotteryCurrency . '' . number_format($value->RollOver,
                                    0,
                                    "",
                                    ",");
                        }

                        if ($value->LotteryName === "Navidad") {
                            $response .= '';
                        } else {
                            $response .= '<tr>
                                                <td><img src="' . $flag . '" />&nbsp;&nbsp;' . convert_country_name($value->CountryName) . '</td>
                                                <td><a style="color:#0c2e61;" href="' . $resultlink . '">' . $value->LotteryName . '</a></td>
                                                <td>' . date("d/m/Y", changeDate($value->LotteryName, $value->DrawDate)) . '</td>
                                                <td> ' . $jackpot . '</td>
                                                <td>
                                                    <div class="result_number">
                                                        <ul>
                                                            ' . $blue . $green . $green2 . '
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>';
                        }
                    }
                }
                echo $response; ?>
        </tbody>
    </table>
</div>
<?php endif; ?>