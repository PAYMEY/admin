<?php

/**
 * This is the model class for table "addresses".
 *
 * The followings are the available columns in table 'addresses':
 * @property string $id
 * @property string $account_id
 * @property string $country_id
 * @property string $street
 * @property string $street_number
 * @property string $zip
 * @property string $city
 * @property integer $is_default
 * @property string $type
 * @property string $is_deleted
 * @property string $created
 * @property string $created_by
 * @property string $modified
 * @property string $modified_by
 */
class Address extends CActiveRecordExtended
{
    /**
     *
     */
    public function setAsDefaultAddress()
    {
        $this->is_default = 1;
        // die alte defaultAdresse wird automatisch durch beforeSave überschrieben. Keine Behandlung notwendig
        if ($this->save()) {
            return true;
        }
        return false;
    }

    /**
     *
     */
    public static  function setDefaultAddress($id, $account_id)
    {
        $newDefaultAddress = Address::model()->findByAttributes(array('id'=>$id, 'account_id'=>$account_id));
        if ($newDefaultAddress!=null) {
            $newDefaultAddress->is_default = 1;
            // die alte defaultAdresse wird automatisch durch beforeSave überschrieben. Keine Behandlung notwendig
            if ($newDefaultAddress->save()) {
                return true;
            }
        } else {
            Yii::log('Address not found. Id:'.$id, CLogger::LEVEL_ERROR, 'Address');
        }
        return false;
    }

    /**
     * if an address is saved with "is_default" flag active, the former active must be set to 0
     */
    protected function beforeSave()
    {
        // check if there is another is_default
        if ($this->is_default==1) {
            Yii::trace(get_class($this).'.beforeSave()', 'models.beforeSave');
            // findAllBy because there could be foolishly more then one
            $defaultAddresses = Address::model()->findAllByAttributes(array('account_id'=>$this->account_id),'is_default=1');
            // start transaction
            $transaction = Yii::app()->db->beginTransaction();
            try {
                foreach ($defaultAddresses as $address) {
                    // set all others to 0
                    $address->is_default = 0;
                    if (!$address->save()) {
                        throw new Exception('Save error beforeSave()@Address.php');
                    }
                }
                // commit transaction
                $transaction->commit();
            } catch (Exception $e) {
                // Eine Exception wird ausgelöst, falls eine Abfrage fehlschlägt
                // Alle Änderungen (auch nested) werden rückgängig gemacht.
                $transaction->rollBack();
                Yii::log('Exception: '.$e->getMessage(), CLogger::LEVEL_ERROR, 'CActiveRecordExtended');
                return false;
            }
        }
        return parent::beforeSave();
    }

    /**
     * Achtung: Der Standartwert ist invertiert zur parent Funktion!
     * Wenn rekursiv von der Parent Funktion aufgerufen wird ist deleteRelated=true => loeschen ohne check
     */
    public function delete($deleteRelated = false)
    {
        // wenn mit related aufgerufen wird, dann ist die Standardadresse egal
        // wenn ohne related aufgerufen wird muss auf Standardadresse ueberprueft werden
        if (!$deleteRelated && $this->is_default==1) {
            $this->addError('is_default', Yii::t('models', 'adress.message-error-address-cannot-be-deleted'));
            return false;
        }
        return parent::delete($deleteRelated);
    }

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Address the static model class
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
        return 'addresses';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('account_id, country_id, street, street_number, zip, city',  'required'),
            array('is_default, country_id, is_deleted, account_id', 'numerical', 'integerOnly'=>true),
            array('id, account_id, created, created_by, modified, modified_by', 'length', 'max'=>10),
            array('street, street_number, zip, city, type', 'length', 'max'=>255),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, account_id, country_id, street, street_number, zip, city, is_default, type, is_deleted, created, created_by, modified, modified_by', 'safe', 'on'=>'search'),

            array('street, street_number, zip, city, type', 'filter', 'filter' => array($obj=new CHtmlPurifier(), 'purify')),
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
            'country'=>array(self::BELONGS_TO, 'Country', 'country_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => Yii::t('models', 'address.id'),
            'account_id' => Yii::t('models', 'related account'),
            'country_id' => Yii::t('models', 'related country'),
            'street' => Yii::t('models', 'address.street'),
            'street_number' => Yii::t('models', 'address.streetnumber'),
            'zip' => Yii::t('models', 'address.zip'),
            'city' => Yii::t('models', 'address.city'),
            'is_default' => Yii::t('models', 'address.default'),
            'type' => Yii::t('models', 'address.type'),
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
        $criteria->compare('country_id', $this->country_id, true);
        $criteria->compare('street', $this->street, true);
        $criteria->compare('street_number', $this->street_number, true);
        $criteria->compare('zip', $this->zip, true);
        $criteria->compare('city', $this->city, true);
        $criteria->compare('is_default', $this->is_default);
        $criteria->compare('type', $this->type, true);
        $criteria->compare('is_deleted', $this->is_deleted, true);
        $criteria->compare('created', $this->created, true);
        $criteria->compare('created_by', $this->created_by, true);
        $criteria->compare('modified', $this->modified, true);
        $criteria->compare('modified_by', $this->modified_by, true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
}
