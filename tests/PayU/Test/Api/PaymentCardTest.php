<?php
/**
 * Created by PhpStorm.
 * User: kenny
 * Date: 12/19/16
 * Time: 10:23 AM
 */

namespace PayU\Test\Api;

use PayUSdk\Api\PaymentCard;

class PaymentCardTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Gets Object Instance with Json data filled in
     * @return PaymentCard
     */
    public static function getObject()
    {
        return new PaymentCard(self::getJson());
    }

    /**
     * Gets Json String of Object Address
     * @return string
     */
    public static function getJson()
    {
        return '{"id":"TestSample","number":"TestSample","type":"TestSample","expireMonth":"TestSample","expireYear":"TestSample","startMonth":"TestSample","startYear":"TestSample","cvv2":"TestSample","firstName":"TestSample","lastName":"TestSample","billingCountry":"TestSample","billingAddress":' . BillingAddressTest::getJson() . ',"status":"TestSample","issueNumber":"TestSample","showBudget":"TestSample","secure3D":"TestSample"}';
    }

    /**
     * Tests for Serialization and Deserialization Issues
     * @return PaymentCard
     */
    public function testSerializationDeserialization()
    {
        $obj = new PaymentCard(self::getJson());
        $this->assertNotNull($obj);
        $this->assertNotNull($obj->getId());
        $this->assertNotNull($obj->getNumber());
        $this->assertNotNull($obj->getType());
        $this->assertNotNull($obj->getExpireMonth());
        $this->assertNotNull($obj->getExpireYear());
        $this->assertNotNull($obj->getStartMonth());
        $this->assertNotNull($obj->getStartYear());
        $this->assertNotNull($obj->getCvv2());
        $this->assertNotNull($obj->getFirstName());
        $this->assertNotNull($obj->getLastName());
        $this->assertNotNull($obj->getBillingCountry());
        $this->assertNotNull($obj->getBillingAddress());
        $this->assertNotNull($obj->getStatus());
        $this->assertNotNull($obj->getIssueNumber());
        $this->assertNotNull($obj->getShowBudget());
        $this->assertNotNull($obj->getSecure3D());
        $this->assertEquals(self::getJson(), $obj->toJson());
        return $obj;
    }

    /**
     * @depends testSerializationDeserialization
     * @param PaymentCard $obj
     */
    public function testGetters($obj)
    {
        $this->assertEquals($obj->getId(), "TestSample");
        $this->assertEquals($obj->getNumber(), "TestSample");
        $this->assertEquals($obj->getType(), "TestSample");
        $this->assertEquals($obj->getExpireMonth(), "TestSample");
        $this->assertEquals($obj->getExpireYear(), "TestSample");
        $this->assertEquals($obj->getStartMonth(), "TestSample");
        $this->assertEquals($obj->getStartYear(), "TestSample");
        $this->assertEquals($obj->getCvv2(), "TestSample");
        $this->assertEquals($obj->getFirstName(), "TestSample");
        $this->assertEquals($obj->getLastName(), "TestSample");
        $this->assertEquals($obj->getBillingCountry(), "TestSample");
        $this->assertEquals($obj->getBillingAddress(), BillingAddressTest::getObject());
        $this->assertEquals($obj->getStatus(), "TestSample");
        $this->assertEquals($obj->getIssueNumber(), "TestSample");
        $this->assertEquals($obj->getShowBudget(), "TestSample");
        $this->assertEquals($obj->getSecure3D(), "TestSample");
    }
}
