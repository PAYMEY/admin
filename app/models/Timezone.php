<?php

/**
 * This is the model class for table "timezones".
 *
 * The followings are the available columns in table 'timezones':
 * @property string $id
 * @property string $country_code
 * @property string $zone_name
 * @property integer $is_deleted
 * @property string $created
 * @property string $created_by
 * @property string $modified
 * @property string $modified_by
 */
class Timezone extends CActiveRecordExtended
{
    const DEFAULT_ID = 136;

    /*
     *
     */
    public static function getListOfTimezones()
    {
        $timezones = self::model()->findAll(array('order' => 'zone_name'));

        $timezoneListData = CHtml::listData(
            $timezones,
            'id',
            function ($timezones)
            {
                return $timezones->zone_name;
            }
        );

        return $timezoneListData;
    }

    /*
     * Import
     */
    public static function importCSV($filePath)
    {
        if (($handle = fopen($filePath, 'r')) !== false) {
            $i = 0;
            while ($timezoneString = fgets($handle, 1024)) {
                $timezone = str_getcsv($timezoneString, ',', '"');
                // country check
                $country = Country::model()->findByCountryCodeIso2($timezone[1]);
                if ($country===null) {
                    echo 'Not found: '.$timezone[1].'<br>';
                    continue;
                }
                $timezoneModel = new Timezone();
                $timezoneModel->country_code = $timezone[1];
                $timezoneModel->zone_name = $timezone[2];
                if (!$timezoneModel->save()) {
                    print_r($timezoneModel->getErrors());
                    exit;
                }
            }
        } else {
            echo 'fopen fail';
        }
    }

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Timezone the static model class
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
        return 'timezones';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('country_code, zone_name', 'required'),
            array('is_deleted', 'numerical', 'integerOnly'=>true),
            array('country_code', 'length', 'max'=>2),
            array('zone_name', 'length', 'max'=>35),
            array('created, created_by, modified, modified_by', 'length', 'max'=>10),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, country_code, zone_name, is_deleted, created, created_by, modified, modified_by', 'safe', 'on'=>'search'),
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
            'id' => Yii::t('models', 'timezone.id'),
            'country_code' => Yii::t('models', 'related country'),
            'zone_name' => Yii::t('models', 'timezone.zone_name'),
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
        $criteria->compare('country_code', $this->country_code, true);
        $criteria->compare('zone_name', $this->zone_name, true);
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