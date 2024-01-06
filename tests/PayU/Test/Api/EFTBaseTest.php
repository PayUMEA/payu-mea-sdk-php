<?php
/**
 * Created by PhpStorm.
 * User: kenny
 * Date: 12/19/16
 * Time: 10:23 AM
 */

namespace PayU\Test\Api;

use PayUSdk\Api\EFTBase;

class EFTBaseTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Gets Object Instance with Json data filled in
     * @return EFTBase
     */
    public static function getObject()
    {
        return new EFTBase(self::getJson());
    }

    /**
     * Gets Json String of Object Address
     * @return string
     */
    public static function getJson()
    {
        return '{"amount":"TestSample","method":"TestSample","type":"TestSample","url":"TestSample","bankName":"TestSample"}';
    }

    /**
     * Tests for Serialization and Deserialization Issues
     * @return EFTBase
     */
    public function testSerializationDeserialization()
    {
        $obj = new EFTBase(self::getJson());
        $this->assertNotNull($obj);
        $this->assertNotNull($obj->getAmount());
        $this->assertNotNull($obj->getMethod());
        $this->assertNotNull($obj->getType());
        $this->assertNotNull($obj->getUrl());
        $this->assertNotNull($obj->getBankName());
        $this->assertEquals(self::getJson(), $obj->toJson());
        return $obj;
    }

    /**
     * @depends testSerializationDeserialization
     * @param EFTBase $obj
     */
    public function testGetters($obj)
    {
        $this->assertEquals($obj->getAmount(), "TestSample");
        $this->assertEquals($obj->getMethod(), "TestSample");
        $this->assertEquals($obj->getType(), "TestSample");
        $this->assertEquals($obj->getUrl(), "TestSample");
        $this->assertEquals($obj->getBankName(), "TestSample");
    }
}
