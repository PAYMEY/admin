<?php
/* @var $data User */
$userLink = $this->createUrl('/user/details', array('userId' => $data->id, 'accountId' => $data->account_id));
if ($data->status == User::STATUS_APPROVED) {
    $statusClass = 'success';
} else {
    $statusClass = 'error';
}
if ($data->id == $data->account->owner_id) {
    $linkClass = 'strong';
} else {
    $linkClass = '';
}
?>
<tr>
    <td><?= $active1; ?><a href="<?= $userLink; ?>" class="<?= $linkClass; ?>"><?= $data->firstname . ' ' . $data->lastname ?> (Besitzer)</a><?= $active2; ?></td>
    <td><a href="mailto:<?= $data->email; ?>"><?= $data->email; ?></a></td>
    <td><strong class="<?= $statusClass; ?>"><?= Yii::t('models', 'user.status.' . $data->status); ?></strong></td>
</tr>