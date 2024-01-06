<?php
/**
 * Created by PhpStorm.
 * User: kenny
 * Date: 12/19/16
 * Time: 10:23 AM
 */

namespace PayU\Test\Api;

use PayUSdk\Api\CustomFields;

class CustomFieldsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Gets Object Instance with Json data filled in
     * @return CustomFields
     */
    public static function getObject()
    {
        return new CustomFields(self::getJson());
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
        $obj = new CustomFields(self::getJson());
        $this->assertNotNull($obj);
        $this->assertNotNull($obj->getKey());
        $this->assertNotNull($obj->getValue());
        $this->assertEquals(self::getJson(), $obj->toJson());
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
