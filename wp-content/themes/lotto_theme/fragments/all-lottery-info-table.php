<?php
global $all_brand_draws;
if (!empty($all_brand_draws)):
?>
<div class="allresult_table">
    <table id="myTable" class="tablesorter tablesorterinfo" border="0" cellpadding="0" cellspacing="1" style="text-align: center;">
        <thead>
            <tr>
                <th class="header"><?php _e('Country', 'twentythirteen') ?></th>
                <th class="header"><?php _e('Lottery Name', 'twentythirteen') ?></th>
                <th class="header"><?php _e('Winning Odds', 'twentythirteen') ?></th>
                <th class="header"><?php _e('Next jackpots', 'twentythirteen') ?></th>
                <th class="header"><?php _e('Guess Range', 'twentythirteen') ?></th>
                <th class="header"><?php _e('More info', 'twentythirteen') ?></th>
            </tr>
        </thead>
        <tbody class="infocontent">
            <?php foreach ($all_brand_draws as $key => $value) :
                $winningOdds = array(
                    'PowerBall'     => '1:24.9',
                    'MegaMillions'  => '1:14.7',
                    'EuroMillions'  => '1:13',
                    'EuroJackpot'   => '1:12',
                    'Lotto649'      => '1:6.6',
                    'SuperEnalotto' => '1:318',
                    'LaPrimitiva'   => '1:10',
                    'ElGordo'       => '1:10',
                    'BonoLoto'      => '1:10',
                    'UkLotto'       => '1:9.3',
                    'NewYorkLotto'  => '1:46',
					'OzLotto' 	    => '1:87',
                );

                $flag = TEMPLATE_URL . "/images/flag_" . strtolower($value->CountryName) . ".png";

                $extra      = ($value->NumberOfExtraNumbers > 0) ? $value->AmountOfExtraNumbersToMatch . "/" . $value->NumberOfExtraNumbers : "";
                $main       = $value->AmountOfMainNumbersToMatch . "/" . $value->NumberOfMainNumbers;
                $extra1     = ($extra != "") ? " + " . $extra : "";
                $guessRange = $main . $extra1;
                $moreInfo   = HOME_URL . "/" . strtolower($value->LotteryName) . "-info/";

                if ($value->Jackpot < 0) {
                    $jackpot = 'PENDING';
                } else {
                    $jackpot = $value->LotteryCurrency2 . ' ' . number_format($value->Jackpot, 0, "", ",");
                }
            ?>
                <tr>
                    <td class="text-left"><img src="<?php echo $flag; ?>"/>&nbsp;&nbsp;<?php echo convert_country_name($value->CountryName); ?></td>
                    <td><?php echo $value->LotteryName; ?></td>
                    <td><?php echo $winningOdds[$value->LotteryName]; ?></td>
                    <td><?php echo $jackpot; ?></td>
                    <td><?php echo $guessRange; ?></td>
                    <td><a href="<?php echo $moreInfo; ?>" class="dd_play_button"><?php _e('More info', 'twentythirteen')?></a></td>
                </tr>
            <?php endforeach; ?>

        </tbody>
    </table>
</div>
<?php endif; ?>
