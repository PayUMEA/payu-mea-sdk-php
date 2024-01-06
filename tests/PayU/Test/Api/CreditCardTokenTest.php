<?php
/**
 * Created by PhpStorm.
 * User: kenny
 * Date: 12/19/16
 * Time: 10:23 AM
 */

namespace PayU\Test\Api;

use PayUSdk\Api\CreditCardToken;

class CreditCardTokenTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Gets Object Instance with Json data filled in
     * @return CreditCardToken
     */
    public static function getObject()
    {
        return new CreditCardToken(self::getJson());
    }

    /**
     * Gets Json String of Object Address
     * @return string
     */
    public static function getJson()
    {
        return '{"creditCardId":"TestSample","last4":"TestSample","type":"TestSample","cvv2":"TestSample","expireMonth":"TestSample","expireYear":"TestSample"}';
    }

    /**
     * Tests for Serialization and Deserialization Issues
     * @return CreditCardToken
     */
    public function testSerializationDeserialization()
    {
        $obj = new CreditCardToken(self::getJson());
        $this->assertNotNull($obj);
        $this->assertNotNull($obj->getCreditCardId());
        $this->assertNotNull($obj->getLast4());
        $this->assertNotNull($obj->getType());
        $this->assertNotNull($obj->getCvv2());
        $this->assertNotNull($obj->getExpireMonth());
        $this->assertNotNull($obj->getExpireYear());
        $this->assertEquals(self::getJson(), $obj->toJson());
        return $obj;
    }

    /**
     * @depends testSerializationDeserialization
     * @param CreditCardToken $obj
     */
    public function testGetters($obj)
    {
        $this->assertEquals($obj->getCreditCardId(), "TestSample");
        $this->assertEquals($obj->getLast4(), "TestSample");
        $this->assertEquals($obj->getType(), "TestSample");
        $this->assertEquals($obj->getCvv2(), "TestSample");
        $this->assertEquals($obj->getExpireMonth(), "TestSample");
        $this->assertEquals($obj->getExpireYear(), "TestSample");
    }
}
