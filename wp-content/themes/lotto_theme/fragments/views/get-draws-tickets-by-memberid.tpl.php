<?php
$unique_num = 1;
foreach ($this->data as $key => $value) :
    $winning = ($value['Winning'] > 0) ? $value['Winning'] : "";

    $ticketType = "";
    if ($value['IsFree']) {
        $ticketType = __('Free Ticket', 'twentythirteen');
    } else {
        if ($value['IsSyndicate']) {
            $ticketType = __('Syndicate', 'twentythirteen');
        } else {
            if ($value['SingleLines'] != "") {
                $ticketType = __('Personal', 'twentythirteen');
            }
        }
    }

    $green2 = $green = $blue = "";
    if ($value['WinningResult'] != "") {
        $temp = explode("#", $value['WinningResult']);
        if ($temp[1] != "") {
            $temp_1 = explode(",", $temp[1]);
            $green = (count($temp_1) > 1) ? '<li class="result_ellipse_green">' . implode('</li><li class="result_ellipse_green">',
                    $temp_1) . "</li>" : '<li class="result_ellipse_green">' . $temp[1] . '</li>';
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
        if ($value['LotteryName'] === 'Navidad') {
            $blue = '<li style="color:#000;">' . implode('</li><li style="color:#000;">',
                    $temp1) . "</li>";
        } else {
            $blue = '<li class="result_ellipse_blue">' . implode('</li><li class="result_ellipse_blue">',
                    $temp1) . "</li>";
        }
    }

    if ($ticketType === "Personal") {
        $ticketType = "Personal";
        $singlearr = json_decode(json_encode($value['SingleLines']['SelectedNumbers']),
            1);

        $blue1 = $green1 = "";
        $tn = 1;
        foreach ($singlearr as $k2 => $v2) {
            $s1 = explode("#",
                $v2);
            if (isset($s1[1]) && $s1[1] != "") {
                $s3 = explode(",",
                    $s1[1]);
                $green1 = (count($s3) > 1) ? '<li class="result_ellipse_green">' . implode('</li><li class="result_ellipse_green">',
                        $s3) . "</li>" : '<li class="result_ellipse_green">' . $s1[1] . '</li>';
            } else {
                $green1 = "";
            }

            if ($value['BonusNumber'] > 0) {
                $temp3 = explode(",",
                    $value['BonusNumber']);
                $green3 = '<li class="result_ellipse_green special">' . implode('</li><li class="result_ellipse_green special">',
                        $temp3) . "</li>";
            } else {
                $green3 = '';
            }

            $s4 = explode(",",
                $s1[0]);

            if ($value['LotteryName'] === 'Navidad') {
                $blue1 = '<span>' . implode('</span><span>',
                        $s4) . "</span>";
            } else {
                $blue1 = '<li class="result_ellipse_blue">' . implode('</li><li class="result_ellipse_blue">',
                        $s4) . "</li>";
            }


            //$ticketType .= '<div class="draw_results"><ul>' . $blue1 . $green1 . $green3 . '</ul></div>';
//                        $tn++;
        }
    }

    $flagimg = get_template_directory_uri() . "/images/flag_" . strtolower($value['CountryName']) . ".png";

    // scanned images url
    $scanedimg = "Scanning";
    $unique_num = $value['Id'];
    if (isset($value['ScanImageUrls']) && count($value['ScanImageUrls']) > 0) {
        foreach ($value['ScanImageUrls'] as $i => $img) {
            if ($i == 0) {
                $scanedimg = '<a href="' . $img . '" data-lightbox="' . $unique_num . '"><img src="' . get_template_directory_uri() . '/images/ticket_scan.png" alt="No image"></a>';
            } else {
                $scanedimg .= '<a href="' . $img . '" data-lightbox="' . $unique_num . '"></a>';
            }
        }
    }

    $responsedata .= '<div class="drawer-header">
                                        <div class="table_style_1">
                                            <table cellspacing="1" cellpadding="0" border="0">
                                                <tbody>
                                                    <tr>
                                                        <td align="center" valign="middle" height="35"><img src="' . $flagimg . '"> ' . $value['CountryName'] . '</td>
                                                        <td align="center" valign="middle" class="green">' . $value['LotteryName'] . '</td>
                                                        <td align="center" valign="middle">' . date("m/d/Y", changeDate($value['LotteryName'], $value['DrawDate'])) . '</td>
                                                        <td align="center" valign="middle">' . $value['Status'] . '</td>
                                                        <td align="center" valign="middle">' . $winning . '</td>
                                                        <td align="center" valign="middle"><div class="drawer-header-icon"></div></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>';

    $responsedata .= '<div class="drawer-content" style="display: none;">
                                            <table cellspacing="0" cellpadding="0" border="0" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th height="25">' . __('My Ticket', 'twentythirteen') . '</th>
                                                        <th>' . __('Draw Results', 'twentythirteen') . '</th>
                                                        <th style="text-align:center;">' . __('Ticket Scan', 'twentythirteen') . '</th>
                                                        <th style="text-align:center; display: none;">' . __('Print', 'twentythirteen') . '</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td width="116">' . $ticketType . '</td>
                                                        <td width="352">
                                                            <div class="draw_results">
                                                                <ul>
                                                                   ' . $blue . $green . $green2 . '
                                                                </ul>
                                                            </div>
                                                        </td>
                                                        <td width="114" style="text-align:center;">' . $scanedimg . '</td>
                                                        <td width="10%" style="text-align:center; display: none;">-</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
									</div>';

    $response = $responsedata;
    $unique_num++;
    ?>

<?php endforeach; ?>
<?php echo $response; ?>
