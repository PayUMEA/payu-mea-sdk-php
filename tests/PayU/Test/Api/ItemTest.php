<?php
/**
 * Created by PhpStorm.
 * User: kenny
 * Date: 12/19/16
 * Time: 12:30 PM
 */

namespace PayU\Test\Api;

use PayUSdk\Api\Item;

class ItemTest extends \PHPUnit_Framework_TestCase
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
    public static function getObject()
    {
        return new Item(self::getJson());
    }


    /**
     * Tests for Serialization and Deserialization Issues
     * @return Item
     */
    public function testSerializationDeserialization()
    {
        $obj = new Item(self::getJson());
        $this->assertNotNull($obj);
        $this->assertNotNull($obj->getSku());
        $this->assertNotNull($obj->getName());
        $this->assertNotNull($obj->getDescription());
        $this->assertNotNull($obj->getQuantity());
        $this->assertNotNull($obj->getPrice());
        $this->assertNotNull($obj->getCurrency());
        $this->assertNotNull($obj->getTax());
        $this->assertEquals(self::getJson(), $obj->toJson());
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
        $this->assertEquals($obj->getQuantity(), "12.34");
        $this->assertEquals($obj->getPrice(), "12.34");
        $this->assertEquals($obj->getCurrency(), "TestSample");
        $this->assertEquals($obj->getTax(), "12.34");
    }
}
