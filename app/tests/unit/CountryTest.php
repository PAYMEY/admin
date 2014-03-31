<?php
/**
 * The followings are the available columns in table 'countries':
 * @property string $id
 * @property string $currency_id
 * @property string $region_id
 * @property string $name
 * @property string $local_name
 * @property string $name_en
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
class CountryTest extends CDbTestCase
{
    /*
    public $fixtures=array(
        'countries'=>'Country',
        'regions'=>'Region',
    );
    */

    /**
     *

    public function testCreateDeleteRestore()
    {
        $country = new Country();
        $country->setAttributes(
            array(
                'currency_id' => '1',
                'region_id' => '0',
                'name' => 'United Arab Emirates',
                'local_name' => 'الإمارات العربيّة المتّحدة',
                'name_en' => 'United Arab Emirates',
                'iso_2' => 'AE',
                'iso_3' => 'ARE',
                'sorting' => 3
            ),
            false
        );

        $this->assertTrue($country->save(), 'Speichern fehlgeschlagen @ testCreateDeleteRestore()');
        $newId = $country->id;

        $country = Country::model()->findByPk($newId);
        $this->assertTrue($country instanceof Country, 'Country nicht geladen @ testCreateDeleteRestore()');

        // loeschen
        $this->assertTrue($country->delete(), 'Loeschen fehlgeschlagen! @ testCreateDeleteRestore()');
        // deleted Country wieder laden
        $country = Country::model()->deleted()->findByPk($newId);
        // Country richtig geladen?
        $this->assertInstanceOf('Country', $country, 'Country nicht geladen 2 @ testCreateDeleteRestore()');
        // Funktioniert das Restoren?
        $this->assertTrue($country->restore(), 'Restore fehlgeschlagen @ testCreateDeleteRestore()');
        // load Country
        $country = Country::model()->default()->findByPk($newId);
        $this->assertInstanceOf('Country', $country, 'Country nicht geladen 3 @ testCreateDeleteRestore()');

    }
    */
    /**
     *
     */
    public function testRegionRelation()
    {
        /*
        // load address
        $country = Country::model()->findByPk(54);
        $this->assertInstanceOf('Country', $country, 'Country nicht geladen @ testRegionRelation()');
        $this->assertInstanceOf('Region', $country->region, 'Keine Relation zu region @ testRegionRelation()');
        $this->assertEquals('Europa', $country->region->name, 'Relation to region is wrong @ testRegionRelation()');
        */
    }

}
