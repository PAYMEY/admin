<?php
/**
 * The followings are the available columns in table 'fees':
 * @property string $id
 * @property string $fee_group_id
 * @property string $region_id
 * @property string $type_id
 * @property string $currency_id
 * @property string $from
 * @property string $to
 * @property string $percent
 * @property string $amount
 * @property integer $is_deleted
 * @property string $created
 * @property string $created_by
 * @property string $modified
 * @property string $modified_by
 */
class FeeTest extends CDbTestCase
{
    public $fixtures=array(
        'fees'=>'Fee',
        'regions'=>'Region',
        'fee_groupss'=>'FeeGroup',
        'channels'=>'Channel',
    );

    /**
     *
     */
    public function testCreateDeleteRestore()
    {
        $fee = new Fee();
        $fee->setAttributes(
            array(
                'fee_group_id' => '1',
                'region_id' => '1',
                'channel_id' => '1',
                'currency_id' => '1',
                'from' => 750,
                'to' => 800,
                'percent' => 999,
                'amount' => 999,
            ),
            false
        );
        $this->assertTrue($fee->save(), 'Speichern fehlgeschlagen @ testCreateDeleteRestore()');
        $newId = $fee->id;
        $fee = Fee::model()->findByPk($newId);
        $this->assertTrue($fee instanceof Fee, 'Fee nicht geladen @ testCreateDeleteRestore()');
        // loeschen
        $this->assertTrue($fee->delete(), 'Loeschen fehlgeschlagen! @ testCreateDeleteRestore()');
        // deleted Device wieder laden
        $fee = Fee::model()->deleted()->findByPk($newId);
        // Device richtig geladen?
        $this->assertInstanceOf('Fee', $fee, 'Fee nicht geladen 2 @ testCreateDeleteRestore()');
        // Funktioniert das Restoren?
        $this->assertTrue($fee->restore(), 'Restore fehlgeschlagen @ testCreateDeleteRestore()');
        // load Device
        $fee = Fee::model()->default()->findByPk($newId);
        $this->assertInstanceOf('Fee', $fee, 'Fee nicht geladen 3 @ testCreateDeleteRestore()');

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

    /**
     *
     */
    public function testFeeGroup()
    {
        $feeGroup = FeeGroup::model()->findByPk(1);
        $this->assertInstanceOf('FeeGroup', $feeGroup, 'feeGroup nicht geladen 1 @ testFeeGroup()');

        $fee = $feeGroup->getFee(100000, 1, 1, 1);
        $this->assertInstanceOf('Fee', $fee, 'fee nicht geladen 1 @ testFeeGroup()');
        $this->assertEquals(3500, $fee->amount, 'Fee logik falsch 1 @ testFeeGroup()');

        $fee = $feeGroup->getFee(100000, 1, 2, 1);
        $this->assertInstanceOf('Fee', $fee, 'fee nicht geladen 2 @ testFeeGroup()');
        $this->assertEquals(3500, $fee->amount, 'Fee logik falsch 2 @ testFeeGroup()');

        $fee = $feeGroup->getFee(100000, 1, 2, 2);
        $this->assertInstanceOf('Fee', $fee, 'fee nicht geladen 3 @ testFeeGroup()');
        $this->assertEquals(3500, $fee->amount, 'Fee logik falsch 3 @ testFeeGroup()');

        $fee = $feeGroup->getFee(100000, 2, 2, 2);
        $this->assertInstanceOf('Fee', $fee, 'fee nicht geladen 4 @ testFeeGroup()');
        $this->assertEquals(3500, $fee->amount, 'Fee logik falsch 4 @ testFeeGroup()');

        $fee = $feeGroup->getFee(100000);
        $this->assertInstanceOf('Fee', $fee, 'fee nicht geladen 5 @ testFeeGroup()');
        $this->assertEquals(3500, $fee->amount, 'Fee logik falsch 5 @ testFeeGroup()');

    }

    /**
     *
     */
    public function testDefault()
    {
        $feeGroup = FeeGroup::getDefaultId(Country::DEFAULT_ID);
        $this->assertEquals(1, $feeGroup, 'Fee default logik falsch @ testDefault()');

    }
}
