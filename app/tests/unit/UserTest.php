<?php
/**
 * The followings are the available columns in table 'users':
 * @property string $id
 * @property string $language_id
 * @property string $gender
 * @property string $firstname
 * @property string $lastname
 * @property string $email
 * @property string $password
 * @property string $hash
 * @property string $pass_created
 * @property string $date_of_birth
 * @property string $mobile
 * @property string $phone
 * @property integer $is_verified
 * @property integer $status
 * @property string $is_deleted
 * @property string $created
 * @property string $created_by
 * @property string $modified
 * @property string $modified_by
 */

class UserTest extends CDbTestCase
{
    public $fixtures=array(
        'accounts'=>'Account',
        'users'=>'User',
        'languages'=>'Language',
        'affiliate_history' => 'AffiliateHistory',
    );

    /**
     *
     */
    public function testCreateDeleteRestore()
    {
        $user = new User();
        $user->setAttributes(
            array(
                'account_id' => '127350',
                'language_id' => '1',
                'gender' => '1',
                'firstname' => 'Vorname äöü',
                'lastname' => 'Nachname',
                'email' => 'info@attentra.de',
                'date_of_birth' => '17.09.1968',
                'nationality' => 1,
                'mobile' => '+49115/46458-0',
                'phone' => '+49115/46458-0'
            ),
            false
        );

        $user->setPassword('testpass');
        $user->phone_pin = $user->createSupportPasswort();

        $this->assertTrue($user->save(), 'Speichern fehlgeschlagen @ testCreateDeleteRestore()');
        $newId = $user->id;

        $user = User::model()->findByPk($newId);
        $this->assertTrue($user instanceof User, 'User nicht geladen @ testCreateDeleteRestore()');
        // password check
        $this->assertTrue($user->checkPassword('testpass'), 'Pass Check false @ testCreateDeleteRestore()');
        // loeschen
        $this->assertTrue($user->delete(), 'Loeschen fehlgeschlagen! @ testCreateDeleteRestore()');
        // deleted user wieder laden
        $user = User::model()->deleted()->findByPk($newId);
        // user richtig geladen?
        $this->assertInstanceOf('User', $user, 'User nicht geladen 2 @ testCreateDeleteRestore()');
        // Funktioniert das Restoren?
        $this->assertTrue($user->restore(), 'Restore fehlgeschlagen @ testCreateDeleteRestore()');
        // load user
        $user = User::model()->default()->findByPk($newId);
        $this->assertInstanceOf('User', $user, 'User nicht geladen 3 @ testCreateDeleteRestore()');

        // uniqueLogin check. Nochmal User anlegen mit gleicher Mail-Adresse
        $user = new User();
        $user->setAttributes(
            array(
                'account_id' => '127350',
                'language_id' => '1',
                'gender' => '1',
                'firstname' => 'Vorname2',
                'lastname' => 'Nachname2',
                'email' => 'info@attentra.de',
                'date_of_birth' => '17.09.1988',
                'nationality' => 1,
                'mobile' => '+49115/46458-0',
                'phone' => '+49115/46458-0'
            ),
            false
        );
        $user->setPassword('testpass2');
        $this->assertFalse($user->validate(), 'Validate sollte fehlschlagen @ testCreateDeleteRestore()');
        $errors = $user->getErrors();
        $this->assertTrue(
            array_key_exists('email', $errors),
            'User mit gleicher E-Mail konnte angelegt werden! @ testCreateDeleteRestore()'
        );

    }


    /**
     *
     */
    public function testPasswordFunction()
    {
        $user = new User();
        $user->setPassword('äöü');
        // password check
        $this->assertTrue($user->checkPassword('äöü'), 'Pass Check false @ testPasswordFunction()');
        $user->setPassword('testpass');
        $pass1 = $user->password;
        $user->setPassword('testpass');
        $pass2 = $user->password;
        $this->assertNotSame($pass1, $pass2, 'Passwords cant be the same! @ testPasswordFunction()');
    }


    /**
     *
     */
    public function testEmailCheck()
    {
        $user = new User();
        $user->setPassword('äöü');
        $user->setAttributes(
            array(
                'account_id' => '127350',
                'language_id' => '1',
                'gender' => '1',
                'firstname' => 'Vorname2',
                'lastname' => 'Nachname2',
                'email' => 'keine@mailadresse',
                'date_of_birth' => '17.09.1999',
                'nationality' => 1,
                'mobile' => '+49115/46458-0',
                'phone' => '+49115/46458-0'
            ),
            false
        );

        $this->assertFalse($user->validate(), 'Validate sollte fehlschlagen @ testEmailCheck()');
        $errors = $user->getErrors();
        $this->assertTrue(
            array_key_exists('email', $errors),
            'E-Mail Address validation fehlgeschlagen! @ testEmailCheck()'
        );
    }

    /**
     *
     */
    public function testAccountCheck()
    {
        $user = new User();
        $user->setPassword('asdfasdf');
        $user->setAttributes(
            array(
                //'account_id' => '1',
                'language_id' => '1',
                'gender' => '1',
                'firstname' => 'Vorname2',
                'lastname' => 'Nachname2',
                'email' => 'keine@mailadresse.de',
                'date_of_birth' => '17.09.1999',
                'nationality' => 1,
                'mobile' => '+49115/46458-0',
                'phone' => '+49115/46458-0'
            ),
            false
        );

        $this->assertFalse($user->validate(), 'Validate sollte fehlschlagen @ testAccountCheck()');
        $errors = $user->getErrors();
        $this->assertTrue(
            array_key_exists('account_id', $errors),
            'Account validation fehlgeschlagen! @ testAccountCheck()'.print_r($errors, true)
        );
    }

    /**
     *
     */
    public function testLanguageRelation()
    {
        $user = User::model()->findByPk(127350);
        $this->assertInstanceOf('Language', $user->language, 'Keine Relation zu language @ testLanguageRelation()');
        $this->assertEquals('de', $user->language->iso_code, 'Keine Relation zu language @ testLanguageRelation()');
    }
}
