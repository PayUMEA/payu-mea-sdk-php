<?php
namespace PayU\Test\Validation;

use PayUSdk\Framework\Validation\UrlValidator;

class UrlValidatorTest extends \PHPUnit\Framework\TestCase
{

    public static function positiveProvider()
    {
        return array(
            array("https://www.payu.co.za"),
            array("http://www.payu.co.za"),
            array("https://payu.co.za"),
            array("https://www.payu.co.za/directory/file"),
            array("https://www.payu.co.za/directory/file?something=1&other=true"),
            array("https://www.payu.co.za?value="),
            array("https://www.payu.co.za/123123"),
            array("https://www.subdomain.payu.co.za"),
            array("https://www.payu.co.za?value=space%20separated%20value"),
            array("https://www.special@character.co.za"),
        );
    }

    public static function invalidProvider()
    {
        return array(
            array("www.payu.co.za"),
            array(""),
            array(null),
            array("https://www.sub_domain_with_underscore.payu.co.za"),
        );
    }

    /**
     * @dataProvider positiveProvider
     */
    public function testValidate($input)
    {
        UrlValidator::validate($input, "Test Value");
        $this->addToAssertionCount(1);
    }

    /**
     *
     * @dataProvider invalidProvider
     */
    public function testValidateException($input)
    {
        $this->expectException(\InvalidArgumentException::class);
        UrlValidator::validate($input, "Test Value");
    }
}
