<?php

/**
 * This is the model class for table "admin_users".
 *
 * The followings are the available columns in table 'admin_users':
 * @property string $id
 * @property string $email
 * @property string $password
 * @property string $name
 * @property integer $status
 * @property integer $login_attempts
 * @property string $locked_until
 * @property string $pass_created
 * @property integer $is_deleted
 * @property string $created
 * @property string $created_by
 * @property string $modified
 * @property string $modified_by
 */
class AdminUser extends CActiveRecordExtended
{

    const STATUS_LOCK = -2;
    const STATUS_ERROR = -1;
    const STATUS_PENDING = 0;
    const STATUS_APPROVED = 1;

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
     * Hash Passwort and salt together
     * @param $pass Password in Plaintext
     * @return string
     */
    private function hashPassword($pass)
    {
        return CPasswordHelper::hashPassword($pass);
    }

    /**
     * set password in AR
     * @param $pass Password in Plaintext
     * @return bool
     */
    public function setPassword($pass)
    {
        $this->password = $this->hashPassword($pass);
        $this->pass_created = time();
        return true;
    }

    /**
     *
     */
    public function uniqueLogin($attribute, $params)
    {
        if ($this->getIsNewRecord()) {
            $model = $this->findByAttributes(array('email' => $this->email));
            if ($model != null) {
                $this->addError(
                    'email',
                    yii::t('errors', 'Es existiert bereits ein Benutzer mit dieser E-Mail Adresse')
                );
            }
        }
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'admin_users';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('email, password', 'required'),
            array('email', 'uniqueLogin'),
            array('email', 'email'),
            array('status, login_attempts, pass_created, is_deleted', 'numerical', 'integerOnly'=>true),
            array('password, name, email', 'length', 'max'=>255),
            array('locked_until, created, created_by, modified, modified_by', 'length', 'max'=>10),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, password, name, email, status, login_attempts, locked_until, is_deleted, created, created_by, modified, modified_by', 'safe', 'on'=>'search'),
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
            'id' => Yii::t('models', 'ID'),
            'email' => Yii::t('models', 'Email'),
            'password' => Yii::t('models', 'Password'),
            'name' => Yii::t('models', 'Name'),
            'status' => Yii::t('models', 'Status'),
            'login_attempts' => Yii::t('models', 'Login Attempts'),
            'locked_until' => Yii::t('models', 'Locked Until'),
            'pass_created' => Yii::t('models', 'Pass created'),
            'is_deleted' => Yii::t('models', 'Is Deleted'),
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

        $criteria->compare('id', $this->id, true);
        $criteria->compare('password', $this->password, true);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('status', $this->status);
        $criteria->compare('login_attempts', $this->login_attempts);
        $criteria->compare('locked_until', $this->locked_until, true);
        $criteria->compare('is_deleted', $this->is_deleted);
        $criteria->compare('created', $this->created, true);
        $criteria->compare('created_by', $this->created_by, true);
        $criteria->compare('modified', $this->modified, true);
        $criteria->compare('modified_by', $this->modified_by, true);

        return new CActiveDataProvider(
            $this,
            array(
                'criteria'=>$criteria,
            )
        );
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return AdminUser the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }
}
