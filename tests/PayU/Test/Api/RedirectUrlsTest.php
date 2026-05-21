<?php
/**
 * Created by PhpStorm.
 * User: kenny
 * Date: 12/19/16
 * Time: 10:23 AM
 */

namespace PayU\Test\Api;

use PayU\Test\Api\Helper;

use PayUSdk\Model\RedirectUrls;

class RedirectUrlsTest extends \PHPUnit\Framework\TestCase
{
    /**
     * Gets Json String of Object RedirectUrls
     * @return string
     */
    public static function getJson()
    {
        return '{"notifyUrl":"http://www.google.com","returnUrl":"http://www.google.com","cancelUrl":"http://www.google.com"}';
    }

    /**
     * Gets Object Instance with Json data filled in
     * @return RedirectUrls
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
        return new RedirectUrls(self::getData());
    }


    /**
     * Tests for Serialization and Deserialization Issues
     * @return RedirectUrls
     */
    public function testSerializationDeserialization()
    {
        $obj = new RedirectUrls(self::getData());
        $this->assertNotNull($obj);
        $this->assertNotNull($obj->getNotifyUrl());
        $this->assertNotNull($obj->getReturnUrl());
        $this->assertNotNull($obj->getCancelUrl());
        $this->assertEquals(self::getObject(), $obj);
        return $obj;
    }

    /**
     * @depends testSerializationDeserialization
     * @param RedirectUrls $obj
     */
    public function testGetters($obj)
    {
        $this->assertEquals($obj->getNotifyUrl(), "http://www.google.com");
        $this->assertEquals($obj->getReturnUrl(), "http://www.google.com");
        $this->assertEquals($obj->getCancelUrl(), "http://www.google.com");
    }

    public function testUrlValidationForNotifyUrl()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("NotificationUrl is not a fully qualified URL");
        $obj = new RedirectUrls();
        $obj->setNotifyUrl(null);
    }

    public function testUrlValidationForReturnUrl()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("ResponseUrl is not a fully qualified URL");
        $obj = new RedirectUrls();
        $obj->setReturnUrl(null);
    }

    public function testUrlValidationForCancelUrl()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("CancelUrl is not a fully qualified URL");
        $obj = new RedirectUrls();
        $obj->setCancelUrl(null);
    }
}
