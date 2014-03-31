<?php
/**
 * The followings are the available columns in table 'fees':
 * @property string $id
 * @property string $fee_group_id
 * @property string $region_id
 * @property string $type_id
 * @property string $currency_id
 * @property string $from
 * @property string $to
 * @property string $percent
 * @property string $amount
 * @property integer $is_deleted
 * @property string $created
 * @property string $created_by
 * @property string $modified
 * @property string $modified_by
 */
class TransactionTest extends CDbTestCase
{
    public $fixtures=array(
        'transactions' => 'Transaction',
        'transactions_details' => 'TransactionDetail',
        'balance_histories' => 'BalanceHistory',
        'accounts' => 'Account',
        'paymey_accounts' => 'PaymeyAccount',
        'address' => 'Address',
        'users' => 'User',
        'bank_accounts' => 'BankAccount',
        'businesses' => 'Business',
    );

    /**
     *
     */
    public function testTransactionLogic()
    {
        /*
        $payerPaymeyAccountId = 179848;
        $payerUserId = 127352;
        $receiverPaymeyAccountId = 179846;
        $receiverUserId = 127350;
        $currencyId = 1;
        $amount = 100000;

        $receiverPaymeyAccount = PaymeyAccount::model()->with('account')->findByPk($receiverPaymeyAccountId);
        $this->assertTrue($receiverPaymeyAccount instanceof PaymeyAccount, 'PaymeyAccount nicht geladen @ testTransactionLogic()');

        $freeTransBefore = $receiverPaymeyAccount->account->free_transactions;

        $channelId = Channel::getDefaultId();
        $transactionTypeId = TransactionType::getDefaultId();
        $transactionLogic = new TransactionLogic();
        $return = $transactionLogic->createTransaction($payerPaymeyAccountId, $payerUserId, $receiverPaymeyAccountId, $receiverUserId, $currencyId, $channelId, $transactionTypeId, $amount);
        $this->assertEquals(1, $return['returnCode'], 'TransactionLogic failure @ testTransactionLogic()');

        $receiverPaymeyAccount->refresh();

        $payerPaymeyAccount = PaymeyAccount::model()->findByPk($payerPaymeyAccountId);
        $this->assertTrue($payerPaymeyAccount instanceof PaymeyAccount, 'PaymeyAccount nicht geladen @ testTransactionLogic()');

        $this->assertEquals(-100000, $payerPaymeyAccount->balance);

        if ($freeTransBefore > 0) {
            $this->assertEquals(100000, $receiverPaymeyAccount->balance);
            $this->assertEquals($freeTransBefore-1, $receiverPaymeyAccount->account->free_transactions);
        } else {
            $this->assertEquals(95000, $receiverPaymeyAccount->balance);
        }

        */
    }

}
