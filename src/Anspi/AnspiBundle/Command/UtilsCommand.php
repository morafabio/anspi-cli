<?php

namespace Anspi\AnspiBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

use WebDriverCapabilityType;
use RemoteWebDriver;
use WebDriverBy;

use Anspi\AnspiBundle\Provider\Website\Session;

class UtilsCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('utils:info')
            ->setDescription('Informazioni di registrazione.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $text = $this->commandLastAccess();

        $output->writeln($text);
    }

    protected function commandLastAccess($user='', $password='')
    {
        $host = 'http://localhost:4444/wd/hub';
        $capabilities = array(WebDriverCapabilityType::BROWSER_NAME => 'firefox');

        $webdriver = new RemoteWebDriver($host, $capabilities);
        $session = new Session($webdriver);

        $session->get('Login');
        $session->onPage()->doLogin($user, $password);

        $data = '';
        return $data;
    }
}
