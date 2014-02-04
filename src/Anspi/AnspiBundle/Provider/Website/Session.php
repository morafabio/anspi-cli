<?php

namespace Anspi\AnspiBundle\Provider\Website;

use Anspi\AnspiBundle\Provider\Website\Page;
use Anspi\AnspiBundle\Provider\Website\PageInterface;

use RemoteWebDriver;

class Session {

    protected $webdriver;
    protected $history = array();

    public function setWebdriver(\RemoteWebDriver $webdriver)
    {
        $this->webdriver = $webdriver;
        return $this;
    }

    public function getWebdriver()
    {
        return $this->webdriver;
    }

    protected function setPage(PageInterface $page)
    {
        $this->historyAdd($page);
        return $this;
    }

    public function getPage()
    {
        return clone end($this->history);
    }

    public function onPage()
    {
        return end($this->history);
    }

    public function __construct($webdriver)
    {
        $this->setWebdriver($webdriver);
        return $this;
    }

    public function __destruct()
    {
        if($this->getWebdriver())
        {
            $this->getWebdriver()->close();
        }
    }

    public function createPage($type)
    {
        $class = 'Anspi\AnspiBundle\Provider\Website\Page\\' . $type;
        return new $class($this->getWebdriver());
        //return new $class($this->getWebdriver());
    }

    public function get($action)
    {
        $page = $this->createPage($action);

        foreach($page->dependsOnActions() as $action_name) {
            if(! $this->historyContains($action_name) )
              throw new \Exception('Action '. $action_name . ' missing.');
        }

        $this->getWebdriver()->get($page->url());
        $page->setSource($this->getWebdriver()->getPageSource());
        $this->setPage($page);

        return $this;
    }

    protected function historyAdd(PageInterface $page) {
        array_push($this->history, $page);
        return $this;
    }

    public function historyContains($expected_name)
    {
        if($expected_name instanceof PageInterface)
            $expected_name = $expected_name->name();

        foreach($this->history as $page)
        {
            if($page->name() == $expected_name && $page->isValid()) return true;
        }
        return false;
    }

}