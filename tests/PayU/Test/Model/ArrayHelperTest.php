<?php
namespace PayU\Test\Model;

use PayUSdk\Framework\ArrayHelper;

class ArrayHelperTest extends \PHPUnit\Framework\TestCase
{

    public function testIsAssocArray()
    {
        $arr = array(1, 2, 3);
        $this->assertEquals(false, ArrayHelper::isAssocArray($arr));

        $arr = array(
            'name' => 'John Doe',
            'City' => 'San Jose'
        );
        $this->assertEquals(true, ArrayHelper::isAssocArray($arr));

        $arr[] = 'CA';
        $this->assertEquals(false, ArrayHelper::isAssocArray($arr));
    }
}
