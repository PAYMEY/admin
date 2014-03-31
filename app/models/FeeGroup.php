<?php

/**
 * This is the model class for table "fee_groups".
 *
 * The followings are the available columns in table 'fee_groups':
 * @property string $id
 * @property string $country_id
 * @property string $name
 * @property string $description
 * @property integer $is_default
 * @property integer $is_deleted
 * @property string $created
 * @property string $created_by
 * @property string $modified
 * @property string $modified_by
 */
class FeeGroup extends CActiveRecordExtended
{

    /*
     *
     */
    public static function getDefaultId($countryId)
    {
        $feeGroup = self::model()->findByAttributes(array('is_default'=>1, 'country_id'=>$countryId));
        if ($feeGroup!=null) {
            return $feeGroup->id;
        }
        return false;
    }


    /*
     * get Fee model for the given value
     */
    public function getFee($value, $regionId = false, $channelId = false, $currencyId = false)
    {
        $fee = $this->queryFee($value, $regionId, $channelId, $currencyId);
        if ($fee===null) {
            // what to do if fee not found?
            // first try with default type
            $fee = $this->queryFee($value, $regionId, false, $currencyId);
            if ($fee===null) {
                // second try with default currency
                $fee = $this->queryFee($value, $regionId, false, false);
                if ($fee===null) {
                    // third try with default region
                    $fee = $this->queryFee($value, false, false, false);
                    if ($fee===null) {
                        // write email to admin
                        $logMessage = 'Fee Combination not seet! value: '.$value.' fee_group_id: '.$this->id.' regionId: '.$regionId.' ChannelId: '. $channelId.' CurrencyId: '.$currencyId;
                        AdminAlarm::alarm('Fee Error', $logMessage);
                        Yii::log($logMessage, CLogger::LEVEL_ERROR, 'CActiveRecordExtended');
                        throw new CHttpException(500, Yii::t('error', 'Fee group combination not found'), 100004);
                    }
                }
            }
        }

        return $fee;
    }

    /*
     *
     */
    private function queryFee($value, $regionId = false, $channelId = false, $currencyId = false)
    {
        if (!$regionId) {
            $regionId = Region::getDefaultId();
        }
        if (!$channelId) {
            $channelId = Channel::getDefaultId();
        }
        if (!$currencyId) {
            $currencyId = Currency::getDefaultId();
        }

        $criteria = new CDbCriteria();
        $criteria->addCondition('`fee_group_id` = '.$this->id);
        $criteria->addCondition('`region_id` = '. $regionId);
        $criteria->addCondition('`channel_id` = '. $channelId);
        $criteria->addCondition('`currency_id` = '. $currencyId);

        $criteria->compare('`to`', '>'.$value);
        $criteria->compare('`from`', '<='.$value);
        $criteria->order = '`from` DESC';
        $fee = Fee::model()->find($criteria);
        return $fee;
    }

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return FeeGroup the static model class
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
        return 'fee_groups';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('country_id, name', 'required'),
            array('is_default, is_deleted', 'numerical', 'integerOnly'=>true),
            array('country_id, created, created_by, modified, modified_by', 'length', 'max'=>10),
            array('name, description', 'length', 'max'=>255),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, country_id, name, description, is_default, is_deleted, created, created_by, modified, modified_by', 'safe', 'on'=>'search'),
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
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => Yii::t('models', 'feegroup.id'),
            'country_id' => Yii::t('models', 'related country'),
            'name' => Yii::t('models', 'feegroup.name'),
            'description' => Yii::t('models', 'feegroup.description'),
            'is_default' => Yii::t('models', 'feegroup.default'),
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
        $criteria->compare('country_id', $this->country_id, true);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('description', $this->description, true);
        $criteria->compare('is_default', $this->is_default);
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