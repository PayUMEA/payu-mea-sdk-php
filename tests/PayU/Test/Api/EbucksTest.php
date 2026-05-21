<?php
/**
 * Created by PhpStorm.
 * User: kenny
 * Date: 12/19/16
 * Time: 10:23 AM
 */

namespace PayU\Test\Api;

use PayU\Test\Api\Helper;

use PayUSdk\Model\Ebucks;

class EbucksTest extends \PHPUnit\Framework\TestCase
{
    /**
     * Gets Object Instance with Json data filled in
     * @return Ebucks
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
        return new Ebucks(self::getData());
    }

    /**
     * Gets Json String of Object Ebucks
     * @return string
     */
    public static function getJson()
    {
        return '{"action":"TestSample","authenticateAccountType":"TestSample","ebucksMemberIdentifier":"TestSample","ebucksPin":"TestSample","generateOTPType":"TestSample","ebucksAmount":"TestSample","resetPasswordType":"TestSample","validateOTPType":"TestSample","ebucksOtp":"TestSample","ebucksAccountNumber":"TestSample","ebucksDestination":"TestSample"}';
    }

    /**
     * Tests for Serialization and Deserialization Issues
     * @return Ebucks
     */
    public function testSerializationDeserialization()
    {
        $obj = new Ebucks(self::getData());
        $this->assertNotNull($obj);
        $this->assertNotNull($obj->getAction());
        $this->assertNotNull($obj->getAuthenticateAccountType());
        $this->assertNotNull($obj->getEbucksMemberIdentifier());
        $this->assertNotNull($obj->getEbucksPin());
        $this->assertNotNull($obj->getGenerateOTPType());
        $this->assertNotNull($obj->getEbucksAmount());
        $this->assertNotNull($obj->getResetPasswordType());
        $this->assertNotNull($obj->getValidateOTPType());
        $this->assertNotNull($obj->getEbucksOTP());
        $this->assertNotNull($obj->getEbucksAccountNumber());
        $this->assertNotNull($obj->getEbucksMemberIdentifier());
        $this->assertEquals(self::getObject(), $obj);
        return $obj;
    }

    /**
     * @depends testSerializationDeserialization
     * @param Ebucks $obj
     */
    public function testGetters($obj)
    {
        $this->assertEquals($obj->getAction(), "TestSample");
        $this->assertEquals($obj->getAuthenticateAccountType(), "TestSample");
        $this->assertEquals($obj->getEbucksMemberIdentifier(), "TestSample");
        $this->assertEquals($obj->getEbucksPin(), "TestSample");
        $this->assertEquals($obj->getGenerateOTPType(), "TestSample");
        $this->assertEquals($obj->getEbucksAmount(), "TestSample");
        $this->assertEquals($obj->getResetPasswordType(), "TestSample");
        $this->assertEquals($obj->getValidateOTPType(), "TestSample");
        $this->assertEquals($obj->getEbucksOTP(), "TestSample");
        $this->assertEquals($obj->getEbucksAccountNumber(), "TestSample");
        $this->assertEquals($obj->getEbucksDestination(), "TestSample");
    }
}
