<?php
/**
 * Created by PhpStorm.
 * User: kenny
 * Date: 12/19/16
 * Time: 10:23 AM
 */

namespace PayU\Test\Api;

use PayU\Test\Api\Helper;

use PayUSdk\Model\Transaction;

class TransactionTest extends \PHPUnit\Framework\TestCase
{
    /**
     * Gets Object Instance with Json data filled in
     * @return Transaction
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
        return new Transaction(self::getData());
    }

    /**
     * Gets Json String of Object Address
     * @return string
     */
    public static function getJson()
    {
        return '{"showBudget":"TestSample","referenceId":"TestSample","description":"TestSample","invoiceNumber":"TestSample","itemList":' . ItemListTest::getJson() . ',"merchant":' . MerchantTest::getJson() . ',"amount":' . TotalTest::getJson() . ',"shippingInfo":' . ShippingInfoTest::getJson() . ',"transactionRecord":' . TransactionRecordTest::getJson() . ',"fraudManagement":' . FmDetailsTest::getJson() . '}';
    }

    /**
     * Tests for Serialization and Deserialization Issues
     * @return Transaction
     */
    public function testSerializationDeserialization()
    {
        $obj = new Transaction(self::getData());
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
        $this->assertEquals(self::getObject(), $obj);
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
        $this->assertEquals($obj->getAmount(), TotalTest::getObject());
        $this->assertEquals($obj->getShippingInfo(), new \PayUSdk\Model\ShippingAddress(ShippingInfoTest::getData()));
        $this->assertEquals($obj->getTransactionRecord(), TransactionRecordTest::getObject());
        $this->assertEquals($obj->getFraudManagement(), new \PayUSdk\Model\FraudService(FmDetailsTest::getData()));
    }
}
