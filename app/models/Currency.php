<?php

/**
 * This is the model class for table "currencies".
 *
 * The followings are the available columns in table 'currencies':
 * @property string $id
 * @property string $name
 * @property string $iso_code
 * @property string $symbol
 * @property integer $status
 * @property integer $is_deleted
 * @property string $created
 * @property string $created_by
 * @property string $modified
 * @property string $modified_by
 */
class Currency extends CActiveRecordExtended
{
    const DEFAULT_ID = 1;

    /*
     *
     */
    public static function getDefaultId()
    {
        // todo
        return self::DEFAULT_ID;
    }

    /*
     *
     */
    public static function getDefaultSymbol()
    {
        // todo
        return '&euro;';
    }

    /**
     *
     */
    public function findAllActiveCurrencies()
    {
        $attributes = array();
        // TODO: Currencies cond
        $condition = '';

        return $this->findAllByAttributes($attributes, $condition);
    }

    /*
     *
     */
    public static function getListOfCurrencies($getInactive = false)
    {
        if ($getInactive) {
            $currencies = self::model()->findAll(array('order' => 'name'));
        } else {
            $currencies = self::model()->findAllActiveCurrencies(array('order' => 'name'));
        }
        $currencyListData = CHtml::listData(
            $currencies,
            'id',
            function ($currencies)
            {
                return $currencies->name . ' (' . $currencies->symbol . ')';
            }
        );

        return $currencyListData;
    }

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Currency the static model class
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
        return 'currencies';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name, iso_code, symbol', 'required'),
            array('status, is_deleted', 'numerical', 'integerOnly'=>true),
            array('name', 'length', 'max'=>255),
            array('iso_code, symbol, created, created_by, modified, modified_by', 'length', 'max'=>10),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, name, iso_code, symbol, status, is_deleted, created, created_by, modified, modified_by', 'safe', 'on'=>'search'),
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
            'id' => Yii::t('models', 'currency.id'),
            'name' => Yii::t('models', 'currency.name'),
            'iso_code' => Yii::t('models', 'currency.iso_code'),
            'symbol' => Yii::t('models', 'currency.symbol'),
            'status' => Yii::t('models', 'currency.status'),
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
        $criteria->compare('symbol', $this->symbol, true);
        $criteria->compare('status', $this->status);
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