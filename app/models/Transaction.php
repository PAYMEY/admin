<?php

/**
 * This is the model class for table "transactions".
 *
 * The followings are the available columns in table 'transactions':
 * @property string $id
 * @property string $payer_id
 * @property string $payer_user_id
 * @property string $receiver_id
 * @property string $receiver_user_id
 * @property string $currency_id
 * @property string $channel_id
 * @property string $timestamp
 * @property integer $amount
 * @property integer $fee
 * @property string $type
 * @property integer $status
 * @property integer $fee_amount
 * @property integer $fee_percent
 * @property integer $pspId
 * @property integer $short_id
 * @property integer $is_deleted
 * @property string $created
 * @property string $created_by
 * @property string $modified
 * @property string $modified_by
 */
class Transaction extends CActiveRecordExtended
{
    const STATUS_FAILED = -2;
    const STATUS_ERROR = -1;
    const STATUS_NEW = 0;
    const STATUS_PENDING = 1;
    const STATUS_APPROVED = 2;

    const TYPE_PAYMENT = 1;
    const TYPE_DEPOSIT = 2;
    const TYPE_PAYOUT = 3;
    const TYPE_CREDITVOUCHER = 4;

    /*
     *
     */
    public static function getDefaultType()
    {
        return self::TYPE_PAYMENT;
    }

    /*
     *
     */
    public function getNetAmount()
    {
        return $this->amount - $this->fee;
    }

    /*
     *
     */
    public function findByAccountIdPaged($accountId, $page = 0, $pageSize = 30)
    {
        $dataProvider=new CActiveDataProvider(
            'Transaction',
            array(
                'criteria'=>array(
                    'condition' => 'payer_id='.$accountId.' OR receiver_id='.$accountId,
                    'order'=>'timestamp DESC',
                ),
                'countCriteria'=>array(
                    'condition' => 'payer_id='.$accountId.' OR receiver_id='.$accountId,
                    // 'order' and 'with' clauses have no meaning for the count query
                ),
                'pagination'=>array(
                    'pageSize' => $pageSize,
                    'currentPage' => $page,
                    'validateCurrentPage' => false
                ),
            )
        );
        $data = $dataProvider->getData();

        return $data;
    }

    public function findByPaymeyAccountId($paymeyAccountId, $lastId = 0, $blockSize = 30)
    {
        if ($lastId == 0) {
            $condition = 'payer_id=:paymeyAccountId OR receiver_id=:paymeyAccountId';
        } else {
            $condition = '(payer_id=:paymeyAccountId OR receiver_id=:paymeyAccountId) AND id < :id';
        }

        Yii::log($condition.' '.$lastId);

        $model = $this->findAll(
            array(
                'condition' => $condition,
                'params' => array(
                    ':paymeyAccountId' => (int)$paymeyAccountId,
                    ':id' => (int)$lastId,
                ),
                'order' => 'id DESC',
                'limit' => $blockSize
            )
        );
        return $model;
    }

    /*
     *
     */
    public static function sumOutgoingTransactions($paymeyAccountId, $limitation = false)
    {
        $connection = Yii::app()->db;
        $sql = 'SELECT SUM(amount) as sum FROM  transactions WHERE payer_id=:paymeyAccountId AND status > 0';

        switch ($limitation) {
            case 'daily':
                $checkTime = time() - 86400;
                $sql .= ' AND created > ' . $checkTime;
                break;
            case 'monthly':
                $checkTime = time() - 2592000; // 2592000 -> 30 Days
                $sql .= ' AND created > '. $checkTime;
                break;
            case 'yearly':
                $checkTime = time() - 31536000;
                $sql .= ' AND created > ' . $checkTime;
                break;
            default:
                break;
        }

        $sql .= ' GROUP BY payer_id;';
        $command = $connection->createCommand($sql);
        $command->bindParam('paymeyAccountId', $paymeyAccountId, PDO::PARAM_INT);
        $dataReader = $command->query();
        $row = $dataReader->read();
        return $row['sum'];
    }

    /*
     *
     */
    public static function sumIncomingTransactions($paymeyAccountId, $limitation = false)
    {
        $connection = Yii::app()->db;
        $sql = 'SELECT SUM(amount) as sum FROM  transactions WHERE receiver_id=:paymeyAccountId AND status > 0';

        switch ($limitation) {
            case 'daily':
                $checkTime = time() - 86400;
                $sql .= ' AND created > ' . $checkTime;
                break;
            case 'monthly':
                $checkTime = time() - 2592000; // 2592000 -> 30 Days
                $sql .= ' AND created > ' . $checkTime;
                break;
            case 'yearly':
                $checkTime = time() - 31536000;
                $sql .= ' AND created > ' . $checkTime;
                break;
            default:
                break;
        }

        $sql .= ' GROUP BY payer_id;';
        $command = $connection->createCommand($sql);
        $command->bindParam('paymeyAccountId', $paymeyAccountId, PDO::PARAM_INT);
        $dataReader = $command->query();
        $row = $dataReader->read();
        return $row['sum'];
    }

    /*
     *
     */
    public function getStatusText()
    {
        return Yii::t('models', 'transaction.status.'.$this->status);
    }

    /*
     * complete the transaction
     */
    public function complete($short_id)
    {

    }

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Transaction the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'transactions';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('payer_id, payer_user_id, receiver_id, receiver_user_id, currency_id, channel_id, timestamp, amount, fee, type, status, fee_amount, fee_percent', 'required'),
            array('amount, fee, status, fee_amount, fee_percent, is_deleted', 'numerical', 'integerOnly'=>true),
            array('payer_id, payer_user_id, receiver_id, receiver_user_id, currency_id, channel_id, timestamp, type, created, created_by, modified, modified_by', 'length', 'max'=>10),
            array('pspId', 'length', 'max' => 255),
            array('short_id', 'length', 'max' => 14),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, payer_id, payer_user_id, receiver_id, receiver_user_id, currency_id, channel_id, timestamp, amount, fee, type, status, fee_amount, fee_percent, is_deleted, created, created_by, modified, modified_by', 'safe', 'on'=>'search'),
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
            'transactionDetails'=>array(self::HAS_MANY, 'TransactionDetail', 'transaction_id', 'order'=>'transactionDetails.modified'),
            'payer'=>array(self::BELONGS_TO, 'PaymeyAccount', 'payer_id'),
            'receiver'=>array(self::BELONGS_TO, 'PaymeyAccount', 'receiver_id'),
            'payerUser'=>array(self::BELONGS_TO, 'User', 'payer_user_id'),
            'receiverUser'=>array(self::BELONGS_TO, 'User', 'receiver_user_id'),
            'currency'=>array(self::BELONGS_TO, 'Currency', 'currency_id'),
            // todo: channel relation
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => Yii::t('models', 'transaction.id'),
            'payer_id' => Yii::t('models', 'transaction.payer'),
            'payer_user_id' => Yii::t('models', 'transaction.payer_user'),
            'receiver_id' => Yii::t('models', 'transaction.receiver'),
            'receiver_user_id' => Yii::t('models', 'transaction.receiver_user'),
            'currency_id' => Yii::t('models', 'transaction.currency'),
            'channel_id' => Yii::t('models', 'transaction.channel'),
            'timestamp' => Yii::t('models', 'transaction.timestamp'),
            'amount' => Yii::t('models', 'transaction.amount'),
            'fee' => Yii::t('models', 'transaction.fee'),
            'type' => Yii::t('models', 'transaction.type'),
            'status' => Yii::t('models', 'transaction.status'),
            'fee_amount' => Yii::t('models', 'transaction.fee_amount'),
            'fee_percent' => Yii::t('models', 'transaction.fee_percent'),
            'pspId' => Yii::t('models', 'transaction.paymentServiceProviderId'),
            'short_id' => Yii::t('models', 'transaction.short_id'),
            'is_deleted' => Yii::t('models', 'Deleted'),
            'created' => Yii::t('models', 'Created'),
            'created_by' => Yii::t('models', 'Created By'),
            'modified' => Yii::t('models', 'Modified'),
            'modified_by' => Yii::t('models', 'Modified By'),
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria=new CDbCriteria;

        $criteria->compare('id', $this->id, true);
        $criteria->compare('payer_id', $this->payer_id, true);
        $criteria->compare('payer_user_id', $this->payer_user_id, true);
        $criteria->compare('receiver_id', $this->receiver_id, true);
        $criteria->compare('receiver_user_id', $this->receiver_user_id, true);
        $criteria->compare('currency_id', $this->currency_id, true);
        $criteria->compare('channel_id', $this->channel_id, true);
        $criteria->compare('timestamp', $this->timestamp, true);
        $criteria->compare('amount', $this->amount);
        $criteria->compare('fee', $this->fee);
        $criteria->compare('type', $this->type, true);
        $criteria->compare('status', $this->status);
        $criteria->compare('fee_amount', $this->fee_amount);
        $criteria->compare('fee_percent', $this->fee_percent);
        $criteria->compare('is_deleted', $this->is_deleted);
        $criteria->compare('created', $this->created, true);
        $criteria->compare('created_by', $this->created_by, true);
        $criteria->compare('modified', $this->modified, true);
        $criteria->compare('modified_by', $this->modified_by, true);

        return new CActiveDataProvider(
            $this,
            array('criteria'=>$criteria)
        );
    }
}
