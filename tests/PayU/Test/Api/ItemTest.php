<?php
/**
 * Created by PhpStorm.
 * User: kenny
 * Date: 12/19/16
 * Time: 12:30 PM
 */

namespace PayU\Test\Api;

use PayU\Test\Api\Helper;

use PayUSdk\Model\Item;

class ItemTest extends \PHPUnit\Framework\TestCase
{
    /**
     * Gets Json String of Object Item
     * @return string
     */
    public static function getJson()
    {
        return '{"sku":"TestSample","name":"TestSample","description":"TestSample","quantity":"12.34","price":"12.34","currency":"TestSample","tax":"12.34"}';
    }

    /**
     * Gets Object Instance with Json data filled in
     * @return Item
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
        return new Item(self::getData());
    }


    /**
     * Tests for Serialization and Deserialization Issues
     * @return Item
     */
    public function testSerializationDeserialization()
    {
        $obj = new Item(self::getData());
        $this->assertNotNull($obj);
        $this->assertNotNull($obj->getSku());
        $this->assertNotNull($obj->getName());
        $this->assertNotNull($obj->getDescription());
        $this->assertNotNull($obj->getQuantity());
        $this->assertNotNull($obj->getPrice());
        $this->assertNotNull($obj->getCurrency());
        $this->assertNotNull($obj->getTax());
        $this->assertEquals(self::getObject(), $obj);
        return $obj;
    }

    /**
     * @depends testSerializationDeserialization
     * @param Item $obj
     */
    public function testGetters($obj)
    {
        $this->assertEquals($obj->getSku(), "TestSample");
        $this->assertEquals($obj->getName(), "TestSample");
        $this->assertEquals($obj->getDescription(), "TestSample");
        $this->assertEquals($obj->getQuantity(), 12);
        $this->assertEquals($obj->getPrice(), 12.34);
        $this->assertEquals($obj->getCurrency(), "TestSample");
        $this->assertEquals($obj->getTax(), "12.34");
    }
}
