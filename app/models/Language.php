<?php

/**
 * This is the model class for table "languages".
 *
 * The followings are the available columns in table 'languages':
 * @property string $id
 * @property string $name
 * @property string $iso_code
 * @property integer $is_deleted
 * @property string $created
 * @property string $created_by
 * @property string $modified
 * @property string $modified_by
 */
class Language extends CActiveRecordExtended
{
    const DEFAULT_ID = 1;


    /**
     *
     */
    public function findAllActiveLanguages()
    {
        $attributes = array();
        // TODO: language cond
        $condition = '';

        return $this->findAllByAttributes($attributes, $condition);
    }

    /*
     *
     */
    public static function getListOfLanguages($getInactive = false)
    {
        if ($getInactive) {
            $languages = self::model()->findAll(array('order' => 'name'));
        } else {
            $languages = self::model()->findAllActiveLanguages(array('order' => 'name'));
        }
        $languageListData = CHtml::listData(
            $languages,
            'id',
            function ($languages)
            {
                return $languages->name;
            }
        );

        return $languageListData;
    }


    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Language the static model class
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
        return 'languages';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name, iso_code', 'required'),
            array('is_deleted', 'numerical', 'integerOnly'=>true),
            array('name, iso_code', 'length', 'max'=>255),
            array('created, created_by, modified, modified_by', 'length', 'max'=>10),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, name, iso_code, is_deleted, created, created_by, modified, modified_by', 'safe', 'on'=>'search'),
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
            'users'=>array(self::HAS_MANY, 'User', 'language_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => Yii::t('models', 'language.id'),
            'name' => Yii::t('models', 'language.name'),
            'iso_code' => Yii::t('models', 'language.iso_code'),
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
        $criteria->compare('name', $this->name, true);
        $criteria->compare('iso_code', $this->iso_code, true);
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