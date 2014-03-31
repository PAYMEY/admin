<?php

/**
 * This is the model class for table "business_subcategories".
 *
 * The followings are the available columns in table 'business_subcategories':
 * @property integer $id
 * @property integer $category_id
 * @property string $name
 * @property string $payon_channel
 * @property integer $is_deleted
 * @property string $created
 * @property string $created_by
 * @property string $modified
 * @property string $modified_by
 */
class BusinessSubcategory extends CActiveRecordExtended
{
    /*
     *
     */
    public function findAllByCategory($categoryId)
    {
        return $this->findAllByAttributes(
            array('category_id' => $categoryId)
        );
    }

    /*
     *
     */
    public static function getListOfSubcategoryTypes($categoryId)
    {
        $types = self::model()->findAllByCategory($categoryId);

        $categoryListData = CHtml::listData(
            $types,
            'id',
            function ($type) {
                return Yii::t('models', $type->name);
            }
        );

        return $categoryListData;
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'business_subcategories';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('category_id, name', 'required'),
            array('category_id, is_deleted', 'numerical', 'integerOnly'=>true),
            array('name, payon_channel', 'length', 'max'=>255),
            array('created, created_by, modified, modified_by', 'length', 'max'=>10),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, category_id, name, is_deleted, created, created_by, modified, modified_by', 'safe', 'on'=>'search'),
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
            'businessCategory' => array(self::BELONGS_TO, 'BusinessCategory', 'category_id'),
            'businesses' => array(self::HAS_MANY, 'Business', 'business_subcategory_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => Yii::t('models', 'businesssubcat.id'),
            'category_id' => Yii::t('models', 'businesssubcat.category'),
            'name' => Yii::t('models', 'businesssubcat.name'),
            'payon_channel' => Yii::t('models', 'businesssubcat.payon_channel'),
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
        $criteria->compare('category_id', $this->category_id);
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
     * @return BusinessSubcategory the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /*
     *
     */
    public static function importCSV($filePath)
    {
        if (($handle = fopen($filePath, 'r')) !== false) {
            $i = 0;
            while ($subChannels = fgets($handle, 1024)) {
                $i++;
                $channel = str_getcsv($subChannels, ';', '');

                $businessSubCat = new BusinessSubcategory();

                $businessSubCat->category_id = $channel[0];
                $businessSubCat->name = $channel[1];
                $businessSubCat->payon_channel = $channel[2];

                if (!$businessSubCat->save()) {
                    print_r($businessSubCat->getErrors());
                    exit;
                }
                unset($channel);
                unset($businessSubCat);
            }
            fclose($handle);
        } else {
            echo 'fopen fail';
        }
    }

    /*
     *
     */
    public static function importCSVMessages($filePath, $tempMessagePath)
    {
        if (($handle = fopen($filePath, 'r')) !== false) {

            if (($handleWrite = fopen($tempMessagePath, 'w')) !== false) {
                $i = 0;
                $string = '';
                while ($subChannels = fgets($handle, 1024)) {
                    $i++;
                    $channel = str_getcsv($subChannels, ';', '');
                    $string .= "'".$channel[1]."' => '".$channel[3]."',\n";
                    unset($channel);
                    unset($businessSubCat);
                }
                fwrite($handleWrite, $string);
                fclose($handleWrite);
            }
            fclose($handle);
        } else {
            echo 'fopen fail';
        }
    }

}
