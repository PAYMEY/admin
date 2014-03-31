<?php

/**
 * This is the model class for table "transaction_details".
 *
 * The followings are the available columns in table 'transaction_details':
 * @property string $id
 * @property string $transaction_id
 * @property integer $transaction_type_id
 * @property string $paymey_account_id
 * @property integer $currency_id
 * @property integer $amount
 * @property string $timestamp
 * @property string $description
 * @property integer $status
 * @property integer $is_deleted
 * @property string $created
 * @property string $created_by
 * @property string $modified
 * @property string $modified_by
 */
class TransactionDetail extends CActiveRecordExtended
{
    const STATUS_ERROR = -1;
    const STATUS_PENDING = 0;
    const STATUS_DONE = 1;

    /*
    *
    */
    public function getStatusText()
    {
        return Yii::t('models', 'transactiondetail.status.' . $this->status);
    }

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return TransactionDetail the static model class
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
        return 'transaction_details';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('transaction_id, transaction_type_id, paymey_account_id, currency_id, amount, timestamp, status', 'required'),
            array('transaction_type_id, currency_id, amount, status, is_deleted', 'numerical', 'integerOnly'=>true),
            array('transaction_id', 'length', 'max'=>20),
            array('paymey_account_id, timestamp, created, created_by, modified, modified_by', 'length', 'max'=>10),
            array('description', 'length', 'max'=>255),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, transaction_id, transaction_type_id, paymey_account_id, currency_id, amount, timestamp, description, status, is_deleted, created, created_by, modified, modified_by', 'safe', 'on'=>'search'),

            array('description', 'filter', 'filter' => array($obj=new CHtmlPurifier(), 'purify')),
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
            'transaction'=>array(self::BELONGS_TO, 'Transaction', 'transaction_id'),
            'paymeyAccount'=>array(self::BELONGS_TO, 'PaymeyAccount', 'paymey_account_id'),
            'currency'=>array(self::BELONGS_TO, 'Currency', 'currency_id'),
            'transactionType'=>array(self::BELONGS_TO, 'TransactionType', 'transaction_type_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => Yii::t('models', 'transactiondetail.id'),
            'transaction_id' => Yii::t('models', 'transactiondetail.transaction'),
            'transaction_type_id' => Yii::t('models', 'transactiondetail.transaction_type'),
            'paymey_account_id' => Yii::t('models', 'transactiondetail.paymey_account_id'),
            'currency_id' => Yii::t('models', 'transactiondetail.currency'),
            'amount' => Yii::t('models', 'transactiondetail.amount'),
            'timestamp' => Yii::t('models', 'transactiondetail.timestamp'),
            'description' => Yii::t('models', 'transactiondetail.description'),
            'status' => Yii::t('models', 'transactiondetail.status'),
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
        $criteria->compare('transaction_id', $this->transaction_id, true);
        $criteria->compare('transaction_type_id', $this->transaction_type_id);
        $criteria->compare('paymey_account_id', $this->paymey_account_id, true);
        $criteria->compare('currency_id', $this->currency_id);
        $criteria->compare('amount', $this->amount);
        $criteria->compare('timestamp', $this->timestamp, true);
        $criteria->compare('description', $this->description, true);
        $criteria->compare('status', $this->status);
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
