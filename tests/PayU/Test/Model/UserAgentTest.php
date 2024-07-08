<?php

use PayUSdk\Model\UserAgent;

class UserAgentTest extends PHPUnit_Framework_TestCase
{

    public function testGetValue()
    {
        $ua = UserAgent::getValue("name", "version");
        list($id, $version, $features) = sscanf($ua, "PayUSDK/%s %s (%[^[]])");

        // Check that we pass the useragent in the expected format
        $this->assertNotNull($id);
        $this->assertNotNull($version);
        $this->assertNotNull($features);

        $this->assertEquals("name", $id);
        $this->assertEquals("version", $version);

        // Check that we pass in these mininal features
        $this->assertThat($features, $this->stringContains("os="));
        $this->assertThat($features, $this->stringContains("bit="));
        $this->assertThat($features, $this->stringContains("platform-ver="));
        $this->assertGreaterThan(4, count(explode(';', $features)));
    }
}
