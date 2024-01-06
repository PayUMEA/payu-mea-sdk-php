<?php
/**
 * Created by PhpStorm.
 * User: kenny
 * Date: 12/19/16
 * Time: 10:23 AM
 */

namespace PayU\Test\Api;

use PayUSdk\Api\PaymentMethod;

class PaymentMethodTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Gets Object Instance with Json data filled in
     * @return PaymentMethod
     */
    public static function getObject()
    {
        return new PaymentMethod(self::getJson());
    }

    /**
     * Gets Json String of Object Address
     * @return string
     */
    public static function getJson()
    {
        return '{"id":"TestSample","cardNumber":"TestSample","cardExpiry":"TestSample","cvv":"TestSample","information":"TestSample","amountInCents":"TestSample","nameOnCard":"TestSample","verified":"TestSample","description":"TestSample","pmId":"TestSample","defaultPM":"TestSample","reference":"TestSample","ebucksToken":"TestSample"}';
    }

    /**
     * Tests for Serialization and Deserialization Issues
     * @return PaymentMethod
     */
    public function testSerializationDeserialization()
    {
        $obj = new PaymentMethod(self::getJson());
        $this->assertNotNull($obj);
        $this->assertNotNull($obj->getId());
        $this->assertNotNull($obj->getCardNumber());
        $this->assertNotNull($obj->getCardExpiry());
        $this->assertNotNull($obj->getCvv());
        $this->assertNotNull($obj->getInformation());
        $this->assertNotNull($obj->getAmountInCents());
        $this->assertNotNull($obj->getNameOnCard());
        $this->assertNotNull($obj->getVerified());
        $this->assertNotNull($obj->getDescription());
        $this->assertNotNull($obj->getPmId());
        $this->assertNotNull($obj->getDefaultPM());
        $this->assertNotNull($obj->getReference());
        $this->assertNotNull($obj->getEbucksToken());
        $this->assertEquals(self::getJson(), $obj->toJson());
        return $obj;
    }

    /**
     * @depends testSerializationDeserialization
     * @param PaymentMethod $obj
     */
    public function testGetters($obj)
    {
        $this->assertEquals($obj->getId(), "TestSample");
        $this->assertEquals($obj->getCardNumber(), "TestSample");
        $this->assertEquals($obj->getCardExpiry(), "TestSample");
        $this->assertEquals($obj->getCvv(), "TestSample");
        $this->assertEquals($obj->getInformation(), "TestSample");
        $this->assertEquals($obj->getAmountInCents(), "TestSample");
        $this->assertEquals($obj->getNameOnCard(), "TestSample");
        $this->assertEquals($obj->getVerified(), "TestSample");
        $this->assertEquals($obj->getDescription(), "TestSample");
        $this->assertEquals($obj->getPmId(), "TestSample");
        $this->assertEquals($obj->getDefaultPM(), "TestSample");
        $this->assertEquals($obj->getReference(), "TestSample");
        $this->assertEquals($obj->getEbucksToken(), "TestSample");
    }
}
