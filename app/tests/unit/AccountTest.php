<?php

class AccountTest extends CDbTestCase
{
    public $fixtures=array(
        'accounts'=>'Account',
        'address'=>'Address',
        'users'=>'User',
        'bank_accounts'=>'BankAccount',
        'businesses'=>'Business',
        'devices'=>'Device',
        'api_keys'=>'ApiKey',
    );

    /**
     *
     */
    public function testCreate()
    {
        $account = new Account;
        $account->setAttributes(
            array(
                'owner_id' => '1',
                'fee_group_id' => '1',
                'timezone_id' => '1',
            ),
            false
        );

        $this->assertTrue($account->save(), 'Speichern fehlgeschlagen');

        $account = Account::model()->findByPk($account->id);
        $this->assertTrue($account instanceof Account, 'Account nicht geladen @ testCreate()');
        $this->assertEquals(Account::STATUS_PENDING, $account->status, 'Status fehlerhaft');

    }



    /**
     *
     */
    public function testDelete()
    {
        $account = Account::model()->findByPk(127351);
        // Account richtig geladen?
        $this->assertTrue($account instanceof Account, 'Account nicht geladen @ testDelete()');

        $users = $account->users;
        $addresses = $account->addresses;
        // gibt es nur einen User zum Account?
        $this->assertEquals(1, count($users));
        // Hat der Account nur eine Adresse?
        $this->assertEquals(1, count($addresses));
        // Funktioniert das Löschen
        $this->assertTrue($account->delete(), 'Loeschen fehlgeschlagen @ testDelete()');

        // deleted account wieder laden
        $account = Account::model()->deleted()->findByPk(127351);
        // Account richtig geladen?
        $this->assertTrue($account instanceof Account, 'Geloeschter Account nicht geladen @ testDelete()');
        // ungeloeschte Users laden
        $users = $account->users;
        // Es duerfen keine ungeloeschten User da sein
        $this->assertEquals(0, count($users), 'User geladen obwohl keine da sein duerften @ testDelete()');

        // ungeloeschte Users laden
        $addresses = $account->addresses;
        // Es duerfen keine ungeloeschten User da sein
        $this->assertEquals(0, count($addresses), 'Adressen geladen obwohl keine da sein duerften @ testDelete()');

        // geloeschte User laden
        $users = $account->users_with_deleted;
        $addresses = $account->addresses_with_deleted;
        // Ist die Adresse mit gelöscht?
        $this->assertEquals(1, $addresses[0]->is_deleted, 'Adresse ist nach loeschen noch da @ testDelete()');
        // Ist der User mit gelöscht?
        $this->assertEquals(1, $users[0]->is_deleted, 'User ist nach loeschen noch da @ testDelete()');

        unset($users);
        unset($addresses);

    }


    /**
     *
     */
    public function testRestore()
    {
        $account = Account::model()->default()->findByPk(127351);
        // Account richtig geladen?
        $this->assertTrue($account instanceof Account, 'Account nicht geladen @ testRestore()');
        // Funktioniert das Löschen?
        $this->assertTrue($account->delete(), 'Loeschen fehlgeschlagen @ testRestore()');

        // deleted account wieder laden
        $account = Account::model()->deleted()->findByPk(127351);
        // Account richtig geladen?
        $this->assertTrue($account instanceof Account, 'Geloeschter Account nicht geladen @ testRestore()');

        // Funktioniert das Restoren?
        $this->assertTrue($account->restore(), 'Restore fehlgeschlagen @ testRestore()');

        $account = Account::model()->default()->findByPk(127351);
        // Account richtig geladen?
        $this->assertTrue($account instanceof Account, 'Account nicht geladen @ testRestore()');

        $users = $account->users;
        $addresses = $account->addresses;
        // gibt es nur einen User zum Account?
        $this->assertEquals(1, count($users), 'Anzahl der User passt nicht @ testRestore()');
        // Hat der Account nur eine Adresse?
        $this->assertEquals(1, count($addresses), 'Anzahl der Adressen passt nicht @ testRestore()');

    }

    /**
     *
     */
    public function testAddressRelation()
    {
        $account = Account::model()->findByPk(127350);
        $this->assertTrue($account instanceof Account, 'Account nicht geladen @ testAddressRelation()');
        $this->assertEquals(1, count($account->addresses), 'Anzahl der Adressen passt nicht @ testRestore()');
        $this->assertEquals('Nummer', $account->mainaddress->street_number, 'Mainaddress @ testRestore()');

    }

    /**
     *
     */
    public function testUserRelation()
    {
        $account = Account::model()->findByPk(127350);
        // relation testen
        $this->assertEquals(1, count($account->users), 'Keine Relation zu account @ testCreateDeleteRestore()');
    }

    /**
     *
     */
    public function testBankRelation()
    {
        $account = Account::model()->findByPk(127350);
        $paymeyAccount = $account->paymeyAccounts[0];
        $this->assertEquals(1, count($paymeyAccount->bankAccounts), 'Keine Relation zur Bank @ testBankRelation()');
        $this->assertEquals('Kreissparkasse', $paymeyAccount->bankAccounts[0]->bank_name, 'Keine Relation zur Bank @ testBankRelation()');
    }


    /**
     *

    public function testCurrencyRelation()
    {
        $account = Account::model()->findByPk(1);
        $this->assertInstanceOf('Currency', $account->currency, 'Keine Relation zu currency @ testLanguageRelation()');
        $this->assertEquals('EUR', $account->currency->iso_code, 'Keine Relation zu currency @ testLanguageRelation()');
    }*/

    /**
     *
     */
    public function testOwnerRelation()
    {
        $account = Account::model()->findByPk(127350);
        $this->assertInstanceOf('User', $account->owner, 'Keine Relation zu owner @ testLanguageRelation()');
        $this->assertEquals('Chris', $account->owner->firstname, 'Keine Relation zu owner @ testLanguageRelation()');
    }

    /**
     *
     */
    public function testBusinessRelation()
    {
        $account = Account::model()->findByPk(127350);
        $this->assertInstanceOf('Business', $account->business, 'Keine Relation zu Business @ testLanguageRelation()');
        $this->assertEquals('attentra GmbH', $account->business->business_name, 'Keine Relation zu Business @ testLanguageRelation()');
    }

    /**
     *
     */
    public function testDeviceRelation()
    {
        $account = Account::model()->findByPk(127350);
        $this->assertEquals(1, count($account->devices), 'Keine Relation zu devices @ testDeviceRelation()');
        $this->assertEquals('iPhone attentra', $account->devices[0]->name, 'Keine Relation zur devices @ testDeviceRelation()');
    }

    /**
     *
     */
    public function testApiKeyRelation()
    {
        $account = Account::model()->findByPk(127350);
        $this->assertEquals(1, count($account->apiKeys), 'Keine Relation zu apiKey @ testDeviceRelation()');
        $this->assertEquals('key', $account->apiKeys[0]->key_ident, 'Keine Relation zur apiKey @ testDeviceRelation()');
    }
}
