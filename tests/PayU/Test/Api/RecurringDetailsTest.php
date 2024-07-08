<?php
/**
 * Created by PhpStorm.
 * User: kenny
 * Date: 12/19/16
 * Time: 10:23 AM
 */

namespace PayU\Test\Api;

use PayUSdk\Api\RecurringDetails;

class RecurringDetailsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Gets Object Instance with Json data filled in
     * @return RecurringDetails
     */
    public static function getObject()
    {
        return new RecurringDetails(self::getJson());
    }

    /**
     * Gets Json String of Object Address
     * @return string
     */
    public static function getJson()
    {
        return '{"recurrences":"TestSample","statementDescription":"TestSample","managedBy":"TestSample","startDate":"TestSample","anonymousUser":"TestSample","frequency":"TestSample","deductionDay":"TestSample","callCenterRepId":"[{}]","recurringPaymentToken":"TestSample"}';
    }

    /**
     * Tests for Serialization and Deserialization Issues
     * @return RecurringDetails
     */
    public function testSerializationDeserialization()
    {
        $obj = new RecurringDetails(self::getJson());
        $this->assertNotNull($obj);
        $this->assertNotNull($obj->getRecurrences());
        $this->assertNotNull($obj->getStatementDescription());
        $this->assertNotNull($obj->getManagedBy());
        $this->assertNotNull($obj->getStartDate());
        $this->assertNotNull($obj->getAnonymousUser());
        $this->assertNotNull($obj->getFrequency());
        $this->assertNotNull($obj->getDeductionDay());
        $this->assertNotNull($obj->getCallCenterRepIds());
        $this->assertNotNull($obj->getRecurringPaymentToken());
        $this->assertEquals(self::getJson(), $obj->toJson());
        return $obj;
    }

    /**
     * @depends testSerializationDeserialization
     * @param RecurringDetails $obj
     */
    public function testGetters($obj)
    {
        $this->assertEquals($obj->getRecurrences(), "TestSample");
        $this->assertEquals($obj->getStatementDescription(), "TestSample");
        $this->assertEquals($obj->getManagedBy(), "TestSample");
        $this->assertEquals($obj->getStartDate(), "TestSample");
        $this->assertEquals($obj->getAnonymousUser(), "TestSample");
        $this->assertEquals($obj->getFrequency(), "TestSample");
        $this->assertEquals($obj->getDeductionDay(), "TestSample");
        $this->assertEquals($obj->getCallCenterRepIds(), array("{}"));
        $this->assertEquals($obj->getRecurringPaymentToken(), "TestSample");
    }
}
