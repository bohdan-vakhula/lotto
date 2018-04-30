<tr>
    <th align="center" valign="middle" class="hadding"><?php _e('Division', 'twentythirteen')?></th>

    <th align="center" valign="middle" class="hadding"><?php _e('Match', 'twentythirteen')?></th>

    <th align="center" valign="middle" class="hadding"><?php _e('Payout Per Winner', 'twentythirteen')?></th>
</tr>

<?php foreach ($this->data as $key => $value) : ?>
    <tr>
        <td align="center" valign="middle" height="30"><?php echo $value['Division']; ?></td>

        <td align="center" valign="middle"><?php echo $value['Match']; ?></td>

        <td align="center" valign="middle"><?php echo $value['LastDraw']; ?></td>
    </tr>
<?php endforeach; ?>