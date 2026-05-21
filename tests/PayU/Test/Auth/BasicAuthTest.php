<?php

namespace PayU\Test\Auth;

use PayUSdk\Framework\Authentication;
use PayU\Test\Constants;

class BasicAuthTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @group integration
     */
    public function testGetBasicAuth()
    {
        $cred = new Authentication(Constants::API_USERNAME, Constants::API_PASSWORD, Constants::API_SAFEKEY);
        $this->assertEquals(Constants::API_USERNAME, $cred->getUsername());
        $this->assertEquals(Constants::API_PASSWORD, $cred->getPassword());
        $this->assertEquals(Constants::API_SAFEKEY, $cred->getSafekey());
    }
}
