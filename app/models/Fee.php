<?php

/**
 * This is the model class for table "fees".
 *
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
 * @property int $minimum_charge
 * @property integer $is_deleted
 * @property string $created
 * @property string $created_by
 * @property string $modified
 * @property string $modified_by
 */
class Fee extends CActiveRecordExtended
{

    /*
     *
     */
    public function getFeeAmount($amount)
    {
        if ($this->minimum_charge > 0) {
            $fee = $amount * (MoneyHelper::convertPercent($this->percent) / 100);
            if ($fee < $this->minimum_charge) {
                $fee = $this->minimum_charge;
            }
        } else {
            $fee = $amount * (MoneyHelper::convertPercent($this->percent) / 100) + $this->amount;
        }

        return $fee;
    }

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Fee the static model class
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
        return 'fees';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('fee_group_id, region_id, channel_id, currency_id', 'required'),
            array('is_deleted', 'numerical', 'integerOnly'=>true),
            array('fee_group_id, region_id, channel_id, currency_id, created, created_by, modified, modified_by', 'length', 'max'=>10),
            array('from, to, percent, amount, minimum_charge', 'length', 'max'=>11),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, fee_group_id, region_id, channel_id, currency_id, from, to, percent, amount, is_deleted, created, created_by, modified, modified_by', 'safe', 'on'=>'search'),
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
            'region'=>array(self::BELONGS_TO, 'Region', 'region_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => Yii::t('models', 'fee.id'),
            'fee_group_id' => Yii::t('models', 'fee.fee_group'),
            'region_id' => Yii::t('models', 'fee.region'),
            'channel_id' => Yii::t('models', 'fee.channel'),
            'currency_id' => Yii::t('models', 'fee.currency'),
            'from' => Yii::t('models', 'fee.from'),
            'to' => Yii::t('models', 'fee.to'),
            'percent' => Yii::t('models', 'fee.percent'),
            'amount' => Yii::t('models', 'fee.amount'),
            'minimum_charge' => Yii::t('models', 'fee.minimum_charge'),
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
        $criteria->compare('fee_group_id', $this->fee_group_id, true);
        $criteria->compare('region_id', $this->region_id, true);
        $criteria->compare('channel_id', $this->channel_id, true);
        $criteria->compare('currency_id', $this->currency_id, true);
        $criteria->compare('from', $this->from, true);
        $criteria->compare('to', $this->to, true);
        $criteria->compare('percent', $this->percent, true);
        $criteria->compare('amount', $this->amount, true);
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