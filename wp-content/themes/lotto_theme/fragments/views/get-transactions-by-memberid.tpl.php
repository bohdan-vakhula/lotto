<?php foreach ($this->data as $key => $val) : ?>
    <tr>
        <td height="35" align="center" valign="middle"><?php echo $val['TransactionType']; ?></td>
        <td align="center" valign="middle"><?php echo $val['TransactionId']; ?></td>
        <td align="center" valign="middle">
            <?php echo date('d/m/Y', strtotime($val['Date'])); ?>
            <br/>
            <?php echo date('H:i:s', strtotime($val['Date'])); ?>
        </td>
        <td align="center" valign="middle"><?php echo $val['Amount']; ?></td>
        <td align="center" valign="middle" style="color:#00a96f"><?php echo $val['Name']; ?></td>
        <td align="center" valign="middle"><?php echo $val['ProductName']; ?></td>
        <td align="center" valign="middle"><?php echo $val['Method']; ?></td>
    </tr>
<?php endforeach; ?>