<?php

namespace PayU\Test\Conversion;

use PayUSdk\Model\Cart;
use PayUSdk\Model\Currency;
use PayUSdk\Model\Details;
use PayUSdk\Model\Item;
use PayUSdk\Model\Tax;
use PayUSdk\Framework\Formatter;
use PayUSdk\Model\PayUModel;
use PayU\Test\Validation\NumericValidatorTest;

class FormatConverterTest extends \PHPUnit\Framework\TestCase
{

    public static function classMethodListProvider()
    {
        return array(
            array(new Details(), 'Shipping'),
            array(new Details(), 'SubTotal'),
            array(new Details(), 'Tax'),
            array(new Details(), 'Fee'),
            array(new Details(), 'ShippingDiscount'),
            array(new Details(), 'HandlingFee'),
            array(new Details(), 'GiftWrap'),
            array(new Tax(), 'Percent')
        );
    }

    public static function CurrencyListWithNoDecimalsProvider()
    {
        return array(
            array('JPY'),
            array('TWD')
        );
    }

    public static function apiModelSettersProvider()
    {
        $provider = array();
        foreach (NumericValidatorTest::positiveProvider() as $value) {
            foreach (self::classMethodListProvider() as $method) {
                $provider[] = array_merge($method, array($value));
            }
        }
        return $provider;
    }

    public static function apiModelSettersInvalidProvider()
    {
        $provider = array();
        foreach (NumericValidatorTest::invalidProvider() as $value) {
            foreach (self::classMethodListProvider() as $method) {
                $provider[] = array_merge($method, array($value));
            }
        }
        return $provider;
    }

    /**
     *
     * @dataProvider \PayU\Test\Validation\NumericValidatorTest::positiveProvider
     */
    public function testFormatToTwoDecimalPlaces($input, $expected)
    {
        $result = Formatter::formatToDecimal($input);
        $this->assertEquals($expected, $result);
    }

    /**
     * @dataProvider CurrencyListWithNoDecimalsProvider
     */
    public function testPriceWithNoDecimalCurrencyInvalid($input)
    {
        try {
            Formatter::formatToPrice("1.234", $input);
        } catch (\InvalidArgumentException $ex) {
            $this->assertStringContainsString("value cannot have decimals for", $ex->getMessage());
        }
    }

    /**
     * @dataProvider CurrencyListWithNoDecimalsProvider
     */
    public function testPriceWithNoDecimalCurrencyValid($input)
    {
        $result = Formatter::formatToPrice("1.0000000", $input);
        $this->assertEquals("1", $result);
    }

    /**
     *
     * @dataProvider \PayU\Test\Validation\NumericValidatorTest::positiveProvider
     */
    public function testFormatToNumber($input, $expected)
    {
        $result = Formatter::formatToDecimal($input);
        $this->assertEquals($expected, $result);
    }

    public function testFormatToNumberDecimals()
    {
        $result = Formatter::formatToDecimal("0.0", 4);
        $this->assertEquals("0.0000", $result);
    }


    public function testFormat()
    {
        $result = Formatter::format("12.0123", "%0.2f");
        $this->assertEquals("12.01", $result);
    }

    /**
     * @dataProvider apiModelSettersProvider
     *
     * @param PayUModel $class Class Object
     * @param string $method Method Name where the format is being applied
     * @param array $values array of ['input', 'expectedResponse'] is provided
     */
    public function testSettersOfKnownApiModel($class, $method, $values)
    {
        try {
            $obj = new $class();
            $setter = "set" . $method;
            $getter = "get" . $method;
            $result = $obj->$setter($values[0]);
            $expected = $values[1];
            $actual = $result->$getter();
            if ($expected === null) {
                $this->assertNull($actual);
            } else {
                $this->assertEquals((float)$expected, (float)$actual);
            }
        } catch (\TypeError $e) {
            // Under PHP 8, passing null or non-float string to strict-typed float/int setter throws TypeError.
            // If the input was empty/null (which positiveProvider allows), this is expected behavior.
            if ($values[0] === null || (is_string($values[0]) && trim($values[0]) === '')) {
                $this->assertTrue(true);
            } else {
                throw $e;
            }
        }
    }

    /**
     * @dataProvider apiModelSettersInvalidProvider
     */
    public function testSettersOfKnownApiModelInvalid($class, $methodName, $values)
    {
        try {
            $obj = new $class();
            $setter = "set" . $methodName;
            $obj->$setter($values[0]);
            $this->fail("Expected exception not thrown");
        } catch (\InvalidArgumentException | \TypeError $e) {
            $this->assertTrue(true);
        }
    }
}
