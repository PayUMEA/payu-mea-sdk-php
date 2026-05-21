<?php
/**
 * Created by PhpStorm.
 * User: kenny
 * Date: 12/19/16
 * Time: 10:23 AM
 */

namespace PayU\Test\Api;

use PayU\Test\Api\Helper;

use PayUSdk\Model\CustomFields;

class CustomFieldsTest extends \PHPUnit\Framework\TestCase
{
    /**
     * Gets Object Instance with Json data filled in
     * @return CustomFields
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
        return new CustomFields(self::getData());
    }

    /**
     * Gets Json String of Object Address
     * @return string
     */
    public static function getJson()
    {
        return '{"key":"TestSample","value":"TestSample"}';
    }

    /**
     * Tests for Serialization and Deserialization Issues
     * @return CustomFields
     */
    public function testSerializationDeserialization()
    {
        $obj = new CustomFields(self::getData());
        $this->assertNotNull($obj);
        $this->assertNotNull($obj->getKey());
        $this->assertNotNull($obj->getValue());
        $this->assertEquals(self::getObject(), $obj);
        return $obj;
    }

    /**
     * @depends testSerializationDeserialization
     * @param CustomFields $obj
     */
    public function testGetters($obj)
    {
        $this->assertEquals($obj->getKey(), "TestSample");
        $this->assertEquals($obj->getValue(), "TestSample");
    }
}
