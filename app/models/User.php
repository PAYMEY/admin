<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property string $id
 * @property string $account_id
 * @property string $language_id
 * @property string $gender
 * @property string $firstname
 * @property string $lastname
 * @property string $email
 * @property string $tmp_email
 * @property string $password
 * @property string $activation_hash
 * @property string $pass_created
 * @property string $date_of_birth
 * @property string $nationality
 * @property string $mobile
 * @property string $phone
 * @property string $phone_pin
 * @property integer $is_verified
 * @property integer $status
 * @property integer $zendesk_id
 * @property string $is_deleted
 * @property string $created
 * @property string $created_by
 * @property string $modified
 * @property string $modified_by
 */
class User extends CActiveRecordExtended
{
    const STATUS_PENDING = 0;
    const STATUS_APPROVED = 1;

    /**
     * generate the activation Link
     * @return url
     */
    public function getActivationLink()
    {
        if (!$this->getIsNewRecord()) {
            $hash = $this->getActivationHash();
            $url = Yii::app()->createAbsoluteUrl('/signup/activate', array('u'=>$this->id, 'act'=> $hash));
            return $url;
        } else {
            return false;
        }
    }

    /**
     * check the activation Link
     */
    public function checkActivationLink($hashToCheck)
    {
        if (!$this->getIsNewRecord()) {
            $hash = $this->getActivationHash();
            if (CPasswordHelper::same($hash, $hashToCheck)) {
                return true;
            }
        }

        return false;
    }

    /**
     * get the activation hash
     */
    private function getActivationHash()
    {
        return urlencode(hash('sha256', $this->email . '-' . $this->lastname . '-' . $this->nationality . '-' . $this->activation_hash));
        //return hash('sha256', $this->email . '-' . $this->lastname . '-' . $this->nationality . '-' . $this->activation_hash);
    }

    /**
     * generate and set a new password in AR
     * @return password
     */
    public function setNewPassword()
    {
        $pass = uniqid(mt_rand(), true);
        $pass = md5($pass);
        $pass = substr($pass, 0, 8);
        $this->setPassword($pass);
        return $pass;
    }

    /**
     * Perform password comparison
     * @param (string) $pass
     * @return bool
     */
    public function checkPassword($password)
    {
        return CPasswordHelper::verifyPassword($password, $this->password);
    }

    /**
     * set password in AR
     * @param $pass Password in Plaintext
     * @return bool
     */
    public function setPassword($pass)
    {
        /*
        if ($this->activation_hash==null) {
            $this->activation_hash = $this->getHash();
        }
        */
        $this->password = $this->hashPassword($pass);
        $this->pass_created = time();

        return true;
    }

    /**
     *
     */
    public function setNewActivationHash()
    {
        $this->activation_hash = $this->getHash();
        return true;
    }

    /**
     *
     */
    private function getHash()
    {
        return Yii::app()->getSecurityManager()->generateRandomString(16);
    }


    /**
     * Hash Passwort and salt together
     * @param $pass Password in Plaintext
     * @return string
     */
    private function hashPassword($pass)
    {
        return CPasswordHelper::hashPassword($pass);
        //return hash('sha512', $pass.'-'.$salt);
    }

    /*
     *
     */
    protected function afterFind()
    {
        // convert to display format
        $this->date_of_birth = DateTime::createFromFormat('Y-m-d', $this->date_of_birth)->format('d.m.Y');
        parent::afterFind();
    }

    /*
     *
     */
    protected function beforeSave()
    {
        // convert to storage format, only if in display format
        $dateTime = DateTime::createFromFormat('d.m.Y', $this->date_of_birth);
        if ($dateTime instanceof DateTime) {
            $this->date_of_birth = $dateTime->format('Y-m-d');
        }
        return parent::beforeSave();
    }

    /**
     *
     */
    public function uniqueLogin($attribute, $params)
    {
        if ($this->getIsNewRecord()) {
            $model = $this->findByAttributes(array( 'email' => $this->email));
            $model2 = $this->findByAttributes(array( 'tmp_email' => $this->email));
            if ($model != null || $model2 != null) {
                $this->addError(
                    'email',
                    yii::t('errors', 'Es existiert bereits ein Benutzer mit dieser E-Mail Adresse')
                );
            }
        }
    }

    /**
     *
     */
    public function uniqueEmail($attribute, $params)
    {
        if ($this->tmp_email != null) {
            $model = $this->findByAttributes(array( 'email' => $this->tmp_email), 'id != '.$this->id);
            $model2 = $this->findByAttributes(array( 'tmp_email' => $this->tmp_email), 'id != '.$this->id);
            if ($model != null || $model2 != null) {
                $this->addError(
                    'tmp_email',
                    yii::t('errors', 'Es existiert bereits ein Benutzer mit dieser E-Mail Adresse')
                );
            }
        }
    }

    /**
     *
     */
    public function dateCheck($attribute, $params)
    {
    }

    /*
     *
     */
    public function createSupportPasswort($length = 4)
    {
        $characters = 'abcdefghijklmnopqrstuvwxyz0123456789';

        $string = '';
        for ($i = 0; $i < $length; $i++) {
            $string .= $characters[rand(0, strlen($characters) - 1)];
        }

        return $string;
    }

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return User the static model class
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
        return 'users';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('language_id, account_id, gender, firstname, lastname, email, mobile, password, date_of_birth, nationality, phone_pin', 'required'),
            array('email', 'uniqueLogin'),
            array('tmp_email', 'uniqueEmail'),
            array('email, tmp_email', 'email'),
            array('date_of_birth', 'dateCheck'),
            array('is_verified, status, nationality, zendesk_id', 'numerical', 'integerOnly'=>true),
            array('id, account_id, language_id, pass_created, date_of_birth, zendesk_id, is_deleted, created, created_by, modified, modified_by', 'length', 'max'=>10),
            array('gender', 'length', 'max'=>1),
            array('firstname, lastname, email, tmp_email, password, activation_hash, mobile, phone', 'length', 'max'=>255),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, account_id, language_id, gender, firstname, lastname, email, tmp_email, password, activation_hash, date_of_birth, nationality, mobile, phone, is_verified, is_deleted, created, created_by, modified, modified_by', 'safe', 'on'=>'search'),

            array('firstname, lastname, email, tmp_email, password, mobile, phone, phone_pin', 'filter', 'filter' => array($obj=new CHtmlPurifier(), 'purify')),
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
            /*
            'accounts'=>array(self::MANY_MANY, 'Account',
                'account_users(user_id, account_id)',
            ),
            */

            'account' => array(self::BELONGS_TO, 'Account', 'account_id'),

            'language'=>array(self::BELONGS_TO, 'Language', 'language_id'),

            'transactionsIncoming'=>array(self::HAS_MANY, 'Transaction', 'receiver_user_id'),
            'transactionsOutgoing'=>array(self::HAS_MANY, 'Transaction', 'payer_user_id'),

            // do not add a relation to account with owner_id!! This will end up in a fatal error by deleting an account
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => Yii::t('models', 'user.id'),
            'account_id' => Yii::t('models', 'related account'),
            'language_id' => Yii::t('models', 'user.language'),
            'gender' => Yii::t('models', 'user.gender'),
            'firstname' => Yii::t('models', 'user.firstname'),
            'lastname' => Yii::t('models', 'user.lastname'),
            'email' => Yii::t('models', 'user.email'),
            'tmp_email' => Yii::t('models', 'user.tmp_email'),
            'password' => Yii::t('models', 'user.password'),
            'activation_hash' => Yii::t('models', 'user.activation_hash'),
            'pass_created' => Yii::t('models', 'user.pass_created'),
            'date_of_birth' => Yii::t('models', 'user.date_of_birth'),
            'nationality' => Yii::t('models', 'user.nationality'),
            'mobile' => Yii::t('models', 'user.mobile'),
            'phone' => Yii::t('models', 'user.phone'),
            'phone_pin' => Yii::t('models', 'user.phone_pin'),
            'is_verified' => Yii::t('models', 'user.verified'),
            'status' => Yii::t('models', 'user.status'),
            'zendesk_id' => Yii::t('models', 'user.zendesk_id'),
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
        $criteria->compare('language_id', $this->language_id, true);
        $criteria->compare('gender', $this->gender, true);
        $criteria->compare('firstname', $this->firstname, true);
        $criteria->compare('lastname', $this->lastname, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('password', $this->password, true);
        $criteria->compare('activation_hash', $this->activation_hash, true);
        $criteria->compare('pass_created', $this->pass_created, true);
        $criteria->compare('date_of_birth', $this->date_of_birth, true);
        $criteria->compare('mobile', $this->mobile, true);
        $criteria->compare('phone', $this->phone, true);
        $criteria->compare('phone_pin', $this->phone_pin, true);
        $criteria->compare('is_verified', $this->is_verified);
        $criteria->compare('status', $this->status, true);
        $criteria->compare('zendesk_id', $this->zendesk_id, true);
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
