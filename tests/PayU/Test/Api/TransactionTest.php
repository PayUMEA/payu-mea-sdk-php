<?php
/**
 * Created by PhpStorm.
 * User: kenny
 * Date: 12/19/16
 * Time: 10:23 AM
 */

namespace PayU\Test\Api;

use PayUSdk\Api\Transaction;

class TransactionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Gets Object Instance with Json data filled in
     * @return Transaction
     */
    public static function getObject()
    {
        return new Transaction(self::getJson());
    }

    /**
     * Gets Json String of Object Address
     * @return string
     */
    public static function getJson()
    {
        return '{"showBudget":"TestSample","referenceId":"TestSample","description":"TestSample","invoiceNumber":"TestSample","itemList":' . ItemListTest::getJson() . ',"merchant":' . MerchantTest::getJson() . ',"amount":' . AmountTest::getJson() . ',"shippingInfo":' . ShippingInfoTest::getJson() . ',"transactionRecord":' . TransactionRecordTest::getJson() . ',"fraudManagement":' . FmDetailsTest::getJson() . '}';
    }

    /**
     * Tests for Serialization and Deserialization Issues
     * @return Transaction
     */
    public function testSerializationDeserialization()
    {
        $obj = new Transaction(self::getJson());
        $this->assertNotNull($obj);
        $this->assertNotNull($obj->getShowBudget());
        $this->assertNotNull($obj->getReferenceId());
        $this->assertNotNull($obj->getDescription());
        $this->assertNotNull($obj->getInvoiceNumber());
        $this->assertNotNull($obj->getItemList());
        $this->assertNotNull($obj->getMerchant());
        $this->assertNotNull($obj->getAmount());
        $this->assertNotNull($obj->getShippingInfo());
        $this->assertNotNull($obj->getTransactionRecord());
        $this->assertNotNull($obj->getFraudManagement());
        $this->assertEquals(self::getJson(), $obj->toJson());
        return $obj;
    }

    /**
     * @depends testSerializationDeserialization
     * @param Transaction $obj
     */
    public function testGetters($obj)
    {
        $this->assertEquals($obj->getShowBudget(), "TestSample");
        $this->assertEquals($obj->getReferenceId(), "TestSample");
        $this->assertEquals($obj->getDescription(), "TestSample");
        $this->assertEquals($obj->getInvoiceNumber(), "TestSample");
        $this->assertEquals($obj->getItemList(), ItemListTest::getObject());
        $this->assertEquals($obj->getMerchant(), MerchantTest::getObject());
        $this->assertEquals($obj->getAmount(), AmountTest::getObject());
        $this->assertEquals($obj->getShippingInfo(), ShippingInfoTest::getObject());
        $this->assertEquals($obj->getTransactionRecord(), TransactionRecordTest::getObject());
        $this->assertEquals($obj->getFraudManagement(), FmDetailsTest::getObject());
    }
}
