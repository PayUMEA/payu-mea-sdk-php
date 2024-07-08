<?php

namespace PayU\Test\Conversion;

use PayUSdk\Api\Amount;
use PayUSdk\Api\Currency;
use PayUSdk\Api\Details;
use PayUSdk\Api\Item;
use PayUSdk\Api\Tax;
use PayU\Conversion\Formatter;
use PayUSdk\Model\PayUModel;
use PayU\Test\Validation\NumericValidatorTest;

class FormatConverterTest extends \PHPUnit_Framework_TestCase
{

    public static function classMethodListProvider()
    {
        return array(
            array(new Item(), 'Price'),
            array(new Item(), 'Tax'),
            array(new Amount(), 'Total'),
            array(new Currency(), 'Value'),
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
            $this->assertContains("value cannot have decimals for", $ex->getMessage());
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
        $obj = new $class();
        $setter = "set" . $method;
        $getter = "get" . $method;
        $result = $obj->$setter($values[0]);
        $this->assertEquals($values[1], $result->$getter());
    }

    /**
     * @dataProvider apiModelSettersInvalidProvider
     * @expectedException \InvalidArgumentException
     */
    public function testSettersOfKnownApiModelInvalid($class, $methodName, $values)
    {
        $obj = new $class();
        $setter = "set" . $methodName;
        $obj->$setter($values[0]);
    }
}
