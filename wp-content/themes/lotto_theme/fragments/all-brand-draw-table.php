<?php
global $all_brand_draws;
if (!empty($all_brand_draws)):
?>
<div class="allresult_table">
    <table id="myTable" class="tablesorter" border="0" cellpadding="0" cellspacing="1">
        <thead>
        <tr>
            <th class="header"><?php _e('Country', 'twentythirteen') ?></th>
            <th class="header"><?php _e('Lottery', 'twentythirteen') ?></th>
            <th class="header"><?php _e('Next draw', 'twentythirteen') ?></th>
            <th class="header" style="width: 30%;"><?php _e('Jackpot', 'twentythirteen') ?></th>
        </tr>
        </thead>
        <tbody class="allbrands">
        <?php foreach ($all_brand_draws as $key => $value) :
            $flag =TEMPLATE_URL . '/images/flag_' . strtolower($value->CountryName) . '.png';
            $link = HOME_URL . '/' . strtolower(ChangeLotteryNameForUrl($value->LotteryName) . '-lottery/');

            if ($value->Jackpot < 0) {
                $jackpot = 'PENDING';
            } else {
                $jackpot = $value->LotteryCurrency2 . ' ' . number_format($value->Jackpot, 0, "", ",");
            }
        ?>
            <tr>
                <td><img src="<?php echo $flag; ?>"/>&nbsp;<?php echo convert_country_name($value->CountryName); ?></td>
                <td><?php echo $value->LotteryName; ?></td>
                <td><?php echo date('d/m/Y', changeDate($value->LotteryName, $value->DrawDate)); ?></td>
                <td>
                    <?php echo $jackpot; ?>&nbsp;&nbsp;&nbsp;<a href="<?php echo $link; ?>" class="dd_play_button" style="float:right;"> <?php _e('Play Now', 'twentythirteen') ?></a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php endif; ?>