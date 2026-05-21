<?php
/**
 * Created by PhpStorm.
 * User: kenny
 * Date: 12/19/16
 * Time: 10:23 AM
 */

namespace PayU\Test\Api;

use PayU\Test\Api\Helper;

use PayUSdk\Model\LookupData;

class LookupDataTest extends \PHPUnit\Framework\TestCase
{
    /**
     * Gets Object Instance with Json data filled in
     * @return LookupData
     */
        /**
     * Gets array data representation of the object
     * @return array
     */
    public static function getData()
    {
        return Helper::hydrateData(json_decode(self::getJson(), true));
    }

    public static function getObject()
    {
        return new LookupData(self::getData());
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
        $obj = new LookupData(self::getData());
        $this->assertNotNull($obj);
        $this->assertNotNull($obj->getEntry());
        $this->assertEquals(self::getObject(), $obj);
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
