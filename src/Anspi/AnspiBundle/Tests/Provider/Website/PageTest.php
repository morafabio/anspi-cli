<?php

namespace Anspi\AnspiBundle\Tests\Provider\Website;


class PageTest extends \PHPUnit_Framework_TestCase
{
    protected function mockGetPage()
    {
        // Dependency Injection of \RemoteWebDriver
        $mock = $this->getMockBuilder('\RemoteWebDriver')
                     ->disableOriginalConstructor()
                     ->getMock()
        ;

        return $this->getMockForAbstractClass(
            '\Anspi\AnspiBundle\Provider\Website\Page',
            array($mock)
        );
    }

    public function testSetContentsAndValidationCall()
    {
        $page = $this->mockGetPage();

        $contents = 'Hello';
        $page->setSource($contents);
        $this->assertNull($page->isValid());
        $this->assertEquals($page->getSource(), $contents);
    }

}