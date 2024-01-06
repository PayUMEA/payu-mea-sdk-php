<?php
namespace PayU\Test\Model;

use PayUSdk\Model\PayUModel;

class NestedClass extends PayUModel
{

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    /**
     *
     * @param \PayU\Test\Model\ArrayClass $info
     */
    public function setInfo($info)
    {
        $this->info = $info;
    }

    /**
     *
     * @return \PayU\Test\Model\ArrayClass
     */
    public function getInfo()
    {
        return $this->info;
    }
}
