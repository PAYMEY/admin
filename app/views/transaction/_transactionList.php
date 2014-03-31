<?php
/* @var $data Transaction */
?>
<tr>
    <td>
        <?php
        switch ($data->status) {
            case Transaction::STATUS_APPROVED:
        ?>
                <span class="btn tableaction tickoff status0"><i></i></span>
        <?php
                break;
            case Transaction::STATUS_PENDING:
        ?>
                <span class="btn tableaction tickoff status1"><i></i>
                    <div class="dialog" id="transactionDialog">
                        <div class="row">
                            <div class="col16"><span class="btn tableaction tickoff status1 float-left"><i></i></span></div>
                            <div class="col80">
                                <h4>Transaktion abschließen?</h4>

                                <?php
                                $form = $this->beginWidget(
                                    'CActiveForm',
                                    array('action' => $this->createUrl('/transaction/completeTransaction'))
                                );
                                echo $form->hiddenField($data, 'id');
                                echo $form->hiddenField($data, 'short_id');
                                ?>
                                Geldeingang best&auml;tigen
                                <button type="submit" class="btn large marg-t">Ok</button>
                                <?php $this->endWidget(); ?>
                            </div>
                        </div>
                    </div>
                </span>
        <?php
                break;
            default:
        ?>
                <span class="btn tableaction tickoff status3"><i></i></span>
        <?php
                break;
        }
        ?>
    </td>
    <td><?= $data->id; ?></td>
    <td>
        <?php
        switch ($data->type) {
            case Transaction::TYPE_PAYMENT:
                echo 'Zahlung<br />';
                break;
            case Transaction::TYPE_DEPOSIT:
                echo 'Einzahlung<br />';
                break;
            case Transaction::TYPE_PAYOUT:
                echo 'Auszahlung<br />';
                break;
        }
        ?>
        <?php
        if ($data->short_id > 0) {
            echo $data->short_id;
        } else {
            echo 'aus Guthaben';
        }
        ?>
    </td>
    <td><?= date('j.m.Y G:i', $data->created); ?></td>
    <td><a href="#"><?= $data->payer->stat_name; ?></a></td>
    <td><a href="#"><?= $data->receiver->stat_name; ?></a></td>
    <td><?= MoneyHelper::convert($data->amount); ?> <?= $data->currency->symbol; ?></td>
    <td><?= MoneyHelper::convert($data->transactionDetails[0]->amount); ?> <?= $data->currency->symbol; ?></td>
    <td><a href="#" class="btn tableaction goto" title="Zu den Transaktionsdetails"><i></i></a></td>
</tr>
