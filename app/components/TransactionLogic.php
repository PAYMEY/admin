<?php

/**
 *
 */
class TransactionLogic extends CComponent
{
    /**
     * @var PaymeyAccount;
     */
    private $payerPaymeyAccount;

    /**
     * @var PaymeyAccount;
     */
    private $receiverPaymeyAccount;

    /**
     * @var Transaction;
     */
    private $transaction;


    /*
     *
     */
    public function completeTransaction($transactionId, $shortId)
    {
        // find transaction
        $transaction = Transaction::model()->with('payer')->findByAttributes(
            array(
                'id' => $transactionId,
                'short_id' => $shortId
            )
        );

        if ($transaction === null) {
            Yii::log(
                'Transaction not found. transactionId: ' . $transactionId,
                CLogger::LEVEL_ERROR,
                'TransactionLogic'
            );
            return $this->returnError('Transaction not found', 120017);
        }

        // check transaction status
        if ($transaction->status != Transaction::STATUS_PENDING) {
            Yii::log(
                'Transaction not pending. transactionId: ' . $transactionId,
                CLogger::LEVEL_ERROR,
                'TransactionLogic'
            );
            return $this->returnError('Transaction not pending', 120020);
        }

        // transactionDetail status
        $transactionDetail = TransactionDetail::model()->findByAttributes(
            array(
                'transaction_id' => $transaction->id,
                'transaction_type_id' => 5, // directDebit
            )
        );
        if ($transactionDetail == null) {
            Yii::log(
                'TransactionDetail not found. transactionId: ' . $transaction->id,
                CLogger::LEVEL_ERROR,
                'admin/TransactionController'
            );
            return $this->returnError('TransactionDetail not found', 120018);
        }

        // check transactionDetail status
        if ($transactionDetail->status != TransactionDetail::STATUS_PENDING) {
            Yii::log(
                'TransactionDetail not pending. transactionDetailId: ' . $transactionDetail->id,
                CLogger::LEVEL_ERROR,
                'TransactionLogic'
            );
            return $this->returnError('TransactionDetail not pending', 120021);
        }

        // database changes:
        $dbTransaction = Yii::app()->db->beginTransaction();
        try {
            // set transactionDetail status
            $transactionDetail->status = TransactionDetail::STATUS_DONE;
            if (!$transactionDetail->save()) {
                throw new Exception('TransactionDetail could not be saved. ' . print_r($transactionDetail->getErrors(), true));
            }
            // set transaction status
            $transaction->status = Transaction::STATUS_APPROVED;
            if (!$transaction->save()) {
                throw new Exception('Transaction could not be saved. ' . print_r($transaction->getErrors(), true));
            }
            // balance clearing
            if (!$transaction->payer->changeBalance($transactionDetail->amount, $transaction->id, $transactionDetail->id)) {
                throw new Exception('Balance change error', 120007);
            }
            // commit transaction
            $dbTransaction->commit();

        } catch (Exception $e) {
            $dbTransaction->rollBack();
            Yii::log($e->getMessage(), CLogger::LEVEL_ERROR, 'TransactionLogic');
            return $this->returnError('Error in completing a transaction', 120019);
        }

        // send mail
        // todo?

        // return array
        return array(
            'returnCode' => true,
            'amount' => MoneyHelper::convert($transactionDetail->amount) . ' ' . $transactionDetail->currency->symbol,
        );

    }


    /*
     *
     */
    private function returnError($message, $errorCode)
    {
        return array(
            'returnCode' => false,
            'errorMessage' => $message,
            'errorCode' => $errorCode,
        );
    }
}
