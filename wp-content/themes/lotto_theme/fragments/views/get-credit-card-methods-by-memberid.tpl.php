<?php foreach ($this->data as $key => $val) :
    $status = ($val['IsActive'] == 1) ? __('Active', 'twentythirteen') : __('Inactive', 'twentythirteen');
    $ccnum = ($val['CreditCardNumber']);
    //$cctype = ($val['CardType']);
?>
    <tr>
        <td height="35" align="center" valign="middle"><?php echo $cctype . ' ' . $ccnum; ?></td>
        <td align="center" valign="middle"><?php echo $status;?></td>
        <?php if ($val['IsDefault'] == 1) : ?>
            <td align="center" valign="middle"><a><img src="<?php echo TEMPLATE_URL ?>/images/checkbox.png" /></a></td>
            <td align="center" valign="middle"></td>
            <td align="center" valign="middle"></td>
        <?php else: ?>
            <td align="center" valign="middle"></td>
            <td align="center" valign="middle">
                <a onclick="editMethod(<?php echo $val['Id']; ?>)" >
                    <img  class="my_transactions_update" src="<?php echo TEMPLATE_URL ?>/images/edit.png" />
                </a>
            </td>
            <td align="center" valign="middle">
                <a onclick="deleteMethod(<?php echo $val['Id']; ?>)">
                    <img src="<?php echo TEMPLATE_URL ?>/images/delete_red.png" />
                </a>
            </td>
        <?php endif; ?>
    </tr>
<?php endforeach; ?>