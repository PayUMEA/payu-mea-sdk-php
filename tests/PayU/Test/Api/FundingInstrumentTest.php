<?php
/**
 * Created by PhpStorm.
 * User: kenny
 * Date: 12/19/16
 * Time: 10:23 AM
 */

namespace PayU\Test\Api;

use PayU\Test\Api\Helper;

use PayUSdk\Model\FundingInstrument;

class FundingInstrumentTest extends \PHPUnit\Framework\TestCase
{
    /**
     * Gets Object Instance with Json data filled in
     * @return FundingInstrument
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
        return new FundingInstrument(self::getData());
    }

    /**
     * Gets Json String of Object Address
     * @return string
     */
    public static function getJson()
    {
        return '{"storeCard":"TestSample","creditCard":' . CreditCardTest::getJson() . ',"paymentCard":' . PaymentCardTest::getJson() . ',"ebucks":' . EbucksTest::getJson() . ',"eft":' . EFTBaseTest::getJson() . ',"creditCardToken":' . CreditCardTokenTest::getJson() . '}';
    }

    /**
     * Tests for Serialization and Deserialization Issues
     * @return FundingInstrument
     */
    public function testSerializationDeserialization()
    {
        $obj = new FundingInstrument(self::getData());
        $this->assertNotNull($obj);
        $this->assertNotNull($obj->getStoreCard());
        $this->assertNotNull($obj->getCreditCard());
        $this->assertNotNull($obj->getPaymentCard());
        $this->assertNotNull($obj->getEbucks());
        $this->assertNotNull($obj->getEft());
        $this->assertNotNull($obj->getCreditCardToken());
        $this->assertEquals(self::getObject(), $obj);
        return $obj;
    }

    /**
     * @depends testSerializationDeserialization
     * @param FundingInstrument $obj
     */
    public function testGetters($obj)
    {
        $this->assertEquals($obj->getStoreCard(), "TestSample");
        $this->assertEquals($obj->getCreditCard(), CreditCardTest::getObject());
        $this->assertEquals($obj->getPaymentCard(), PaymentCardTest::getObject());
        $this->assertEquals($obj->getEbucks(), EbucksTest::getObject());
        $this->assertEquals($obj->getEft(), EftBaseTest::getObject());
        $this->assertEquals($obj->getCreditCardToken(), CreditCardTokenTest::getObject());
    }
}
