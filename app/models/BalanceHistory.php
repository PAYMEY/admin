<?php

/**
 * This is the model class for table "balance_histories".
 *
 * The followings are the available columns in table 'balance_histories':
 * @property string $id
 * @property string $paymey_account_id
 * @property string $transaction_id
 * @property string $transaction_detail_id
 * @property integer $current_balance
 * @property integer $is_deleted
 * @property string $created
 * @property string $created_by
 * @property string $modified
 * @property string $modified_by
 */
class BalanceHistory extends CActiveRecordExtended
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'balance_histories';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('paymey_account_id, transaction_id, transaction_detail_id, current_balance', 'required'),
            array('current_balance, is_deleted', 'numerical', 'integerOnly'=>true),
            array('paymey_account_id, created, created_by, modified, modified_by', 'length', 'max'=>10),
            array('transaction_detail_id', 'length', 'max'=>20),
            // The following rule is used by search().
            array('id, paymey_account_id, transaction_id, transaction_detail_id, current_balance, is_deleted, created, created_by, modified, modified_by', 'safe', 'on'=>'search'),
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
            'transaction' => array(self::BELONGS_TO, 'Transaction', 'transaction_id'),
            'transactionDetails' => array(self::BELONGS_TO, 'TransactionDetail', 'transaction_detail_id'),
        );
    }

    /**
     * todo: translation
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => Yii::t('models', 'ID'),
            'paymey_account_id' => Yii::t('models', 'Paymey Account'),
            'transaction_id' => Yii::t('models', 'Transaction'),
            'transaction_detail_id' => Yii::t('models', 'Transaction Detail'),
            'current_balance' => Yii::t('models', 'Current Balance'),
            'is_deleted' => Yii::t('models', 'Is Deleted'),
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
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria=new CDbCriteria;

        $criteria->compare('id', $this->id, true);
        $criteria->compare('paymey_account_id', $this->paymey_account_id, true);
        $criteria->compare('transaction_detail_id', $this->transaction_detail_id, true);
        $criteria->compare('current_balance', $this->current_balance);
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
     * @return BalanceHistory the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }
}
