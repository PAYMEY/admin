<?php
/**
 * The followings are the available columns in table 'bank_accounts':
 * @property string $id
 * @property string $account_id
 * @property string $bank_name
 * @property string $bank_account
 * @property string $bank_code
 * @property string $iban
 * @property string $bic
 * @property integer $is_default
 * @property integer $is_verified
 * @property string $payon_ident
 * @property integer $is_deleted
 * @property string $created
 * @property string $created_by
 * @property string $modified
 * @property string $modified_by
 */
class BankAccountTest extends CDbTestCase
{
    public $fixtures=array(
        'accounts'=>'Account',
        'bank_accounts'=>'BankAccount',
    );

    /**
     *
     */
    public function testCreateDeleteRestore()
    {
        $bank = new BankAccount();
        $bank->setAttributes(
            array(
                'paymey_account_id' => '127350',
                'country_id' => '54',
                'bank_name' => 'Comerzbank',
                'bank_account' => '1987253',
                'bank_code' => '50040000',
                'iban' => 'DE18 3601 0043 9999 9999 99',
                'bic' => 'RZTIAT22263',
                'is_default' => 0
            ),
            false
        );

        $this->assertTrue($bank->save(), 'Speichern fehlgeschlagen @ testCreateDeleteRestore()');
        $newId = $bank->id;

        $bank = BankAccount::model()->findByPk($newId);
        $this->assertTrue($bank instanceof BankAccount, 'BankAccount nicht geladen @ testCreateDeleteRestore()');

        // loeschen
        $this->assertTrue($bank->delete(), 'Loeschen fehlgeschlagen! @ testCreateDeleteRestore()');
        // deleted BankAccount wieder laden
        $bank = BankAccount::model()->deleted()->findByPk($newId);
        // BankAccount richtig geladen?
        $this->assertInstanceOf('BankAccount', $bank, 'BankAccount nicht geladen 2 @ testCreateDeleteRestore()');
        // Funktioniert das Restoren?
        $this->assertTrue($bank->restore(), 'Restore fehlgeschlagen @ testCreateDeleteRestore()');
        // load BankAccount
        $bank = BankAccount::model()->default()->findByPk($newId);
        $this->assertInstanceOf('BankAccount', $bank, 'BankAccount nicht geladen 3 @ testCreateDeleteRestore()');

    }

    /**
     *
     */
    public function testDeleteDefaultBank()
    {
        $bank = BankAccount::model()->findByPk(1);
        $this->assertTrue($bank instanceof BankAccount, 'BankAccount nicht geladen @ testDeleteDefaultBank()');
        // loeschen
        $this->assertFalse($bank->delete(), 'Haut Bankverbindung geloescht! @ testDeleteDefaultBank()');

    }
}
