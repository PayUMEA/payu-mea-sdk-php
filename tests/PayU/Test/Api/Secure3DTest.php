<?php
/**
 * Created by PhpStorm.
 * User: kenny
 * Date: 12/19/16
 * Time: 10:23 AM
 */

namespace PayU\Test\Api;

use PayU\Test\Api\Helper;

use PayUSdk\Model\Secure3D;

class Secure3DTest extends \PHPUnit\Framework\TestCase
{
    /**
     * Gets Object Instance with Json data filled in
     * @return Secure3D
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
        return new Secure3D(self::getData());
    }

    /**
     * Gets Json String of Object Address
     * @return string
     */
    public static function getJson()
    {
        return '{"secure3DId":"TestSample","secure3DUrl":"TestSample"}';
    }

    /**
     * Tests for Serialization and Deserialization Issues
     * @return Secure3D
     */
    public function testSerializationDeserialization()
    {
        $obj = new Secure3D(self::getData());
        $this->assertNotNull($obj);
        $this->assertNotNull($obj->getSecure3DId());
        $this->assertNotNull($obj->getSecure3DUrl());
        $this->assertEquals(self::getObject(), $obj);
        return $obj;
    }

    /**
     * @depends testSerializationDeserialization
     * @param Secure3D $obj
     */
    public function testGetters($obj)
    {
        $this->assertEquals($obj->getSecure3DId(), "TestSample");
        $this->assertEquals($obj->getSecure3DUrl(), "TestSample");
    }
}
