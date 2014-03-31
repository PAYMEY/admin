<?php

/**
 * This is the model class for table "accounts".
 *
 * The followings are the available columns in table 'accounts':
 * @property string $id
 * @property string $owner_id
 * @property string $business_id
 * @property string $corporation_id
 * @property string $fee_group_id
 * @property string $free_transactions
 * @property string $affiliate_code
 * @property string $timezone_id
 * @property string $status
 * @property string $is_deleted
 * @property string $created
 * @property string $created_by
 * @property string $modified
 * @property string $modified_by
 */
class Account extends CActiveRecordExtended
{
    const STATUS_ERROR = -1;
    const STATUS_PENDING = 0; // after first create in SignupController
    const STATUS_USER_APPROVED = 1; // after email activation in SignupController
    const STATUS_BANK_APPROVED = 2; // not used yet

    /*
     *
     */
    public function findByAffiliate($affiliateCode)
    {
        return $this->findByAttributes(array('affiliate_code' => $affiliateCode));
    }

    /*
     *
     */
    public function getAccountOwnerName()
    {
        if ($this->isBusiness()) {
            return $this->business->business_name;
        } else {
            return $this->owner->firstname.' '.$this->owner->lastname;
        }
    }

    /*
     *
     */
    public function getPayOnUserData()
    {
        $dateTime = DateTime::createFromFormat('d.m.Y', $this->owner->date_of_birth);
        if ($dateTime instanceof DateTime) {
            $birthdate = $dateTime->format('Y-m-d');
        } else {
            $birthdate = '';
        }

        $userData = array(
            'name' => array(
                'given' => $this->owner->firstname,
                'family' => $this->owner->lastname,
                'birthdate' => $birthdate,
                'sex' => strtoupper($this->owner->gender),
            ),
            'address' => array(
                'street' => $this->mainaddress->street . ' ' . $this->mainaddress->street_number,
                'zip' => $this->mainaddress->zip,
                'city' => $this->mainaddress->city,
                'country' => $this->mainaddress->country->iso_2,
            ),
            'contact' => array(
                'Email' => $this->owner->email,
                'Ip' => CHttpRequest::getUserHostAddress(),
            )
        );

        return $userData;
    }

    /*
     *
     */
    public function isBusiness()
    {
        // business switch
        if ($this->business_id > 0) {
            return true;
        }
        return false;
    }

    /**
     *
     */
    public function delete($deleteRelated = true)
    {
        $return = false;
        // start transaction
        $transaction = Yii::app()->db->beginTransaction();
        try {
            if ($deleteRelated) {
                // Delete all related models!?
            }
            $return = parent::delete($deleteRelated);
            if (!$return) {
                throw new Exception('Account could not be deleted');
                //print_r($this->getErrors());
            }

            // commit transaction
            $transaction->commit();
        } catch (Exception $e) {
            // Eine Exception wird ausgelöst, falls eine Abfrage fehlschlägt
            // Alle Änderungen (auch nested) werden rückgängig gemacht.
            $transaction->rollBack();
            //print_r($this->getErrors());
            Yii::log('Exception: '.$e->getMessage(), CLogger::LEVEL_ERROR, 'Account');
        }
        return $return;
    }


    /**
     *
     */
    public function deleteFinal($deleteRelated = true)
    {
        $return = false;
        // start transaction
        $transaction = Yii::app()->db->beginTransaction();
        try {
            // delete all users
            if ($this->beforeDelete()) {
                if ($deleteRelated) {
                    // Delete all related models!?
                }

                $return = parent::deleteFinal($deleteRelated);
                if (!$return) {
                    throw new Exception('Account could not be deleted');
                }
            }
            // commit transaction
            $transaction->commit();
        } catch (Exception $e) {
            // Eine Exception wird ausgelöst, falls eine Abfrage fehlschlägt
            // Alle Änderungen (auch nested) werden rückgängig gemacht.
            $transaction->rollBack();
            Yii::log('Exception: ' . $e->getMessage(), CLogger::LEVEL_ERROR, 'Account');
        }
        return $return;
    }

    /**
     *
     */
    public function restore()
    {
        $return = false;
        // start transaction
        $transaction = Yii::app()->db->beginTransaction();
        try {
            $return = parent::restore();
            // commit transaction
            $transaction->commit();
        } catch (Exception $e) {
            // Eine Exception wird ausgelöst, falls eine Abfrage fehlschlägt
            // Alle Änderungen (auch nested) werden rückgängig gemacht.
            $transaction->rollBack();
            Yii::log('Exception: '.$e->getMessage(), CLogger::LEVEL_ERROR, 'Account');
        }
        return $return;

    }

    /**
     * Returns the static model of the specified AR class.
     * @param string $className
     * @return Account the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'accounts';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('owner_id, fee_group_id', 'required'),
            array('status', 'numerical', 'integerOnly'=>true),
            array('id, owner_id, business_id, corporation_id, timezone_id, fee_group_id, free_transactions, is_deleted, created, created_by, modified, modified_by', 'length', 'max'=>10),
            array('affiliate_code', 'length', 'max'=>255),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, owner_id, business_id, corporation_id, fee_group_id, free_transactions, affiliate_code, timezone_id, is_deleted, created, created_by, modified, modified_by', 'safe', 'on'=>'search'),
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
            'users' => array(self::HAS_MANY, 'User', 'account_id'),

            //'addresses_with_deleted'=>array(self::HAS_MANY, 'Address', 'account_id', 'scopes'=>'deleted'),
            'mainaddress'=>array(self::HAS_ONE, 'Address', 'account_id', 'condition'=>'mainaddress.is_default = 1',),

            'paymeyAccounts' => array(self::HAS_MANY, 'PaymeyAccount', 'account_id'),

            'addresses'=>array(self::HAS_MANY, 'Address', 'account_id'),
            'devices'=>array(self::HAS_MANY, 'Device', 'account_id'),
            'apiKeys'=>array(self::HAS_MANY, 'ApiKey', 'account_id'),

            'owner'=>array(self::BELONGS_TO, 'User', 'owner_id'),
            'business'=>array(self::BELONGS_TO, 'Business', 'business_id'),
            'feeGroup'=>array(self::BELONGS_TO, 'FeeGroup', 'fee_group_id'),
            'timezone' => array(self::BELONGS_TO, 'Timezone', 'timezone_id'),

        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => Yii::t('models', 'account.id'),
            'owner_id' => Yii::t('models', 'account.owner'),
            'business_id' => Yii::t('models', 'account.business'),
            'corporation_id' => Yii::t('models', 'account.corporation'),
            'fee_group_id' => Yii::t('models', 'account.fee_group'),
            'free_transactions' => Yii::t('models', 'account.free_transactions'),
            'affiliate_code' => Yii::t('models', 'account.affiliate_code'),
            'timezone_id' => Yii::t('models', 'account.timezone'),
            'status' => Yii::t('models', 'account.status'),
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
        $criteria->compare('owner_id', $this->owner_id, true);
        $criteria->compare('business_id', $this->business_id, true);
        $criteria->compare('corporation_id', $this->corporation_id, true);
        $criteria->compare('fee_group_id', $this->fee_group_id, true);
        $criteria->compare('free_transactions', $this->free_transactions, true);
        $criteria->compare('affiliate_code', $this->affiliate_code, true);
        $criteria->compare('timezone', $this->timezone, true);
        $criteria->compare('status', $this->status, true);
        $criteria->compare('is_deleted', $this->is_deleted, true);
        $criteria->compare('created', $this->created, true);
        $criteria->compare('created_by', $this->created_by, true);
        $criteria->compare('modified', $this->modified, true);
        $criteria->compare('modified_by', $this->modified_by, true);

        return new CActiveDataProvider('Account', array(
            'criteria'=>$criteria,
        ));
    }
}
