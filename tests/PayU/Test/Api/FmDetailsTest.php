<?php
/**
 * Created by PhpStorm.
 * User: kenny
 * Date: 12/19/16
 * Time: 10:23 AM
 */

namespace PayU\Test\Api;

use PayUSdk\Api\FmDetails;

class FmDetailsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Gets Object Instance with Json data filled in
     * @return FmDetails
     */
    public static function getObject()
    {
        return new FmDetails(self::getJson());
    }

    /**
     * Gets Json String of Object Address
     * @return string
     */
    public static function getJson()
    {
        return '{"checkFraudOverride":"TestSample","merchantWebsite":"TestSample","pcFingerPrint":"TestSample","resultCode":"TestSample","resultMessage":"TestSample"}';
    }

    /**
     * Tests for Serialization and Deserialization Issues
     * @return FmDetails
     */
    public function testSerializationDeserialization()
    {
        $obj = new FmDetails(self::getJson());
        $this->assertNotNull($obj);
        $this->assertNotNull($obj->getCheckFraudOverride());
        $this->assertNotNull($obj->getMerchantWebsite());
        $this->assertNotNull($obj->getPCFingerPrint());
        $this->assertNotNull($obj->getResultCode());
        $this->assertNotNull($obj->getResultMessage());
        $this->assertEquals(self::getJson(), $obj->toJson());
        return $obj;
    }

    /**
     * @depends testSerializationDeserialization
     * @param FmDetails $obj
     */
    public function testGetters($obj)
    {
        $this->assertEquals($obj->getCheckFraudOverride(), "TestSample");
        $this->assertEquals($obj->getMerchantWebsite(), "TestSample");
        $this->assertEquals($obj->getPCFingerPrint(), "TestSample");
        $this->assertEquals($obj->getResultMessage(), "TestSample");
        $this->assertEquals($obj->getResultMessage(), "TestSample");
    }
}
