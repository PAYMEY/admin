<tr>
    <td><span class="symbol pmaccount"><i></i></span></td>
    <td><?= $data->id; ?></td>
    <td><a href="#"><?= $data->name; ?></a></td>
    <td><a href="#"><?= $data->account->getAccountOwnerName(); ?></a></td>
    <td><a href="#" class="btn tableaction goto" title="Zu den Nutzerdetails"><i></i></a></td>
</tr>