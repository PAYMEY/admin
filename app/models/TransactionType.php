<?php

/**
 * This is the model class for table "transaction_types".
 *
 * The followings are the available columns in table 'transaction_types':
 * @property integer $id
 * @property string $name
 * @property string $dsc
 * @property integer $is_deleted
 * @property string $created
 * @property string $created_by
 * @property string $modified
 * @property string $modified_by
 */
class TransactionType extends CActiveRecordExtended
{
    /*
     * TYPES
     * debit
     * credit
     * change
     * fee
     */
    const DEBIT = 1;
    const CREDIT = 2;
    const FEE = 3;
    const FREETRANS = 4;
    const DIRECTDEBIT = 5;
    const PROMOTION = 6;
    const CREDITTRANSFER = 7;

    /*
     *
     */
    public static function getDefaultId()
    {
        // todo
        return 1;
    }

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return TransactionType the static model class
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
        return 'transaction_types';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('id, name', 'required'),
            array('id, is_deleted', 'numerical', 'integerOnly'=>true),
            array('name', 'length', 'max'=>255),
            array('created, created_by, modified, modified_by', 'length', 'max'=>10),
            array('dsc', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, name, dsc, is_deleted, created, created_by, modified, modified_by', 'safe', 'on'=>'search'),
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
            'transactionDetails'=>array(self::HAS_MANY, 'TransactionDetail', 'transaction_type_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => Yii::t('models', 'transactiontype.id'),
            'name' => Yii::t('models', 'transactiontype.name'),
            'dsc' => Yii::t('models', 'transactiontype.description'),
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

        $criteria->compare('id', $this->id);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('dsc', $this->dsc, true);
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