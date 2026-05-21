<?php
/**
 * Created by PhpStorm.
 * User: kenny
 * Date: 12/19/16
 * Time: 10:23 AM
 */

namespace PayU\Test\Api;

use PayU\Test\Api\Helper;

use PayUSdk\Model\Response;

class ResponseTest extends \PHPUnit\Framework\TestCase
{
    /**
     * Gets Object Instance with Json data filled in
     * @return Response
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
        return new Response(self::getData());
    }

    /**
     * Gets Json String of Object Address
     * @return string
     */
    public static function getJson()
    {
        return '{"displayMessage":"TestSample","merchantReference":"TestSample","payUReference":"TestSample","resultCode":"TestSample","resultMessage":"TestSample","successful":"TestSample","transactionType":"TestSample","transactionState":"TestSample","basket":' . BasketTest::getJson() . ',"secure3D":' . Secure3DTest::getJson() . ',"customFields":' . CustomFieldsTest::getJson() . ',"lookupData":' . LookupDataTest::getJson() . ',"paymentMethodsUsed":' . PaymentMethodTest::getJson() . ',"recurringDetails":' . RecurringDetailsTest::getJson() . ',"redirect":' . EFTBaseTest::getJson() . ',"fraud":' . FmDetailsTest::getJson() . '}';
    }

    /**
     * Tests for Serialization and Deserialization Issues
     * @return Response
     */
    public function testSerializationDeserialization()
    {
        $obj = new Response(self::getData());
        $this->assertNotNull($obj);
        $this->assertNotNull($obj->getDisplayMessage());
        $this->assertNotNull($obj->getMerchantReference());
        $this->assertNotNull($obj->getPayUReference());
        $this->assertNotNull($obj->getResultCode());
        $this->assertNotNull($obj->getResultMessage());
        $this->assertNotNull($obj->getSuccessful());
        $this->assertNotNull($obj->getTransactionType());
        $this->assertNotNull($obj->getTransactionState());
        $this->assertNotNull($obj->getBasket());
        $this->assertNotNull($obj->getSecure3D());
        $this->assertNotNull($obj->getCustomFields());
        $this->assertNotNull($obj->getLookupData());
        $this->assertNotNull($obj->getPaymentMethodsUsed());
        $this->assertNotNull($obj->getRecurringDetails());
        $this->assertNotNull($obj->getRedirect());
        $this->assertNotNull($obj->getFraud());
        $this->assertEquals(self::getObject(), $obj);
        return $obj;
    }

    /**
     * @depends testSerializationDeserialization
     * @param Response $obj
     */
    public function testGetters($obj)
    {
        $this->assertEquals($obj->getDisplayMessage(), "TestSample");
        $this->assertEquals($obj->getMerchantReference(), "TestSample");
        $this->assertEquals($obj->getPayUReference(), "TestSample");
        $this->assertEquals($obj->getResultCode(), "TestSample");
        $this->assertEquals($obj->getResultMessage(), "TestSample");
        $this->assertEquals($obj->getSuccessful(), "TestSample");
        $this->assertEquals($obj->getTransactionType(), "TestSample");
        $this->assertEquals($obj->getTransactionState(), "TestSample");
        $this->assertEquals($obj->getBasket(), BasketTest::getObject());
        $this->assertEquals($obj->getSecure3D(), Secure3DTest::getObject());
        $this->assertEquals($obj->getCustomFields(), CustomFieldsTest::getData());
        $this->assertEquals($obj->getLookupData(), LookupDataTest::getObject());
        $this->assertEquals($obj->getPaymentMethodsUsed(), PaymentMethodTest::getObject());
        $this->assertEquals($obj->getRecurringDetails(), new \PayUSdk\Model\RecurringPayment(RecurringDetailsTest::getData()));
        $this->assertEquals($obj->getRedirect(), new \PayUSdk\Model\BaseEft(EFTBaseTest::getData()));
        $this->assertEquals($obj->getFraud(), new \PayUSdk\Model\FraudService(FmDetailsTest::getData()));
    }
}
