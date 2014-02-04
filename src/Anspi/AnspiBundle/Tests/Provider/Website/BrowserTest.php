<?php

namespace Anspi\AnspiBundle\Tests\Provider\Website;
use Anspi\AnspiBundle\Provider\Website\Session;

class SessionTest extends \PHPUnit_Framework_TestCase
{

    public function testHistoryAdd()
    {
        $mock = $this->mockGetRemoteWebDriver();
        $session = new Session($mock);

        $session = $this->mockSessionOpenPage($session, 'Login', 'index.php');
        $page_login = $session->getPage();

        $session = $this->mockSessionOpenPage($session, 'Homepage', 'index.php_azione-HomeOratorio');

        $this->assertTrue($session->historyContains($page_login));
    }

    public function testPageFactory()
    {
        $mock = $this->mockGetRemoteWebDriver('index.php');
        $session = new Session($mock);

        $type = 'Login';
        $page = $session->createPage($type);
        $session->get($type);

        $this->assertInstanceOf('\Anspi\AnspiBundle\Provider\Website\Page\Login', $page);
    }

    public function testOpenLoginPageAndClick()
    {
        $mock = $this->mockGetRemoteWebDriver();
        $session = new Session($mock);
        $session = $this->mockSessionOpenPage($session, 'Login', 'index.php');

        $page = $session->getPage();
        $this->assertTrue($page->isValid());
    }

    public function testForceOpenAPageWithoutGettingDependsThrowsAnException()
    {
        $mock = $this->mockGetRemoteWebDriver();
        $session = new Session($mock);
        $this->mockSessionOpenPage($session, 'Homepage', 'index.php_azione-HomeOratorio');
    }

    protected function getFixture($name)
    {
        $filename = __DIR__ . '/fixtures/' . $name . '.source';
        if(is_readable($filename))
            return file_get_contents($filename);
        return null;
    }

    protected function mockGetRemoteWebDriver($action=null)
    {
        $mock = $this->getMockBuilder('RemoteWebDriver')
            ->disableOriginalConstructor()
            ->getMock();

        if($action) {
            $mock->expects($this->atLeastOnce())
                ->method('get');

            $mock->expects($this->atLeastOnce())
                ->method('getPageSource')
                ->will($this->returnValue($this->getFixture($action)));
        }

        return $mock;
    }

    protected function mockSessionOpenPage($session, $action, $fixture) {
        $mock = $this->mockGetRemoteWebDriver($fixture);
        $session->setWebdriver($mock);
        $session->get($action);
        return $session;
    }

}