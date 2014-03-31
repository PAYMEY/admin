<?php

/**
 * This is the model class for table "affiliate_history".
 *
 * The followings are the available columns in table 'affiliate_history':
 * @property string $id
 * @property string $advertiser_id
 * @property string $customer_id
 * @property integer $status
 * @property integer $is_deleted
 * @property string $created
 * @property string $created_by
 * @property string $modified
 * @property string $modified_by
 */
class AffiliateHistory extends CActiveRecordExtended
{
    const STATUS_NEW = 0;
    const STATUS_REDEEMED = 1;

    /*
     *
     */
    public function findAllNewAffiliates($customerId)
    {
        $attributes = array('customer_id' => $customerId);
        $condition = 'status='.self::STATUS_NEW;
        return $this->findAllByAttributes($attributes, $condition);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'affiliate_history';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('advertiser_id, customer_id', 'required'),
            array('status, is_deleted', 'numerical', 'integerOnly'=>true),
            array('advertiser_id, customer_id, created, created_by, modified, modified_by', 'length', 'max'=>10),
            // The following rule is used by search().
            array('id, advertiser_id, customer_id, status, is_deleted, created, created_by, modified, modified_by', 'safe', 'on'=>'search'),
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
            'advertiser' => array(self::BELONGS_TO, 'Account', 'advertiser_id'),
            'customer' => array(self::BELONGS_TO, 'Account', 'customer_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => Yii::t('models', 'ID'),
            'advertiser_id' => Yii::t('models', 'Advertiser'),
            'customer_id' => Yii::t('models', 'Customer'),
            'status' => Yii::t('models', 'Status'),
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
        $criteria=new CDbCriteria;

        $criteria->compare('id', $this->id, true);
        $criteria->compare('advertiser_id', $this->advertiser_id, true);
        $criteria->compare('customer_id', $this->customer_id, true);
        $criteria->compare('status', $this->status);
        $criteria->compare('is_deleted', $this->is_deleted);
        $criteria->compare('created', $this->created, true);
        $criteria->compare('created_by', $this->created_by, true);
        $criteria->compare('modified', $this->modified, true);
        $criteria->compare('modified_by', $this->modified_by, true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return AffiliateHistory the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }
}
