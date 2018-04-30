<?php

$responsedata = "";

foreach ($this->data as $key => $value) {
    $imgsrc = $lotteryname = $grpshare = "";
    if (isset($value['Lotteries']) && count($value['Lotteries']) > 0) {
        $draws_left = explode("/", $value['DrawsLeft']);
        $lines_left = explode("/", $value['LinesLeft']);
        $DrawsLeft = '<span class="draw_left">'.$draws_left[0].'</span>/<span class="draw_right">'.$draws_left[1].'</span>';
        $LinesLeft = '<span class="line_left">'.$lines_left[0].'</span>/<span class="line_right">'.$lines_left[1].'</span>';

        $imgsrc = TEMPLATE_URL . '/images/logos/' . strtolower($value['Lotteries'][0]['LotteryName']) . '1.png';
        $lotteryname = $value['Lotteries'][0]['LotteryName'];

        if ($value['SyndicateShares'] > 0) {
            $grpshare = '<table cellspacing="0" cellpadding="0" border="0" align="center" width="100%">
                                    <tbody><tr>
                                            <td align="center" valign="middle">
                                                <table cellspacing="0" cellpadding="0" border="0" align="center" width="40%">
                                                    <tbody><tr>
                                                            <td align="center" width="150" valign="middle" class="font16_blk">' . $value['Lotteries'][0]['CountSyndicate'] . ' ' .__('Share', 'twentythirteen').'</td>
                                                            <td align="center" width="50" valign="middle"><img src="' . TEMPLATE_URL . '/images/accolade-left.png"></td>
                                                            <td align="center" width="150" valign="middle"><img src="' . TEMPLATE_URL . '/images/winner.png"></td>
                                                            <td align="center" width="50" valign="middle"><img src="' . TEMPLATE_URL . '/images/accolade-right.png"></td>
                                                            <td align="center" width="150" valign="middle" class="font16_blk">' . $value['Lotteries'][0]['NumberOfDraws'] . ' ' .__('Draw', 'twentythirteen').'</td>
                                                        </tr>
                                                    </tbody></table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>';
        } else {
            $num = "";
            $draws = "";
            foreach ($value['Lotteries'] as $k1 => $v1) {
                $blue = '<div class="draw_results"><ul>';
                $temp = explode("#", $v1['SelectedNumbers']);
                if (isset($temp[1]) && $temp[1] != "") {
                    $temp_1 = explode(",", $temp[1]);
                    $green = (count($temp_1) > 1) ? '<li class="result_ellipse_green">' . implode('</li><li class="result_ellipse_green">',
                            $temp_1) . "</li>" : '<li class="result_ellipse_green">' . $temp[1] . '</li>';
                } else {
                    $green = "";
                }

                if ($value['BonusNumber'] > 0) {
                    $temp2 = explode(",", $value['BonusNumber']);
                    $green2 = '<li class="result_ellipse_green special">' . implode('</li><li class="result_ellipse_green special">',
                            $temp2) . "</li>";
                } else {
                    $green2 = "";
                }

                $temp1 = explode(",", $temp[0]);
                if ($value['Product'] === 'Navidad') {
                    $blue .= '<span>' . implode('</span><span>',
                        $temp1) . "</span>";
                } else {
                    $blue .= '<li class="result_ellipse_blue">' . implode('</li><li class="result_ellipse_blue">',
                        $temp1) . "</li>";
                }

                $num .= $blue . $green . $green2 . '</ul></div>';

                $draws = $v1['NumberOfDraws'];
            }




            $grpshare .= '<table width="100%" border="0" align="center" cellspacing="0" cellpadding="0">
                                <tbody><tr>
                                  <td valign="middle" align="center">
                                      <table width="45%" border="0" align="center" cellspacing="0" cellpadding="0">
                                        <tbody><tr>
                                          <td valign="middle" align="right">
                                             ' . $num . '
                                          </td>
                                          <td valign="middle" align="center"><img src="' . TEMPLATE_URL . '/images/accolade-right.png"></td>
                                          <td valign="middle" align="left" class="font16_blk">' . $draws . ' ' .__('Draw', 'twentythirteen').'</td>
                                        </tr>
                                      </tbody></table>
                                  </td>
                                </tr>
                              </tbody>
                          </table>';
        }
    }
    if ($value['Product'] === 'Navidad') {
        $responsedata .= '<div class="drawer-item_row">
                    <div class="drawer-header">
                        <div class="table_style_1">
                            <table cellspacing="1" cellpadding="0" border="0">
                                <tbody>
                                    <tr>
                                        <td align="center" valign="middle" height="35">' . $value['Product'] . '</td>
                                        <td align="center" valign="middle" class="green">' . $value['MainLottery'] . '</td>
                                        <td align="center" valign="middle">' . $value['SyndicateShares'] . '</td>
                                        <td align="center" valign="middle">' . $DrawsLeft . '</td>
                                        <td align="center" valign="middle">' . $value['TotalLines'] . '</td>
                                        <td align="center" valign="middle">' . date("d M Y",
                strtotime($value['PurchasedOn'])) . '</td>
                                        <td align="center" valign="middle">' . date("d M Y",
                strtotime($value['EndDate'])) . '</td>
                                        <td align="center" valign="middle"><span class="'.lcfirst($value['Status']).'_btn">' . $value['Status'] . '<i class="ico-inactive"></i></span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="drawer-content" style="display: none;">
                        <div class="prod_popup_main">
                            <div class="prod_popup_part1">
                                <div class="prod_popup_part1_left"><img src="' . $imgsrc . '" alt="" width="70" height="70"></div>
                                <div class="prod_popup_part1_right">
                                   ' . $lotteryname . '
                                </div>
                            </div>
                            <div class="prod_popup_part2">
                                ' . $grpshare . '
                            </div>
                        </div>

                        <div class="drawer_message font16_blk">Lines left: ' . $LinesLeft . '</div>
                    </div>
                </div>';
    } elseif ($value['Product'] === "24/7 VIP") {
        $responsedata .= '<div class="drawer-item_row">
                    <div class="drawer-header">
                        <div class="table_style_1">
                            <table cellspacing="1" cellpadding="0" border="0">
                                <tbody>
                                    <tr>
                                        <td align="center" valign="middle" height="35">' . $value['Product'] . '</td>
                                        <td align="center" valign="middle" class="green">' . $value['MainLottery'] . '</td>
                                        <td align="center" valign="middle">' . $value['SyndicateShares'] . '</td>
                                        <td align="center" valign="middle">' . $DrawsLeft . '</td>
                                        <td align="center" valign="middle">' . $value['TotalLines'] . '</td>
                                        <td align="center" valign="middle">' . date("d M Y",
                strtotime($value['PurchasedOn'])) . '</td>
                                        <td align="center" valign="middle">' . date("d M Y",
                strtotime($value['EndDate'])) . '</td>
                                        <td align="center" valign="middle"><span class="'.lcfirst($value['Status']).'_btn">' . $value['Status'] . '<i class="ico-inactive"></i></span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
					<div class="drawer-content" style="display: none;">

					';

        foreach ($value['Lotteries'] as $k1 => $v1) {
            $imgsrc24 = TEMPLATE_URL . '/images/' . strtolower($v1['LotteryName']) . '.png';
            $imgsrc24group = TEMPLATE_URL . '/images/group/' . strtolower($v1['LotteryName']) . 'group.jpg';

            $responsedata .= '<div style="text-align:center;width:94px;height:140px;padding-top:10px;border:1px solid #ccc;float:left;"><img src="' . $imgsrc24 . '" alt="" width="40" height="40"><br />' . $v1['LotteryName'] . '<br /> ' .__('Draws:', 'twentythirteen').' ' . $v1['NumberOfDraws'] . '<br />' .__('Shares:', 'twentythirteen').' ' . $v1['CountSyndicate'] . '


					<br />
					<div>
					<style media="screen" type="text/css">
					.hover_img a:hover span { display:block !important; }
					</style>
					<div class="hover_img">
     <a class="buy_button" style="position:relative;font-size:10px;font-weight:bold;color:#000;" href="#">' .__('See Numbers', 'twentythirteen').'<span style="margin-top:-400px;position:absolute; display:none; z-index:99;"><img src="' . $imgsrc24group . '" alt="image" /></span></a>
</div>

</div></div>';
        }

        $responsedata .= '<div class="drawer_message font16_blk">Lines left: ' . $LinesLeft . '</div></div></div>';
    } else {
        if ($value['Product'] == 'Group') {
            $txt = $lotteryname.' Group: 50 lines shared by 150 group members of strategically chosen numbers by our lottery experts. We made sure the group will have a win on each and every draw which will be divided by the group members according to their share holdings.';
        } else {
            $txt = $lotteryname;
        }

        $responsedata .= '<div class="drawer-item_row">
                    <div class="drawer-header">
                        <div class="table_style_1">
                            <table cellspacing="1" cellpadding="0" border="0">
                                <tbody>
                                    <tr>
                                        <td align="center" valign="middle" height="35">' . $value['Product'] . '</td>
                                        <td align="center" valign="middle" class="green">' . $value['MainLottery'] . '</td>
                                        <td align="center" valign="middle">' . $value['SyndicateShares'] . '</td>
                                        <td align="center" valign="middle">' . $DrawsLeft . '</td>
                                        <td align="center" valign="middle">' . $value['TotalLines'] . '</td>
                                        <td align="center" valign="middle">' . date("d M Y",
                strtotime($value['PurchasedOn'])) . '</td>
                                        <td align="center" valign="middle">' . date("d M Y",
                strtotime($value['EndDate'])) . '</td>
                                        <td align="center" valign="middle"><span class="'.lcfirst($value['Status']).'_btn">' . $value['Status'] . '<i class="ico-inactive"></i></span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="drawer-content" style="display: none;">
                        <div class="prod_popup_main">
                            <div class="prod_popup_part1">
                                <div class="prod_popup_part1_left"><img src="' . $imgsrc . '" alt="" width="70" height="70"></div>
                                <div class="prod_popup_part1_right prod_popup_part1_'.lcfirst($value['Product']).'">
                                  '.$txt.'
                                </div>
                            </div>

                            <div class="prod_popup_part2">
                                ' . $grpshare . '
                            </div>
                            <div class="cl"></div>
                        </div>
                        <div class="drawer_message font16_blk">Lines left: ' . $LinesLeft . '</div>
                    </div>
                </div>';
    }
}

echo $responsedata;
