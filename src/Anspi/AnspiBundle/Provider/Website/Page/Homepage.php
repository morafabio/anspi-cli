<?php

namespace Anspi\AnspiBundle\Provider\Website\Page;
use Anspi\AnspiBundle\Provider\Website\Page;
use WebDriverBy;

class Homepage extends Page {

    public function name()
    {
        return 'Homepage';
    }

    public function url()
    {
        return self::BASE_URL . '/index.php';
    }

    public function followActions()
    {
        return array('Logout');
    }

    public function dependsOnActions()
    {
        return array();
    }

    public function isValid()
    {
        $crawler = $this->getCrawler();
        $accesso = $crawler->filter('#accesso');

        $pattern = '/^Ultimo accesso: <b>([0-9\-]{10}) ([0-9\:]{5})<\/b> $/';
        $match = preg_match($pattern, $accesso->html());

        return (bool) $match;
    }

    public function readLastLogin()
    {
        $webdriver = $this->getWebdriver();
        return $webdriver->findElement(WebDriverBy::id('accesso'))->getText();
    }

}
