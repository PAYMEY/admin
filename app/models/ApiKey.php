<?php

/**
 * This is the model class for table "api_keys".
 *
 * The followings are the available columns in table 'api_keys':
 * @property string $id
 * @property string $account_id
 * @property string $key_ident
 * @property string $key_secret
 * @property integer $is_active
 * @property integer $is_deleted
 * @property string $created
 * @property string $created_by
 * @property string $modified
 * @property string $modified_by
 */
class ApiKey extends CActiveRecordExtended
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return ApiKey the static model class
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
        return 'api_keys';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('account_id, key_ident, key_secret', 'required'),
            array('is_active, is_deleted', 'numerical', 'integerOnly'=>true),
            array('account_id, created, created_by, modified, modified_by', 'length', 'max'=>10),
            array('key_ident, key_secret', 'length', 'max'=>255),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, account_id, key_ident, key_secret, is_active, is_deleted, created, created_by, modified, modified_by', 'safe', 'on'=>'search'),
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
            'device'=>array(self::HAS_ONE, 'Device', 'api_key_id'),
            'account'=>array(self::BELONGS_TO, 'Account', 'account_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => Yii::t('models', 'apikey.id'),
            'account_id' => Yii::t('models', 'related account'),
            'key_ident' => Yii::t('models', 'apikey.key_ident'),
            'key_secret' => Yii::t('models', 'apikey.key_secret'),
            'is_active' => Yii::t('models', 'apikey.is_active'),
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
        $criteria->compare('key_ident', $this->key_ident, true);
        $criteria->compare('key_secret', $this->key_secret, true);
        $criteria->compare('is_active', $this->is_active);
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
