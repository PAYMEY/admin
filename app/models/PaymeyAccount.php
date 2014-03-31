<?php

/**
 * This is the model class for table "paymey_accounts".
 *
 * The followings are the available columns in table 'paymey_accounts':
 * @property string $id
 * @property string $account_id
 * @property string $name
 * @property string $stat_name
 * @property string $stat_name_ext
 * @property integer $balance
 * @property string $currency_id
 * @property integer $status
 * @property integer $activation_attempts
 * @property integer $is_deleted
 * @property string $created
 * @property string $created_by
 * @property string $modified
 * @property string $modified_by
 */
class PaymeyAccount extends CActiveRecordExtended
{
    const STATUS_ERROR = -1;
    const STATUS_PENDING = 0;   // after create
    const STATUS_ACCOUNT_APPROVED = 1;  // after user activation in signupController -> same as STATUS_USER_APPROVED in account
    const STATUS_BANK_APPROVED = 2; // after successfull microdeposit

    private $availableBalance = false;

    /*
     *
     */
    public function refresh()
    {
        $this->availableBalance = false;
        return parent::refresh();
    }

    /*
     * return true, if there are unverified paymey accounts
     */
    public static function existsUnverifiedBankAccounts($accountId)
    {
        $paymeyAccounts = self::model()->findAllByAccountId($accountId);
        if ($paymeyAccounts == null) {
            return false;
        }
        foreach ($paymeyAccounts as $paymeyAccount) {
            if ($paymeyAccount->status != self::STATUS_BANK_APPROVED) {
                return true;
            }
        }
        return false;
    }

    /*
     *
     */
    public function findAllByAccountId($accountId)
    {
        return $this->findAllByAttributes(array('account_id' => $accountId));
    }

    /*
     * convert balance
     */
    public function getBalanceInDisplayFormat()
    {
        // convert balance to display format
        return MoneyHelper::convert($this->balance);
    }

    /*
     * return the actual available balance
     */
    public function getAvailableBalance()
    {
        if (!$this->availableBalance) {
            // calculate available balance

            // get all balance actions younger than 30 days
            $criteria = new CDbCriteria(
                array(
                    'condition' => 't.paymey_account_id=' . $this->id,
                    //'order' => 't.modified DESC',
                )
            );
            $checkTime = time() - 2592000;  // 2592000 -> 30 Days
            $criteria->addCondition('t.created > ' . $checkTime);
            $balanceActions = BalanceHistory::model()->with('transaction')->findAll($criteria);

            $sum30days = 0;
            foreach ($balanceActions as $balanceAction) {
                // only count receiving
                if ($balanceAction->transaction->receiver_id == $this->id && $balanceAction->transaction->type == Transaction::TYPE_PAYMENT) {
                    // sum amount - fee
                    $sum30days += ($balanceAction->transaction->amount- $balanceAction->transaction->fee);
                }
            }
            // available = balance - 30% sum30days
            $this->availableBalance = $this->balance - (0.3 * $sum30days);

            if ($this->availableBalance < 0) {
                $this->availableBalance = 0;
            }

        }
        return $this->availableBalance;
    }

    /*
     * return the actual available balance in display format
     */
    public function getAvailableBalanceInDisplayFormat()
    {
        // convert available balance to display format
        return MoneyHelper::convert($this->getAvailableBalance());
    }

    /*
     *
     */
    public function changeBalance($amount, $transactionId, $transactionDetailId)
    {
        // start transaction
        $dbTransaction = Yii::app()->db->beginTransaction();
        try {
            // refresh model
            $this->refresh();
            // change balance
            $this->balance += $amount;
            if (!$this->save()) {
                Yii::log('PaymeyAccount could not be saved. ' . print_r($this->getErrors(), true), CLogger::LEVEL_ERROR, 'PaymeyAccount');
                throw new Exception('PaymeyAccount could not be saved. ' . print_r($this->getErrors(), true));
            }
            // save entry in balance history
            $balanceHistory = new BalanceHistory();
            $balanceHistory->paymey_account_id = $this->id;
            $balanceHistory->transaction_id = $transactionId;
            $balanceHistory->transaction_detail_id = $transactionDetailId;
            $balanceHistory->current_balance = $this->balance;
            if (!$balanceHistory->save()) {
                Yii::log('BalanceHistory could not be saved. ' . print_r($balanceHistory->getErrors(), true), CLogger::LEVEL_ERROR, 'PaymeyAccount');
                throw new Exception('BalanceHistory could not be saved. ' . print_r($balanceHistory->getErrors(), true));
            }
            // commit transaction
            $dbTransaction->commit();
        } catch (Exception $e) {
            // do a rollback
            $dbTransaction->rollBack();
            return false;
        }
        return true;
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'paymey_accounts';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('account_id, currency_id, stat_name, name', 'required'),
            array('balance, status, activation_attempts, is_deleted', 'numerical', 'integerOnly'=>true),
            array('account_id, currency_id, created, created_by, modified, modified_by', 'length', 'max'=>10),
            array('stat_name, name, stat_name_ext', 'length', 'max'=>255),
            // The following rule is used by search().
            array('id, account_id, stat_name, balance, currency_id, status, is_deleted, created, created_by, modified, modified_by', 'safe', 'on'=>'search'),

            array('stat_name, name, stat_name_ext', 'filter', 'filter' => array($obj=new CHtmlPurifier(), 'purify')),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'account' => array(self::BELONGS_TO, 'Account', 'account_id'),
            'currency' => array(self::BELONGS_TO, 'Currency', 'currency_id'),
            'bankAccounts' => array(self::HAS_MANY, 'BankAccount', 'paymey_account_id'),
            'bankAccount' => array(self::HAS_ONE, 'BankAccount', 'paymey_account_id', 'condition' => 'bankAccount.is_default = 1',),

            'transactionsIncoming' => array(self::HAS_MANY, 'Transaction', 'receiver_id'),
            'transactionsOutgoing' => array(self::HAS_MANY, 'Transaction', 'payer_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => Yii::t('models', 'paymeyaccount.id'),
            'account_id' => Yii::t('models', 'Account'),
            'currency_id' => Yii::t('models', 'paymeyaccount.currency'),
            'stat_name' => Yii::t('models', 'paymeyaccount.stat_name'),
            'name' => Yii::t('models', 'paymeyaccount.name'),
            'stat_name_ext' => Yii::t('models', 'paymeyaccount.stat_name_ext'),
            'balance' => Yii::t('models', 'paymeyaccount.balance'),
            'status' => Yii::t('models', 'paymeyaccount.status'),
            'activation_attempts' => Yii::t('models', 'paymeyaccount.activation_attempts'),
            'is_deleted' => Yii::t('models', 'Deleted'),
            'created' => Yii::t('models', 'Created'),
            'created_by' => Yii::t('models', 'Created By'),
            'modified' => Yii::t('models', 'Modified'),
            'modified_by' => Yii::t('models', 'Modified By'),
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search()
    {
        $criteria=new CDbCriteria;

        $criteria->compare('id', $this->id, true);
        $criteria->compare('account_id', $this->account_id, true);
        $criteria->compare('stat_name', $this->stat_name, true);
        $criteria->compare('balance', $this->balance);
        $criteria->compare('currency_id', $this->currency_id, true);
        $criteria->compare('status', $this->status);
        $criteria->compare('is_deleted', $this->is_deleted);
        $criteria->compare('created', $this->created, true);
        $criteria->compare('created_by', $this->created_by, true);
        $criteria->compare('modified', $this->modified, true);
        $criteria->compare('modified_by', $this->modified_by, true);

        return new CActiveDataProvider(
            $this,
            array(
                'criteria'=>$criteria,
            )
        );
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return PaymeyAccount the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }
}
