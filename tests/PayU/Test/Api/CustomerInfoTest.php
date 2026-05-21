<?php
/**
 * Created by PhpStorm.
 * User: kenny
 * Date: 12/19/16
 * Time: 10:23 AM
 */

namespace PayU\Test\Api;

use PayU\Test\Api\Helper;

use PayUSdk\Model\CustomerInfo;

class CustomerInfoTest extends \PHPUnit\Framework\TestCase
{
    /**
     * Gets Object Instance with Json data filled in
     * @return CustomerInfo
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
        return new CustomerInfo(self::getData());
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
        $obj = new CustomerInfo(self::getData());
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
        $this->assertEquals(self::getObject(), $obj);
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
        $this->assertEquals($obj->getBillingAddress(), BillingAddressTest::getObject());
    }
}
