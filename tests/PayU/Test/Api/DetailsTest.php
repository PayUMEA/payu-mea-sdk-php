<?php
/**
 * Created by PhpStorm.
 * User: kenny
 * Date: 12/19/16
 * Time: 12:30 PM
 */

namespace PayU\Test\Api;

use PayUSdk\Api\Details;


class DetailsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Gets Object Instance with Json data filled in
     *
     * @return Details
     */
    public static function getObject()
    {
        return new Details(self::getJson());
    }

    /**
     * Gets Json String of Object Details
     *
     * @return string
     */
    public static function getJson()
    {
        return '{"subtotal":"12.34","shipping":"12.34","tax":"12.34","handlingFee":"12.34","shippingDiscount":"12.34","giftWrap":"12.34","fee":"12.34"}';
    }

    /**
     * Tests for Serialization and Deserialization Issues
     *
     * @return Details
     */
    public function testSerializationDeserialization()
    {
        $obj = new Details(self::getJson());
        $this->assertNotNull($obj);
        $this->assertNotNull($obj->getSubtotal());
        $this->assertNotNull($obj->getShipping());
        $this->assertNotNull($obj->getTax());
        $this->assertNotNull($obj->getHandlingFee());
        $this->assertNotNull($obj->getShippingDiscount());
        $this->assertNotNull($obj->getGiftWrap());
        $this->assertNotNull($obj->getFee());
        $this->assertEquals(self::getJson(), $obj->toJson());
        return $obj;
    }

    /**
     * @depends testSerializationDeserialization
     * @param Details $obj
     */
    public function testGetters($obj)
    {
        $this->assertEquals($obj->getSubtotal(), "12.34");
        $this->assertEquals($obj->getShipping(), "12.34");
        $this->assertEquals($obj->getTax(), "12.34");
        $this->assertEquals($obj->getHandlingFee(), "12.34");
        $this->assertEquals($obj->getShippingDiscount(), "12.34");
        $this->assertEquals($obj->getGiftWrap(), "12.34");
        $this->assertEquals($obj->getFee(), "12.34");
    }
}
