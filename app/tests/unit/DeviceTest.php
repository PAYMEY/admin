<?php
/**
 * The followings are the available columns in table 'devices':
 * @property string $id
 * @property string $account_id
 * @property string $api_key_id
 * @property string $name
 * @property string $limit
 * @property string $uuid
 * @property integer $is_disabled
 * @property integer $is_deleted
 * @property string $created
 * @property string $created_by
 * @property string $modified
 * @property string $modified_by
 */
class DeviceTest extends CDbTestCase
{
    public $fixtures=array(
        'devices'=>'Device',
        'api_keys'=>'ApiKey',
        'accounts'=>'Account',
    );

    /**
     *
     */
    public function testCreateDeleteRestore()
    {
        $device = new Device();
        $device->setAttributes(
            array(
                'account_id' => '127350',
                'api_key_id' => '1',
                'name' => 'Mein neues Handy',
                'limit' => '100',
                'uuid' => 'UIDÜÖÄ$"%',
                'is_disabled' => 0
            ),
            false
        );

        $this->assertTrue($device->save(), 'Speichern fehlgeschlagen @ testCreateDeleteRestore()');
        $newId = $device->id;
        $device = Device::model()->findByPk($newId);
        $this->assertTrue($device instanceof Device, 'Device nicht geladen @ testCreateDeleteRestore()');
        // loeschen
        $this->assertTrue($device->delete(), 'Loeschen fehlgeschlagen! @ testCreateDeleteRestore()');
        // deleted Device wieder laden
        $device = Device::model()->deleted()->findByPk($newId);
        // Device richtig geladen?
        $this->assertInstanceOf('Device', $device, 'Device nicht geladen 2 @ testCreateDeleteRestore()');
        // Funktioniert das Restoren?
        $this->assertTrue($device->restore(), 'Restore fehlgeschlagen @ testCreateDeleteRestore()');
        // load Device
        $device = Device::model()->default()->findByPk($newId);
        $this->assertInstanceOf('Device', $device, 'Device nicht geladen 3 @ testCreateDeleteRestore()');

    }

    /**
     *
     */
    public function testRegionRelation()
    {
        // load address
        $fee = Fee::model()->findByPk(1);
        $this->assertInstanceOf('Fee', $fee, 'Fee nicht geladen @ testRegionRelation()');
        $this->assertInstanceOf('Region', $fee->region, 'Keine Relation zu region @ testRegionRelation()');
        $this->assertEquals('Europa', $fee->region->name, 'Relation to region is wrong @ testRegionRelation()');

    }

}
