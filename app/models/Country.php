<?php

/**
 * This is the model class for table "countries".
 *
 * The followings are the available columns in table 'countries':
 * @property string $id
 * @property string $currency_id
 * @property string $region_id
 * @property string $name
 * @property string $local_name
 * @property string $name_en
 * @property string $name_de
 * @property string $iso_2
 * @property string $iso_3
 * @property string $sorting
 * @property string $is_eu_member
 * @property string $is_uno_member
 * @property string $is_visible
 * @property integer $is_deleted
 * @property string $created
 * @property string $created_by
 * @property string $modified
 * @property string $modified_by
 */
class Country extends CActiveRecordExtended
{

    const DEFAULT_ID = 54;

    /**
     *
     */
    public function findAllActiveCountries()
    {
        $attributes = array();
        $condition = 'region_id!=0';

        return $this->findAllByAttributes($attributes, $condition);
    }

    /*
     *
     */
    public function findByCountryCodeIso2($isoCode)
    {
        return $this->findByAttributes(array('iso_2'=>$isoCode));
    }

    /*
     *
     */
    public static function getListOfCountries($getInactive = false)
    {
        if ($getInactive) {
            $countries = Country::model()->findAll(array('order' => 'name_de'));
        } else {
            $countries = Country::model()->findAllActiveCountries(array('order' => 'name_de'));
        }
        $countryListData = CHtml::listData(
            $countries,
            'id',
            function ($countries) {
                return $countries->name_de . ' (' . $countries->local_name . ')';
            }
        );

        return $countryListData;
    }

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Country the static model class
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
        return 'countries';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('currency_id, region_id, name, local_name, name_en, iso_2, iso_3', 'required'),
            array('is_deleted', 'numerical', 'integerOnly'=>true),
            array('currency_id, region_id, sorting, is_eu_member, is_uno_member, is_visible, created, created_by, modified, modified_by', 'length', 'max'=>10),
            array('name, local_name, name_en, name_de, iso_2, iso_3', 'length', 'max'=>255),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, currency_id, region_id, name, local_name, name_en, name_de, iso_2, iso_3, sorting, is_eu_member, is_uno_member, is_visible, is_deleted, created, created_by, modified, modified_by', 'safe', 'on'=>'search'),
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
            'currency'=>array(self::BELONGS_TO, 'Currency', 'currency_id'),
            'region'=>array(self::BELONGS_TO, 'Region', 'region_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => Yii::t('models', 'country.id'),
            'currency_id' => Yii::t('models', 'related currency'),
            'region_id' => Yii::t('models', 'related region'),
            'name' => Yii::t('models', 'country.name'),
            'local_name' => Yii::t('models', 'country.local_name'),
            'name_en' => Yii::t('models', 'country.name_en'),
            'name_de' => Yii::t('models', 'country.name_de'),
            'iso_2' => Yii::t('models', 'country.iso_2'),
            'iso_3' => Yii::t('models', 'country.iso_3'),
            'sorting' => Yii::t('models', 'country.sorting'),
            'is_eu_member' => Yii::t('models', 'country.is_eu_member'),
            'is_uno_member' => Yii::t('models', 'country.is_uno_member'),
            'is_visible' => Yii::t('models', 'country.visible'),
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
        $criteria->compare('currency_id', $this->currency_id, true);
        $criteria->compare('region_id', $this->region_id, true);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('local_name', $this->local_name, true);
        $criteria->compare('name_en', $this->name_en, true);
        $criteria->compare('name_de', $this->name_de, true);
        $criteria->compare('iso_2', $this->iso_2, true);
        $criteria->compare('iso_3', $this->iso_3, true);
        $criteria->compare('sorting', $this->sorting, true);
        $criteria->compare('is_eu_member', $this->is_eu_member, true);
        $criteria->compare('is_uno_member', $this->is_uno_member, true);
        $criteria->compare('is_visible', $this->is_visible, true);
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

    /*


    public static function checkIsoCodes()
    {
        $file = '/var/www/paymey-webapp/isocodes.xml';
        if (file_exists($file)) {
            $xml = simplexml_load_file($file);
            $i=0;
            foreach ($xml as $key => $value) {
                if (get_class($value)=='SimpleXMLElement') {
                    $country = Country::model()->findByAttributes(array('iso_2' => $xml->{'ISO_3166-1_Entry'}[$i]->{'ISO_3166-1_Alpha-2_Code_element'}));
                    if ($country===null) {
                        echo $xml->{'ISO_3166-1_Entry'}[$i]->{'ISO_3166-1_Alpha-2_Code_element'};
                        echo '<span style="color:red;"> - Fehlt</span>  ';
                        echo $xml->{'ISO_3166-1_Entry'}[$i]->{'ISO_3166-1_Country_name'};
                        echo '<br>';
                    }
                }
                $i++;
            }
        } else {
            echo 'no file';
        }

        $file = '/var/www/paymey-webapp/staatentabelle.csv';
        // http://data.wien.gv.at/katalog/staatentabelle.html
        if (($handle = fopen($file, 'r')) !== false) {
            $i=0;
            while (($data = fgetcsv($handle, 1000, ',')) !== false) {
                // skip the first 3 rows
                $i++;
                if ($i < 4) {
                    continue;
                }
                //print_r($data);
                $data = explode(';', $data[0]);
                //echo $data[2].' '.$data[3].'<br>';

                // ISO_NUM;ISO_2;ISO_3;NAME_GER;NAME_GER_OFF;NAME_ENG;NAME_ENG_OFF;STATUS;ASSOCIATED;DOCUMENT;EU_MEMBER11;PART_OF_EU;CONTINENT;PREFIX;TLD;CAR_PLATE;DATE_OF_FORMATION;DATE_OF_RESOLUTION;EXIST_ADD
                //$data[2] == ISO_2
                //$data[4] == NAME_GER
                //$data[4] == NAME_GER_OFF
                //$data[11] == EU_MEMBER
                $country = Country::model()->findByAttributes(array('iso_3' => $data[2]));
                if ($country===null) {
                    // country gibts noch nicht
                    echo '<span style="color:red;">'.$data[2].' '.$data[3].'</span><br>';
                } else {
                    echo $data[2].' '.$data[3].'<br>';
                    if ($country->name == $data[6]) {
                        $country->name_de = $data[3];
                    } else {
                        echo '<span style="color:red;">'.$country->name.' == '.$data[6].'</span><br>';
                    }
                    if ($data[10]=='Y' && $country->is_is_eu_member==0) {
                        echo 'neu in der EU: '.$data[3].'<br>';
                        $country->is_is_eu_member = 1;
                    }
                    if (!$country->save()) {
                        print_r($country->getErrors());
                        exit;
                    }
                    flush();
                }

            }
            fclose($handle);
        } else {
            echo 'fopen fail';
        }
    }
    */

    /*


    public static function importFromWilhelm()
    {

        $link = mysql_connect('192.168.2.3', 'user', 'xxx') or die(mysql_error());
        echo 'Connected to MySQL<br />';
        mysql_select_db('chrvollr_feldpartitur') or die(mysql_error());
        echo 'Connected to Database';
        mysql_set_charset('utf8',$link);

        $sql = 'SELECT * FROM country ORDER BY sorting';
        $result = mysql_query($sql)
            or die(mysql_error());

        while ($row = mysql_fetch_array($result)) {
            //print_r($row);
            $country = new Country();
            $country->currency_id = 0;
            $country->region_id = 0;
            $country->name = $row['name'];
            $country->local_name = $row['localname'];
            $country->name_en = $row['name_en'];
            $country->name_de = '';
            $country->iso_2 = $row['iso_2'];
            $country->iso_3 = $row['iso_3'];
            $country->sorting = $row['sorting'];
            $country->is_eu_member = $row['eu_member'];
            $country->is_uno_member = $row['uno_member'];
            $country->is_visible = 1;
            echo $country->name.'<br>';
            if (!$country->save()) {
                print_r($country->getErrors());
                exit;
            }
        }
        mysql_close($link);
    }
     */
}
