<?php

namespace Anspi\AnspiBundle\Provider\Website;
use Symfony\Component\DomCrawler\Crawler;

abstract class Page implements PageInterface {

    protected $source;
    protected $webdriver;

    const BASE_URL = 'http://www.tesseramentoanspi.it';

    public function __construct(\RemoteWebDriver $webdriver)
    {
        $this->webdriver = $webdriver;
    }

    public function getWebdriver()
    {
        return $this->webdriver;
    }

    public function setSource($source)
    {
        $this->source = $source;
    }

    public function getSource()
    {
        return $this->source;
    }

    public function getCrawler()
    {
        return new Crawler($this->getSource());
    }

}