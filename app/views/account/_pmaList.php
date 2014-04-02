<?php
/* @var $data PaymeyAccount */
$pmaLink = $this->createUrl('/paymeyaccount/details', array('paymeyAccountId' => $data->id));
if ($data->status == PaymeyAccount::STATUS_BANK_APPROVED) {
    $statusClass = 'success';
} else {
    $statusClass = 'error';
}
?>
<tr>
    <td><a href="<?= $pmaLink; ?>"><?= $data->name; ?></a></td>
    <td><a href="<?= $pmaLink; ?>"><?= $data->id; ?></a></td>
    <td><?= $data->bankAccount->bank_name; ?>,<br><?= $data->bankAccount->iban; ?></td>
    <td><?= MoneyHelper::convert($data->balance); ?> <?= $data->currency->symbol; ?></td>
    <td><strong class="<?= $statusClass; ?>"><?= Yii::t('models', 'paymeyaccount.status.' . $data->status); ?></strong></td>
</tr>