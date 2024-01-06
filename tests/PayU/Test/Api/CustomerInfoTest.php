<?php
/**
 * Created by PhpStorm.
 * User: kenny
 * Date: 12/19/16
 * Time: 10:23 AM
 */

namespace PayU\Test\Api;

use PayUSdk\Api\CustomerInfo;

class CustomerInfoTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Gets Object Instance with Json data filled in
     * @return CustomerInfo
     */
    public static function getObject()
    {
        return new CustomerInfo(self::getJson());
    }

    /**
     * Gets Json String of Object Address
     * @return string
     */
    public static function getJson()
    {
        return '{"email":"TestSample","accountNumber":"TestSample","firstName":"TestSample","lastName":"TestSample","customerId":"TestSample","phone":"TestSample","countryCode":"TestSample","countryOfResidence":"TestSample","billingAddress":' . AddressTest::getJson() . '}';
    }

    /**
     * Tests for Serialization and Deserialization Issues
     * @return CustomerInfo
     */
    public function testSerializationDeserialization()
    {
        $obj = new CustomerInfo(self::getJson());
        $this->assertNotNull($obj);
        $this->assertNotNull($obj->getEmail());
        $this->assertNotNull($obj->getAccountNumber());
        $this->assertNotNull($obj->getFirstName());
        $this->assertNotNull($obj->getLastName());
        $this->assertNotNull($obj->getCustomerId());
        $this->assertNotNull($obj->getPhone());
        $this->assertNotNull($obj->getCountryCode());
        $this->assertNotNull($obj->getCountryOfResidence());
        $this->assertNotNull($obj->getBillingAddress());
        $this->assertEquals(self::getJson(), $obj->toJson());
        return $obj;
    }

    /**
     * @depends testSerializationDeserialization
     * @param CustomerInfo $obj
     */
    public function testGetters($obj)
    {
        $this->assertEquals($obj->getEmail(), "TestSample");
        $this->assertEquals($obj->getAccountNumber(), "TestSample");
        $this->assertEquals($obj->getFirstName(), "TestSample");
        $this->assertEquals($obj->getLastName(), "TestSample");
        $this->assertEquals($obj->getCustomerId(), "TestSample");
        $this->assertEquals($obj->getPhone(), "TestSample");
        $this->assertEquals($obj->getCountryCode(), "TestSample");
        $this->assertEquals($obj->getCountryOfResidence(), "TestSample");
        $this->assertEquals($obj->getBillingAddress(), AddressTest::getObject());
    }
}
