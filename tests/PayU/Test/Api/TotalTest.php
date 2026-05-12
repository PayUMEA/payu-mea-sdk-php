<?php
/**
 * Copyright © 2026 PayU Financial Services. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace PayU\Test\Api;

use PayUSdk\Model\Total;

class TotalTest extends \PHPUnit\Framework\TestCase
{
    /**
     * Gets Object Instance
     * @return Total
     */
    public static function getObject()
    {
        return new Total(self::getData());
    }

    /**
     * @return array
     */
    public static function getData()
    {
        return [
            "currency" => CurrencyTest::getObject(),
            "amount" => "12.34"
        ];
    }

    /**
     * Tests for Serialization and Deserialization Issues
     * @return Total
     */
    public function testSerializationDeserialization()
    {
        $total = new Total(self::getData());
        $this->assertNotNull($total);
        $this->assertNotNull($total->getCurrency());
        $this->assertNotNull($total->getAmount());
        $this->assertEquals(self::getObject(), $total);
        return $total;
    }

    /**
     * @depends testSerializationDeserialization
     * @param Total $total
     */
    public function testGetters(Total $total)
    {
        $this->assertEquals($total->getCurrency()->getCode(), "ZAR");
        $this->assertEquals($total->getAmount(), 12.34);
    }

    /**
     * @depends testSerializationDeserialization
     * @param Total $total
     */
    public function testSetters(Total $total)
    {
        $total->setAmount(10);
        $this->assertEquals($total->getCurrency()->getCode(), "ZAR");
        $this->assertEquals($total->getAmount(), 10);
    }
}
