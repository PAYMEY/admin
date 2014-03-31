<?php

/**
 * This is the model class for table "devices".
 *
 * The followings are the available columns in table 'devices':
 * @property string $id
 * @property string $account_id
 * @property string $api_key_id
 * @property string $name
 * @property string $limit
 * @property string $uuid
 * @property integer $is_disabled
 * @property integer $is_deleted
 * @property string $created
 * @property string $created_by
 * @property string $modified
 * @property string $modified_by
 */
class Device extends CActiveRecordExtended
{

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Device the static model class
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
        return 'devices';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('account_id, api_key_id, name', 'required'),
            array('is_disabled, is_deleted', 'numerical', 'integerOnly'=>true),
            array('account_id, api_key_id, limit, created, created_by, modified, modified_by', 'length', 'max'=>10),
            array('name, uuid', 'length', 'max'=>255),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, account_id, api_key_id, name, limit, uuid, is_disabled, is_deleted, created, created_by, modified, modified_by', 'safe', 'on'=>'search'),

            array('name, uuid', 'filter', 'filter' => array($obj=new CHtmlPurifier(), 'purify')),
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
            'account'=>array(self::BELONGS_TO, 'Account', 'account_id'),
            'api_key'=>array(self::BELONGS_TO, 'ApiKey', 'api_key_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => Yii::t('models', 'device.id'),
            'account_id' => Yii::t('models', 'related account'),
            'api_key_id' => Yii::t('models', 'device.api_key_id'),
            'name' => Yii::t('models', 'device.name'),
            'limit' => Yii::t('models', 'device.limit'),
            'uuid' => Yii::t('models', 'device.uuid'),
            'is_disabled' => Yii::t('models', 'device.disabled'),
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
        $criteria->compare('account_id', $this->account_id, true);
        $criteria->compare('api_key_id', $this->api_key_id, true);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('limit', $this->limit, true);
        $criteria->compare('uuid', $this->uuid, true);
        $criteria->compare('is_disabled', $this->is_disabled);
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
