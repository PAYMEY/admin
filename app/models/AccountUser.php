<?php

/**
 * This is the model class for table "account_users".
 *
 * The followings are the available columns in table 'account_users':
 * @property string $account_id
 * @property string $user_id
 * @property integer $has_full_access
 * @property string $is_deleted
 * @property string $created
 * @property string $created_by
 * @property string $modified
 * @property string $modified_by
 */
class AccountUser extends CActiveRecordExtended
{
    /**
     * Retrieve all instances of AccountUser from UserId
     */
    public function findByUserId($userId)
    {
        $model = $this->findAllByAttributes(array('user_id' => $userId));
        return $model;
    }

    /**
     * Retrieve instance of AccountUser from UserId
     */
    public function findByAccountIdAndUserId($accountId, $userId)
    {
        $model = $this->findByAttributes(array('account_id' => $accountId, 'user_id' => $userId));
        return $model;
    }

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return AccountUser the static model class
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
        return 'account_users';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('account_id, user_id', 'required'),
            array('has_full_access', 'numerical', 'integerOnly'=>true),
            array('account_id, user_id, is_deleted, created, created_by, modified, modified_by', 'length', 'max'=>10),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('account_id, user_id, has_full_access, is_deleted, created, created_by, modified, modified_by', 'safe', 'on'=>'search'),
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
            'account_id' => Yii::t('models', 'related account'),
            'user_id' => Yii::t('models', 'related user'),
            'has_full_access' => Yii::t('models', 'accountuser.has_full_access'),
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

        $criteria->compare('account_id', $this->account_id, true);
        $criteria->compare('user_id', $this->user_id, true);
        $criteria->compare('has_full_access', $this->has_full_access);
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