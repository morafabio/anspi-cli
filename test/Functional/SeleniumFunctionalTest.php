<?php

class SeleniumFunctionalTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException UnhandledWebDriverError
     */
    public function testStandaloneServerWithoutCapabilitiesThrowsAWebDriverException()
    {
        $webdriver = new \RemoteWebDriver(TEST_SELENIUM_WD_HOST, array());
    }

    /**
     * @expectedException WebDriverCurlException
     */
    public function testANonWorkingServerThrowsACurlException()
    {
        $webdriver = new \RemoteWebDriver('http://not-existent-url', array());
    }

}