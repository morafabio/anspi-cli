<?php

namespace Anspi\AnspiBundle\Provider\Website\Page;
use Anspi\AnspiBundle\Provider\Website\Page;
use WebDriverBy;

class Login extends Page {

    public $loggedIn = false;

    public function name()
    {
        return 'Login';
    }

    public function url()
    {
        return self::BASE_URL . '/index.php';
    }

    public function followActions()
    {
        return array('Homepage');
    }

    public function dependsOnActions()
    {
        return array();
    }

    public function isValid()
    {
        $crawler = $this->getCrawler();
        return $crawler->filter('#Login, #Password, input[name^="Invia"]')->count() == 3;
    }

    public function doLogin($username, $password)
    {
        $webdriver = $this->getWebdriver();
        $webdriver->manage()->deleteAllCookies();

        $webdriver->get(self::BASE_URL);
        $webdriver->findElement(WebDriverBy::id('Login'))->sendKeys($username);
        $webdriver->findElement(WebDriverBy::id('Password'))->sendKeys($password);

        $webdriver->findElement(WebDriverBy::name('Invia'))->click();
        $wait = new \WebDriverWait($webdriver, 0.5);
        try {
            $wait->until(\WebDriverExpectedCondition::alertIsPresent());
            $alert = $webdriver->switchTo()->alert();

            if($alert->getText()) {
                print $alert->getText();
                $alert->accept();
            }
            $this->loggedIn = false;
        } catch (\Exception $e) {
            print 'Login effettuato!';
            $this->loggedIn = true;
        }
        print $webdriver->getCurrentURL();
        //file_put_contents('./login_afterclick.bad.source', $webdriver->getPageSource());
    }

    public function isLoginValid()
    {
        return $this->loggedIn;
    }
}
