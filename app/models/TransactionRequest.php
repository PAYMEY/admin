<?php

/**
 * This is the model class for table "transaction_requests".
 *
 * The followings are the available columns in table 'transaction_requests':
 * @property string $id
 * @property string $receiver_id
 * @property string $receiver_user_id
 * @property string $currency_id
 * @property string $channel_id
 * @property string $tan
 * @property integer $amount
 * @property string $timestamp
 * @property string $description
 * @property integer $is_completed
 * @property integer $is_deleted
 */
class TransactionRequest extends CActiveRecordExtended
{

    public static function generateTan($receiverId)
    {
        $collision = true;
        while ($collision) {
            $tan = substr(uniqid(mt_rand(), true), 0, 4);
            $collision = self::model()->findByAttributes(
                array(
                    'receiver_id' => $receiverId,
                    'tan' => $tan
                )
            );
        }
        return $tan;
    }

    public function getQRCodeUrl()
    {
        return Yii::app()->createUrl(
            'api/transaction/view',
            array(
                'version' => 1,
                'id' => $this->id
            )
        );
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'transaction_requests';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('receiver_id, receiver_user_id, currency_id, tan, amount, timestamp, description', 'required'),
            array('amount, is_completed, is_deleted', 'numerical', 'integerOnly'=>true),
            array('receiver_id, receiver_user_id, currency_id, channel_id, tan, timestamp', 'length', 'max'=>10),
            array('description', 'length', 'max'=>255),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, receiver_id, receiver_user_id, currency_id, channel_id, tan, amount, timestamp, description', 'safe', 'on'=>'search'),

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
            'currency'=>array(self::BELONGS_TO, 'Currency', 'currency_id'),
            'receiver'=>array(self::BELONGS_TO, 'PaymeyAccount', 'receiver_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        // TODO: yii translation message file!!
        return array(
            'id' => 'ID',
            'receiver_id' => 'Receiver',
            'receiver_user_id' => 'Receiver User',
            'currency_id' => 'Currency',
            'channel_id' => 'Channel',
            'tan' => 'Tan',
            'amount' => 'Amount',
            'timestamp' => 'Timestamp',
            'description' => 'Description',
            'is_completed' => 'is_completed',
            'is_deleted' => Yii::t('models', 'Deleted'),
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
        $criteria->compare('receiver_id', $this->receiver_id, true);
        $criteria->compare('receiver_user_id', $this->receiver_user_id, true);
        $criteria->compare('currency_id', $this->currency_id, true);
        $criteria->compare('channel_id', $this->channel_id, true);
        $criteria->compare('tan', $this->tan, true);
        $criteria->compare('amount', $this->amount);
        $criteria->compare('timestamp', $this->timestamp, true);
        $criteria->compare('description', $this->description, true);

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
     * @return TransactionRequest the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }
}
