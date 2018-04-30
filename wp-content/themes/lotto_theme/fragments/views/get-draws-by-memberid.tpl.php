<?php foreach ($this->data as $key => $val) : ?>
    <tr>
        <td height="35" align="center" valign="middle"></td>
        <td align="center" valign="middle" class="green"><?php echo $val->LotteryName; ?></td>
        <td align="center" valign="middle"><?php echo $val->DrawDate; ?></td>
        <td align="center" valign="middle"></td>
        <td align="center" valign="middle"><?php echo $val->WinningResult; ?></td>
        <td align="center" valign="middle">
            <a href="#"><img src="<?php echo TEMPLATE_URL ?> /images/next_arrow.png"/></a>
        </td>
    </tr>
<?php endforeach; ?>