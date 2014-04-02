<?php
/* @var $data Account */
$accountLink = $this->createUrl('/account/details', array('accountId' => $data->id));
?>

<tr>
    <td><span class="symbol group"><i></i></span></td>
    <td><a href="<?= $accountLink; ?>"><?= $data->id; ?></a></td>
    <td><a href="<?= $accountLink; ?>"><?= $data->getAccountOwnerName(); ?></a></td>
    <td><a href="<?= $accountLink; ?>" class="btn tableaction goto" title="Zum Kundenaccount"><i></i></a></td>
</tr>