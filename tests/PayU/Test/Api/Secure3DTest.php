<?php
/**
 * Created by PhpStorm.
 * User: kenny
 * Date: 12/19/16
 * Time: 10:23 AM
 */

namespace PayU\Test\Api;

use PayUSdk\Api\Secure3D;

class Secure3DTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Gets Object Instance with Json data filled in
     * @return Secure3D
     */
    public static function getObject()
    {
        return new Secure3D(self::getJson());
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
        $obj = new Secure3D(self::getJson());
        $this->assertNotNull($obj);
        $this->assertNotNull($obj->getSecure3DId());
        $this->assertNotNull($obj->getSecure3DUrl());
        $this->assertEquals(self::getJson(), $obj->toJson());
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
