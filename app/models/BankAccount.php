<?php

/**
 * This is the model class for table "bank_accounts".
 *
 * The followings are the available columns in table 'bank_accounts':
 * @property string $id
 * @property string $paymey_account_id
 * @property string $country_id
 * @property string $bank_name
 * @property string $bank_account
 * @property string $bank_code
 * @property string $iban
 * @property string $bic
 * @property integer $is_default
 * @property integer $is_verified
 * @property string $payon_ident
 * @property string $payon_response_url
 * @property integer $is_deleted
 * @property string $created
 * @property string $created_by
 * @property string $modified
 * @property string $modified_by
 */
class BankAccount extends CActiveRecordExtended
{
    /**
     * Achtung: Der Standartwert ist invertiert zur parent Funktion!
     * Wenn rekursiv von der Parent Funktion aufgerufen wird ist deleteRelated=true => loeschen ohne check
     */
    public function delete($deleteRelated = false)
    {
        // wenn mit related aufgerufen wird, dann ist die Standardadresse egal
        // wenn ohne related aufgerufen wird muss auf Standardadresse ueberprueft werden

        if (!$deleteRelated && $this->is_default==1) {
            $this->addError('is_default', Yii::t('models', 'bankaccount.message-bank-account-cannot-be-deleted'));
            return false;
        }
        $return = parent::delete($deleteRelated);
        return $return;
    }

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return BankAccount the static model class
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
        return 'bank_accounts';
    }

    /**
     *
     */
    public function checkBankCode($bankCode, $countryId)
    {
        $bank = Bank::model()->findByBankCode($bankCode, $countryId);
        if ($bank === null) {
            return false;
        }
        return true;
    }

    /**
     *
     */
    public function checkBankCodeRule($attribute, $params)
    {
        // check nicht ausführen wenn scenario delete oder restore gesetzt!
        if ($this->scenario == 'delete' || $this->scenario == 'restore') {
            return;
        }

        // do not process check if star conversion is already done
        if (substr($this->bank_code, 0, 4) == '****') {
            return;
        }

        $bank = $this->checkBankCode($this->bank_code, $this->country_id);
        if (!$bank) {
            $this->addError(
                'bank_code',
                yii::t('errors', 'Bank code does not exist')
            );
        }
    }

    /**
     *
     */
    public function payOnRegistration($bankAccountData, $userData, $businessData = false)
    {
        $payonConnection = new PayOnApi();
        if ($payonConnection->simulationMode()) {
            // in simulation mode stop here
            return true;
        }

        // todo: activate payon channels when all channels are configured!
        /*
        if (is_array($businessData)
                && array_key_exists('payon_channel', $businessData)
                && array_key_exists('payon_sender', $businessData)
                && array_key_exists('payon_user', $businessData)
                && array_key_exists('payon_pass', $businessData)
                && array_key_exists('payon_secret', $businessData)) {
            $payonConnection->setChannel($businessData['payon_channel']);
            $payonConnection->setSender($businessData['payon_sender']);
            $payonConnection->setUser($businessData['payon_user']);
            $payonConnection->setUserPassword($businessData['payon_pass']);
            $payonConnection->setSecret($businessData['payon_secret']);
        }
        */

        // set in asynchroun mode for micro deposit
        $payonConnection->setResponse(PayOnApi::RESPONSE_ASYNC);

        $payOnReturnValues = $payonConnection->registration($bankAccountData, $userData);
        if ($payOnReturnValues['result']==false) {
            if ($payOnReturnValues['error']==null) {
                $this->addError(
                    'bank_account',
                    Yii::t('errors', 'Technical error in communication with the bank')
                );
            } elseif ($payOnReturnValues['error']!='') {
                $this->addError(
                    'bank_account',
                    Yii::t('payon', $payOnReturnValues['error'])
                );
            } else {
                $this->addError(
                    'bank_account',
                    Yii::t('errors', 'Undefined Error')
                );
            }
            return false;
        } else {
            // BankAccountIdent
            $this->payon_ident = $payOnReturnValues['BankAccountIdent'];
            //$this->iban = $payOnReturnValues['BankAccountIban'];
            //$this->bic = $payOnReturnValues['BankAccountBic'];
            if ($this->payon_ident != '') {
                // star conversion
                $this->bank_account = $this->replaceWithStars($this->bank_account);
                //$this->iban = $this->replaceWithStars($this->iban);
                //$this->bic = $this->replaceWithStars($this->bic);
                $this->bank_code = $this->replaceWithStars($this->bank_code);
            }
            // responseUrl
            $this->payon_response_url = $payOnReturnValues['RedirectUrl'];

        }
        // no model save here because of signup logic dependence
        return true;
    }

    /**
     *
     */
    public function payOnSendMicroDepositConfirmation($depositAmount)
    {
        $payonConnection = new PayOnApi();
        if ($payonConnection->simulationMode()) {
            // in simulation mode stop here
            return false;
        }
        $payOnReturnValues = $payonConnection->sendConfirmation($this->payon_response_url, $depositAmount);

        if ($payOnReturnValues['result'] == false) {
            if ($payOnReturnValues['error'] == null) {
                $this->addError(
                    'bank_account',
                    Yii::t('errors', 'Technical error in communication with the bank')
                );
            } elseif ($payOnReturnValues['error'] != '') {
                $this->addError(
                    'bank_account',
                    Yii::t('payon', $payOnReturnValues['error'])
                );
            } else {
                $this->addError(
                    'bank_account',
                    Yii::t('errors', 'Undefined Error')
                );
            }
            return false;
        } else {
            $this->payon_response_url = '';
            $this->is_verified = 1;
            $this->save();
        }
        return true;
    }

    /**
     * get money from customer
     */
    public function payOnDebit($identData, $paymentData, $userData, $businessData = false)
    {
        $payonConnection = new PayOnApi();
        if ($payonConnection->simulationMode()) {
            // in simulation mode stop here
            $simulationData = array(
                //'result' => 0,
                //'errorStatusCode' => 70,
                'result' => 1,
                'error' => null,
                'uniqueID' => 'ff11111111111111111111111',
                'shortID' => '1111.1111.1111',
                'shopperID' => null,
                'timestamp' => '2013-11-05 18:04:43',
                'descriptor' => '4053.4901.6226 Personal-reg '. $paymentData['usage'],
                'amount' => $paymentData['amount'],
            );
            return $simulationData;
        }

        // todo: activate payon channels when all channels are configured!
        /*
        if (is_array($businessData)
                && array_key_exists('payon_channel', $businessData)
                && array_key_exists('payon_sender', $businessData)
                && array_key_exists('payon_user', $businessData)
                && array_key_exists('payon_pass', $businessData)
                && array_key_exists('payon_secret', $businessData)
        ) {
            $payonConnection->setChannel($businessData['payon_channel']);
            $payonConnection->setSender($businessData['payon_sender']);
            $payonConnection->setUser($businessData['payon_user']);
            $payonConnection->setUserPassword($businessData['payon_pass']);
            $payonConnection->setSecret($businessData['payon_secret']);
        }
        */

        if ($this->payon_ident == null) {
            // TODO later: what todo when ident not set
            //throw new CHttpException(500, Yii::t('error', 'payOnDebit'), 100000);
            // Im beta-Test mit echten Bankdaten absenden!
            $bankAccountData = array(
                'holder' => $this->paymeyAccount->account->getAccountOwnerName(),
                'number' => $this->bank_account,
                'bankCode' => $this->bank_code,
                'country' => $this->country->iso_2,
            );
        } else {
            $bankAccountData = array(
                'registration' => $this->payon_ident,
            );
        }

        // do debit
        $payOnReturnValues = $payonConnection->debit($identData, $paymentData, $bankAccountData, $userData);

        if ($payOnReturnValues['result'] == false) {
            if ($payOnReturnValues['error'] == null) {
                $this->addError(
                    'bank_account',
                    Yii::t('errors', 'Technical error in communication with the bank')
                );
            } elseif ($payOnReturnValues['error'] != '') {
                $this->addError(
                    'bank_account',
                    Yii::t('payon', $payOnReturnValues['error'])
                );
            } else {
                $this->addError(
                    'bank_account',
                    Yii::t('errors', 'Undefined Error')
                );
            }
        }
        return $payOnReturnValues;
    }

    /*
     * send money to customer
     */
    public function payOnCreditTransfer($identData, $paymentData, $userData)
    {
        $payonConnection = new PayOnApi();
        if ($payonConnection->simulationMode()) {
            // in simulation mode stop here
            $simulationData = array(
                'result' => 1,
                'error' => null,
                'uniqueID' => 'ff11111111111111111111111',
                'shortID' => '1111.1111.1111',
                'timestamp' => '2013-11-05 18:04:43',
                'descriptor' => '4053.4901.6226 Personal-reg ' . $paymentData['usage'],
                'amount' => $paymentData['amount'],
            );
            return $simulationData;
        }

        if ($this->payon_ident == null) {
            // TODO later: what todo when ident not set
            //throw new CHttpException(500, Yii::t('error', 'payOnDebit'), 100000);
            // Im beta-Test mit echten Bankdaten absenden!
            $bankAccountData = array(
                'holder' => $this->paymeyAccount->account->getAccountOwnerName(),
                'number' => $this->bank_account,
                'bankCode' => $this->bank_code,
                'country' => $this->country->iso_2,
            );
        } else {
            $bankAccountData = array(
                'registration' => $this->payon_ident,
            );
        }

        // do credit
        $payOnReturnValues = $payonConnection->credit($identData, $paymentData, $bankAccountData, $userData);

        if ($payOnReturnValues['result'] == false) {
            if ($payOnReturnValues['error'] == null) {
                $this->addError(
                    'bank_account',
                    Yii::t('errors', 'Technical error in communication with the bank')
                );
            } elseif ($payOnReturnValues['error'] != '') {
                $this->addError(
                    'bank_account',
                    Yii::t('payon', $payOnReturnValues['error'])
                );
            } else {
                $this->addError(
                    'bank_account',
                    Yii::t('errors', 'Undefined Error')
                );
            }
        }
        return $payOnReturnValues;

    }

    /*
     *
     */
    private function replaceWithStars($string, $starCount = 4)
    {
        $strlen = strlen($string);
        // replace all except the last 4 characters in bank account
        $stars = '';
        for ($i = $starCount; $i < $strlen; $i++) {
            $stars .= '*';
        }
        $withStars = $stars . substr($string, $strlen - $starCount);
        return $withStars;
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('bank_code', 'checkBankCodeRule'),
            array('paymey_account_id, bank_name, bank_account, bank_code, country_id', 'required'),
            array('country_id, is_default, is_verified, is_deleted', 'numerical', 'integerOnly'=>true),
            array('paymey_account_id, bank_account, bank_code', 'length', 'max'=>11),
            array('bank_account', 'length', 'max' => 50),
            array('bank_name, iban, bic, payon_ident, payon_response_url', 'length', 'max'=>255),
            array('created, created_by, modified, modified_by', 'length', 'max'=>10),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, paymey_account_id, bank_name, bank_account, bank_code, iban, bic, is_default, is_verified, payon_ident, is_deleted, created, created_by, modified, modified_by', 'safe', 'on'=>'search'),

            array('bank_name, bank_account, bank_code, iban, bic', 'filter', 'filter' => array($obj=new CHtmlPurifier(), 'purify')),
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
            'paymeyAccount'=>array(self::BELONGS_TO, 'PaymeyAccount', 'paymey_account_id'),
            'country' => array(self::BELONGS_TO, 'Country', 'country_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => Yii::t('models', 'bankaccount.id'),
            'paymey_account_id' => Yii::t('models', 'related account'),
            'country_id' => Yii::t('models', 'related country'),
            'bank_name' => Yii::t('models', 'bankaccount.bank_name'),
            'bank_account' => Yii::t('models', 'bankaccount.account_number'),
            'bank_code' => Yii::t('models', 'bankaccount.bank_code'),
            'iban' => Yii::t('models', 'bankaccount.iban'),
            'bic' => Yii::t('models', 'bankaccount.bic'),
            'is_default' => Yii::t('models', 'bankaccount.default'),
            'is_verified' => Yii::t('models', 'bankaccount.verified'),
            'payon_ident' => Yii::t('models', 'bankaccount.payon_ident'),
            'payon_response_url' => Yii::t('models', 'bankaccount.payon_response_url'),
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
        $criteria->compare('paymey_account_id', $this->paymey_account_id, true);
        $criteria->compare('country_id', $this->country_id, true);
        $criteria->compare('bank_name', $this->bank_name, true);
        $criteria->compare('bank_account', $this->bank_account, true);
        $criteria->compare('bank_code', $this->bank_code, true);
        $criteria->compare('iban', $this->iban, true);
        $criteria->compare('bic', $this->bic, true);
        $criteria->compare('is_default', $this->is_default);
        $criteria->compare('is_verified', $this->is_verified);
        $criteria->compare('payon_ident', $this->payon_ident, true);
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
