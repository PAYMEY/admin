<?php
/**
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

class AddressTest extends CDbTestCase
{
    public $fixtures=array(
        'accounts'=>'Account',
        'address'=>'Address',
        //'countries'=>'Country',
    );

    /**
     *
     */
    public function testCreateDeleteRestore()
    {
        $address = new Address;
        $address->setAttributes(
            array(
                'account_id' => '127350',
                'country_id' => '1',
                'street' => 'Das ist eine Straße',
                'street_number' => '149 b',
                'zip' => '73475',
                'city' => 'Tübingen',
                'is_default' => '1',
                //'type' => '1',
            ),
            false
        );

        $this->assertTrue($address->save(), 'Speichern fehlgeschlagen');
        $idDerNeuenAdresse = $address->id;
        $address = Address::model()->findByPk($address->id);
        $this->assertTrue($address instanceof Address, 'Adresse nicht geladen @ testCreateDeleteRestore()');

        //$countAddresses = Address::model()->countByAttributes(array('account_id'=>1, 'is_default'=>1));
        $countAddresses = Address::model()->count('account_id=127350 and is_default=1');
        // gibt es nur eine Standardadresse?
        $this->assertEquals(1, $countAddresses, 'Mehr als eine Standardadresse @ testCreateDeleteRestore()');
        // load address
        $address = Address::model()->findByPk($address->id);
        $this->assertInstanceOf('Address', $address, 'Adresse nicht geladen 1 @ testCreateDeleteRestore()');
        // Adresse ist bisher default, darf nicht loeschbar sein
        $this->assertFalse($address->delete(), 'Standardadresse geloescht! @ testCreateDeleteRestore()');
        // Default Adresse umsetzten
        $this->assertTrue(Address::setDefaultAddress(127350, $address->account_id),'Setzten der Standardadresse @ testCreateDeleteRestore()');
        // refresh, da is_default geaendert wurde
        $address->refresh();
        // nochmal loeschen
        $this->assertTrue($address->delete(), 'Loeschen fehlgeschlagen! @ testCreateDeleteRestore()');
        // deleted address wieder laden
        $address = Address::model()->deleted()->findByPk($idDerNeuenAdresse);
        // address richtig geladen?
        $this->assertInstanceOf('Address', $address, 'Adresse nicht geladen 2 @ testCreateDeleteRestore()');
        // Funktioniert das Restoren?
        $this->assertTrue($address->restore(), 'Restore fehlgeschlagen @ testCreateDeleteRestore()');
        // load address
        $address = Address::model()->default()->findByPk($idDerNeuenAdresse);
        $this->assertInstanceOf('Address', $address, 'Adresse nicht geladen 3 @ testCreateDeleteRestore()');

    }

    /**
     *
     */
    public function testAccountRelation()
    {
        // load address
        $address = Address::model()->findByPk(127350);
        $this->assertInstanceOf('Address', $address, 'Adresse nicht geladen @ testAccountRelation()');
        $this->assertEquals(127350, $address->account->id, 'Relation to account is wrong @ testAccountRelation()');

    }


}
