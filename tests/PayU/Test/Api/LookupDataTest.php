<?php
/**
 * Created by PhpStorm.
 * User: kenny
 * Date: 12/19/16
 * Time: 10:23 AM
 */

namespace PayU\Test\Api;

use PayUSdk\Api\LookupData;

class LookupDataTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Gets Object Instance with Json data filled in
     * @return LookupData
     */
    public static function getObject()
    {
        return new LookupData(self::getJson());
    }

    /**
     * Gets Json String of Object Address
     * @return string
     */
    public static function getJson()
    {
        return '{"entry":'. LookupDataEntryTest::getJson() . '}';
    }

    /**
     * Tests for Serialization and Deserialization Issues
     * @return LookupData
     */
    public function testSerializationDeserialization()
    {
        $obj = new LookupData(self::getJson());
        $this->assertNotNull($obj);
        $this->assertNotNull($obj->getEntry());
        $this->assertEquals(self::getJson(), $obj->toJson());
        return $obj;
    }

    /**
     * @depends testSerializationDeserialization
     * @param LookupData $obj
     */
    public function testGetters($obj)
    {
        $this->assertEquals($obj->getEntry(), LookupDataEntryTest::getObject());
    }
}
