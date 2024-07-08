<?php
/**
 * Created by PhpStorm.
 * User: kenny
 * Date: 12/19/16
 * Time: 12:18 PM
 */

namespace PayU\Test\Api;

use PayUSdk\Api\Amount;

class AmountTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Gets Object Instance with Json data filled in
     * @return Amount
     */
    public static function getObject()
    {
        return new Amount(self::getJson());
    }

    /**
     * Gets Json String of Object Amount
     * @return string
     */
    public static function getJson()
    {
        return '{"currency":"TestSample","total":"12.34","details":' . DetailsTest::getJson() . '}';
    }

    /**
     * Tests for Serialization and Deserialization Issues
     * @return Amount
     */
    public function testSerializationDeserialization()
    {
        $obj = new Amount(self::getJson());
        $this->assertNotNull($obj);
        $this->assertNotNull($obj->getCurrency());
        $this->assertNotNull($obj->getTotal());
        $this->assertNotNull($obj->getDetails());
        $this->assertEquals(self::getJson(), $obj->toJson());
        return $obj;
    }

    /**
     * @depends testSerializationDeserialization
     * @param Amount $obj
     */
    public function testGetters($obj)
    {
        $this->assertEquals($obj->getCurrency(), "TestSample");
        $this->assertEquals($obj->getTotal(), "12.34");
        $this->assertEquals($obj->getDetails(), DetailsTest::getObject());
    }
}
