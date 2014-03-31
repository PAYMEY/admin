<?php

/**
 * This is the model class for table "businesses".
 *
 * The followings are the available columns in table 'businesses':
 * @property string $id
 * @property integer $business_type_id
 * @property integer $business_category_id
 * @property integer $business_subcategory_id
 * @property string $business_name
 * @property string $tax_id
 * @property integer $is_deleted
 * @property string $created
 * @property string $created_by
 * @property string $modified
 * @property string $modified_by
 */
class Business extends CActiveRecordExtended
{

    /*
     *
     */
    public function getChannelData()
    {
        $channel = false;
        $businessSubCatModel = $this->businessSubcategory;

        if ($this->business_subcategory_id > 0 && $businessSubCatModel!=null) {
            $channel['payon_channel'] = $businessSubCatModel->payon_channel;
            $channel['payon_sender'] = $businessSubCatModel->businessCategory->payon_sender;
            $channel['payon_user'] = $businessSubCatModel->businessCategory->payon_login;
            $channel['payon_pass'] = $businessSubCatModel->businessCategory->payon_pass;
            $channel['payon_secret'] = $businessSubCatModel->businessCategory->payon_secret;
        } else {
            $businessCatModel = $this->businessCategory;
            if ($businessCatModel != null) {
                $channel['payon_channel'] = $businessCatModel->payon_channel;
                $channel['payon_sender'] = $businessCatModel->payon_sender;
                $channel['payon_user'] = $businessCatModel->payon_login;
                $channel['payon_pass'] = $businessCatModel->payon_pass;
                $channel['payon_secret'] = $businessCatModel->payon_secret;
            }
        }

        return $channel;
    }

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Business the static model class
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
        return 'businesses';
    }

    /*
     *
     */
    public function checkBusinessType($attribute, $params)
    {
        if ($this->business_type_id == 0) {
            $this->addError(
                'business_type_id',
                yii::t('errors', 'Please choose a business type')
            );
        }
    }

    /*
     *
     */
    public function checkBusinessCategory($attribute, $params)
    {
        if ($this->business_category_id == 0) {
            $this->addError(
                'business_category_id',
                yii::t('errors', 'Please choose a business category')
            );
        }
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('business_name, business_type_id, business_category_id', 'required'),
            array('business_type_id', 'checkBusinessType'),
            array('business_category_id', 'checkBusinessCategory'),
            array('is_deleted, business_type_id, business_category_id, business_subcategory_id', 'numerical', 'integerOnly'=>true),
            array('business_name, tax_id', 'length', 'max'=>255),
            array('created, created_by, modified, modified_by', 'length', 'max'=>10),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, business_name, tax_id, is_deleted, created, created_by, modified, modified_by', 'safe', 'on'=>'search'),

            array('business_name, tax_id', 'filter', 'filter' => array($obj=new CHtmlPurifier(), 'purify')),
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
            'accounts'=>array(self::HAS_MANY, 'account', 'business_id'),
            'businessType' => array(self::BELONGS_TO, 'BusinessType', 'business_type_id'),
            'businessCategory' => array(self::BELONGS_TO, 'BusinessCategory', 'business_category_id'),
            'businessSubcategory' => array(self::BELONGS_TO, 'BusinessSubcategory', 'business_subcategory_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => Yii::t('models', 'business.id'),
            'business_type_id' => Yii::t('models', 'business.business_type_id'),
            'business_category_id' => Yii::t('models', 'business.business_category_id'),
            'business_subcategory_id' => Yii::t('models', 'business.business_subcategory_id'),
            'business_name' => Yii::t('models', 'business.name'),
            'tax_id' => Yii::t('models', 'business.tax'),
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
        $criteria->compare('business_name', $this->business_name, true);
        $criteria->compare('tax_id', $this->tax_id, true);
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
