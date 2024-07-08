<?php
/**
 * Created by PhpStorm.
 * User: kenny
 * Date: 12/19/16
 * Time: 10:23 AM
 */

namespace PayU\Test\Api;

use PayUSdk\Api\Customer;

class CustomerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Gets Object Instance with Json data filled in
     * @return Customer
     */
    public static function getObject()
    {
        return new Customer(self::getJson());
    }

    /**
     * Gets Json String of Object Address
     * @return string
     */
    public static function getJson()
    {
        return '{"ipAddress":"TestSample","paymentMethod":"TestSample","fundingInstrument":' . FundingInstrumentTest::getJson()  . ',"customerInfo":' . CustomerInfoTest::getJson() . '}';
    }

    /**
     * Tests for Serialization and Deserialization Issues
     * @return Customer
     */
    public function testSerializationDeserialization()
    {
        $obj = new Customer(self::getJson());
        $this->assertNotNull($obj);
        $this->assertNotNull($obj->getIPAddress());
        $this->assertNotNull($obj->getPaymentMethod());
        $this->assertNotNull($obj->getFundingInstrument());
        $this->assertNotNull($obj->getCustomerInfo());
        $this->assertEquals(self::getJson(), $obj->toJson());
        return $obj;
    }

    /**
     * @depends testSerializationDeserialization
     * @param Customer $obj
     */
    public function testGetters($obj)
    {
        $this->assertEquals($obj->getIPAddress(), "TestSample");
        $this->assertEquals($obj->getPaymentMethod(), "TestSample");
        $this->assertEquals($obj->getFundingInstrument(), FundingInstrumentTest::getObject());
        $this->assertEquals($obj->getCustomerInfo(), CustomerInfoTest::getObject());
    }
}
