<?php

/**
 * This is the model class for table "banks".
 *
 * The followings are the available columns in table 'banks':
 * @property string $id
 * @property integer $country_id
 * @property integer is_master
 * @property string $bic
 * @property string $national_bank_code
 * @property string $name
 * @property string $short_name
 * @property string $city
 * @property integer $is_deleted
 * @property string $created
 * @property string $created_by
 * @property string $modified
 * @property string $modified_by
 */
class Bank extends CActiveRecordExtended
{

    /**
     *
     */
    public function findByBankCode($bankCode, $countryId)
    {
        return $this->findByAttributes(
            array('national_bank_code'=> $bankCode, 'country_id' => $countryId),
            'is_master = 1'
        );
    }

    /**
     *
     */
    public function findAllByBankCode($bankCode, $countryId)
    {
        return $this->findAllByAttributes(array('national_bank_code' => $bankCode, 'country_id' => $countryId));
    }

    /**
     *
     */
    public static function importGermanBlz($filePath)
    {
        if (($handle = fopen($filePath, 'r')) !== false) {
            $i = 0;
            while ($bankinfo = fgets($handle, 1024)) {
                $i++;
                // http://www.bundesbank.de/Redaktion/DE/Downloads/Kerngeschaeftsfelder/Unbarer_Zahlungsverkehr/Bankleitzahlen/merkblatt_bankleitzahlendatei_062013.pdf?__blob=publicationFile
                $bank = array();
                $bank['blz'] = trim(mb_substr($bankinfo, 0, 8, 'UTF-8'));
                $bank['mainBank'] = trim(mb_substr($bankinfo, 8, 1, 'UTF-8'));
                $bank['name'] = trim(mb_substr($bankinfo, 9, 58, 'UTF-8'));
                $bank['plz'] = trim(mb_substr($bankinfo, 67, 5, 'UTF-8'));
                $bank['city'] = trim(mb_substr($bankinfo, 72, 35, 'UTF-8'));
                $bank['short_name'] = trim(mb_substr($bankinfo, 107, 27, 'UTF-8'));
                //$bank['pan'] = trim(mb_substr($bankinfo, 134, 5, 'UTF-8'));
                $bank['bic'] = trim(mb_substr($bankinfo, 139, 11, 'UTF-8'));
                //$bank['pruefziffer'] = trim(mb_substr($bankinfo, 150, 2, 'UTF-8'));
                //$bank['datensatznummer'] = trim(mb_substr($bankinfo, 152, 6, 'UTF-8'));
                //$bank['change'] = trim(mb_substr($bankinfo, 158, 1, 'UTF-8'));
                //$bank['deleteHinweis'] = trim(mb_substr($bankinfo, 159, 1, 'UTF-8'));
                //$bank['nachfolgeBlz'] = trim(mb_substr($bankinfo, 160, 8, 'UTF-8'));
                //$bank['IbanRegel'] = trim(mb_substr($bankinfo, 158, 1, 'UTF-8'));


                $bankModel = new Bank();
                $bankModel->country_id = 54; // Germany
                if ($bank['mainBank']==1) {
                    $bankModel->is_master = 1;
                    $masterBlz = $bank['blz'];
                    $masterBic = $bank['bic'];
                }
                if ($bank['bic'] == '') {
                    $bank['bic'] = $masterBic;
                }
                $bankModel->bic = $bank['bic'];
                $bankModel->national_bank_code = $bank['blz'];
                $bankModel->name = $bank['name'];
                $bankModel->short_name = $bank['short_name'];
                $bankModel->city = $bank['city'];

                if (!$bankModel->save()) {
                    print_r($bankModel->getErrors());
                    exit;
                }
                unset($bankModel);
                unset($bankinfo);
                /*
                if ($i>100) {
                    break;
                }
                */
            }
            fclose($handle);
        } else {
            echo 'fopen fail';
        }
    }

    /**
     *
     */
    public static function importAustriaBlz($filePath)
    {
        if (($handle = fopen($filePath, 'r')) !== false) {
            $i = 0;
            while ($bankinfo = fgets($handle, 1024)) {
                // http://www.oenb.at/idakilz/kiverzeichnis?action=toDownloadPage
                // skip the first 3 rows
                $i++;
                if ($i < 7) {
                    continue;
                }
                $bank = str_getcsv($bankinfo, ';', '"');
                $bankModel = new Bank();
                $bankModel->country_id = 13; // Austria
                if ($bank[0] == 'Hauptanstalt') {
                    $bankModel->is_master = 1;
                    $masterBlz = $bank[2];
                    $masterBic = $bank[19];
                }
                if ($bank[19]=='') {
                    $bank[19] = $masterBic;
                }
                $bankModel->bic = $bank[19];
                $bankModel->national_bank_code = $bank[2];
                $bankModel->name = $bank[6];
                $bankModel->short_name = $bank[6];
                $bankModel->city = $bank[9];

                if (!$bankModel->save()) {
                    print_r($bankModel->getErrors());
                    exit;
                }
                unset($bank);
                unset($bankModel);
                unset($bankinfo);
            }
            fclose($handle);
        } else {
            echo 'fopen fail';
        }
    }

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Bank the static model class
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
        return 'banks';
    }

    /**
     *
     */
    public function bicOrBLZ($attribute, $params)
    {
        if ($this->bic == '' && $this->national_bank_code == '') {
            $this->addError(
                'bic',
                yii::t('errors', 'bic or nationalbankcode must be set.')
            );
        }
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('country_id, name', 'required'),
            array('bic', 'bicOrBLZ'),
            array('country_id, is_deleted, is_master', 'numerical', 'integerOnly'=>true),
            array('bic, national_bank_code, name, short_name, city', 'length', 'max'=>255),
            array('created, created_by, modified, modified_by', 'length', 'max'=>10),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, country_id, bic, national_bank_code, name, short_name, city, is_deleted, created, created_by, modified, modified_by', 'safe', 'on'=>'search'),
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
            'country'=>array(self::BELONGS_TO, 'Country', 'country_id')
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => Yii::t('models', 'bank.id'),
            'country_id' => Yii::t('models', 'related country'),
            'is_master' => Yii::t('models', 'bank.master'),
            'bic' => Yii::t('models', 'bank.BIC'),
            'national_bank_code' => Yii::t('models', 'bank.national_bank_code'),
            'name' => Yii::t('models', 'bank.name'),
            'short_name' => Yii::t('models', 'bank.short_name'),
            'city' => Yii::t('models', 'bank.city'),
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
        $criteria->compare('country_id', $this->country_id);
        $criteria->compare('is_master', $this->is_master);
        $criteria->compare('bic', $this->bic, true);
        $criteria->compare('national_bank_code', $this->national_bank_code, true);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('short_name', $this->short_name, true);
        $criteria->compare('city', $this->city, true);
        $criteria->compare('is_deleted', $this->is_deleted);
        $criteria->compare('created', $this->created, true);
        $criteria->compare('created_by', $this->created_by, true);
        $criteria->compare('modified', $this->modified, true);
        $criteria->compare('modified_by', $this->modified_by, true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
}
