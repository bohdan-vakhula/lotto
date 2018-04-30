<?php
    global $lotteries_results;

?>

<?php 
    /*
    if (!empty($lotteries_results)):
    ?>
    <div class="nav_dropdown result_info">
    <ul>
    <?php
    $lotteries = array_slice($lotteries_results, 0, 5, true);
    foreach ($lotteries as $key => $val) :
    $lotteryname = strtolower($val->LotteryName);
    $drawdate    = explode('T', $val->DrawDate);
    $flag        = TEMPLATE_URL . '/images/flag_' . strtolower($val->CountryName) . '.png';
    $linkInfo    = HOME_URL . '/' . $lotteryname . "-info/";
    $lotteryname = strtolower(ChangeLotteryNameForUrl($val->LotteryName));
    $linkResults = HOME_URL . "/" . $lotteryname . "-results/"; ?>
    <li>
    <div class="dd_col1">
    <img src="<?php echo $flag; ?>" alt="flag"/>
    &nbsp;&nbsp;<?php echo convert_country_name($val->CountryName); ?>
    </div>
    <div class="dd_col2"><?php echo $val->LotteryName; ?></div>
    <div class="dd_col3"><?php echo date('Y-m-d', changeDate($val->LotteryName, $drawdate[0] . ' ' . $drawdate[1])); ?> | <a href="<?php echo $linkResults; ?>" class="link13"> <?php _e('Results', 'twentythirteen')?> </a></div>
    <div class="dd_col4"><a href="<?php echo $linkInfo; ?>" class="link13"><?php _e('Info', 'twentythirteen')?></a></div>
    </li>
    <?php endforeach; ?>
    </ul>
    <div class="clear"></div>
    <a href="<?php echo HOME_URL; ?>/lottery-results/" class="link13 left"><?php _e('View All Results', 'twentythirteen'); ?></a>
    <a href="<?php echo HOME_URL; ?>/lotto/" class="link13 right"><?php _e('View all info', 'twentythirteen'); ?></a>
    </div>
<?php endif; */ ?>

<?php if (!empty($lotteries_results)): ?>

    <div class="result_info">

        <div id="navbar-item-result" class="dropdown-menu hidden-xs">

            <p class="latest-results">Latest Results</p>

            <div class="results-info-box-content" style="min-height: 250px;">
                <div class="results-info-box-content-result" style="display: block;">

                    <ul class="menu-result-container">
                        <?php
                            $lotteries = array_slice($lotteries_results, 0, 5, true);

                            foreach ($lotteries as $key => $val) :
                                $lotteryname = strtolower($val->LotteryName);
                                $drawdate    = explode('T', $val->DrawDate);
                                $flag        = TEMPLATE_URL . '/images/flag_' . strtolower($val->CountryName) . '.png';
                                $linkInfo    = HOME_URL . '/' . $lotteryname . "-info/";
                                $lotteryname = strtolower(ChangeLotteryNameForUrl($val->LotteryName));
                                $linkResults = HOME_URL . "/" . $lotteryname . "-results/";
                                $imgsrcll = '/images/logos/' . $lotteryname . '1.png';
                                $lotterynameLink = strtolower(ChangeLotteryNameForUrl($val->LotteryName));
                                $linkplay        = HOME_URL . '/' . $lotterynameLink . '-lottery/';

                                $green = $blue = "";
                                if (isset($val->WinningResult) && $val->WinningResult != "") {
                                    $temp = explode("#",$val->WinningResult);
                                    if (isset($temp[1]) && $temp[1] != "") {
                                        $temp_1 = explode(",",$temp[1]);
                                        $green = (count($temp_1) > 1) ? '<div class="draw-number draw-number-type-2">' . implode('</div><div class="draw-number draw-number-type-2">',
                                        $temp_1) . "</div>" : '<div class="draw-number draw-number-type-2">' . $temp[1] . '</div>';
                                    } else {
                                        $green = "";
                                    }

                                    if ($val->BonusNumber > 0) {
                                        $temp2 = explode(",",$val->BonusNumber);
                                        $green2 = '<div class="draw-number draw-number-type-2">' . implode('</div><div class="draw-number draw-number-type-2">',
                                        $temp2) . "</div>";
                                    } else {
                                        $green2 = "";
                                    }

                                    $temp1 = explode(",",
                                    $temp[0]);
                                    $blue = '<div class="draw-number draw-number-type-1">' . implode('</div><div class="draw-number draw-number-type-1">',
                                    $temp1) . "</div>";
                                }

                            ?>

                            <li class="res-menu-item">

                                <div class="menu-info-line info-line-logo">
                                    <img src="<?php echo TEMPLATE_URL . $imgsrcll;?>" alt="<?php echo $val->LotteryName; ?>" title="<?php echo $val->LotteryName; ?>">
                                </div>

                                <div class="menu-info-line info-line-brand">
                                    <div class="info-brand-name"><?php echo $val->LotteryName; ?></div>
                                    <div class="info-brand-timer"><?php echo date("D d M", changeDate($val->LotteryName, $val->DrawDate)); ?></div>
                                </div>

                                <div class="menu-info-line info-line-numbers">
                                    <?php

                                        if ($val->LotteryName === "Navidad") {

                                            echo '<div class="draw-number draw-number-type-1">Navidad Lotery Have No Result</div>';

                                        }else{

                                            echo $blue . $green . $green2;   
                                        }


                                    ?>
                                </div>

                                <div class="menu-info-line info-line-text">
                                    <a href="<?php echo $linkResults; ?>">More Results</a>
                                </div>

                                <div class="menu-info-line info-line-command">

                                    <a href="<?php echo $linkplay; ?>" class="play-now-btn">PLAY</a>

                                </div>

                            </li>

                            <?php endforeach; ?>

                    </ul>
                </div>
            </div>

            <div class="results-info-box results-footer">
                <div class="panel">
                    <div class="panel-footer">
                        <div class="subscribe">
                            <a href="<?php echo HOME_URL; ?>/lottery-results/" title="" class="subscribe-txt">Click HERE for Lottery Results and Winning Numbers</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php endif; ?>