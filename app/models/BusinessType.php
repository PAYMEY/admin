<?php

/**
 * This is the model class for table "business_types".
 *
 * The followings are the available columns in table 'business_types':
 * @property integer $id
 * @property string $name
 * @property integer $is_deleted
 * @property string $created
 * @property string $created_by
 * @property string $modified
 * @property string $modified_by
 */
class BusinessType extends CActiveRecordExtended
{

    /*
     *
     */
    public static function getListOfBusinessTypes()
    {
        $types = self::model()->findAll();

        $businessTypeListData = CHtml::listData(
            $types,
            'id',
            function ($type) {
                return yii::t('models', $type->name);
            }
        );

        return $businessTypeListData;
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'business_types';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name', 'required'),
            array('is_deleted', 'numerical', 'integerOnly'=>true),
            array('name', 'length', 'max'=>255),
            array('created, created_by, modified, modified_by', 'length', 'max'=>10),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, name, is_deleted, created, created_by, modified, modified_by', 'safe', 'on'=>'search'),
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
            'businesses' => array(self::HAS_MANY, 'Business', 'business_type_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => Yii::t('models', 'businesstype.id'),
            'name' => Yii::t('models', 'businesssubcat.name'),
            'is_deleted' => Yii::t('models', 'Deleted'),
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

        $criteria->compare('id', $this->id);
        $criteria->compare('name', $this->name, true);
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
     * @return BusinessType the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}
