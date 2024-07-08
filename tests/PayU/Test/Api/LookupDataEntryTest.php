<?php
/**
 * Created by PhpStorm.
 * User: kenny
 * Date: 12/19/16
 * Time: 10:23 AM
 */

namespace PayU\Test\Api;

use PayUSdk\Api\LookupDataEntry;

class LookupDataEntryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Gets Object Instance with Json data filled in
     * @return LookupDataEntry
     */
    public static function getObject()
    {
        return new LookupDataEntry(self::getJson());
    }

    /**
     * Gets Json String of Object Address
     * @return string
     */
    public static function getJson()
    {
        return '{"key":"TestSample","value":' . DetailsTest::getJson() . '}';
    }

    /**
     * Tests for Serialization and Deserialization Issues
     * @return LookupDataEntry
     */
    public function testSerializationDeserialization()
    {
        $obj = new LookupDataEntry(self::getJson());
        $this->assertNotNull($obj);
        $this->assertNotNull($obj->getKey());
        $this->assertNotNull($obj->getValue());
        $this->assertEquals(self::getJson(), $obj->toJson());
        return $obj;
    }

    /**
     * @depends testSerializationDeserialization
     * @param LookupDataEntry $obj
     */
    public function testGetters($obj)
    {
        $this->assertEquals($obj->getKey(), "TestSample");
        $this->assertEquals($obj->getValue(), DetailsTest::getObject());
    }
}
