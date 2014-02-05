<?php

namespace Anspi\AnspiBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ConfigureCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('configure:account')
            ->setDescription('Configura il tuo account.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $dialog = $this->getHelperSet()->get('dialog');

        $output->writeln('<info>Inserisci i dati che usi per loggarti su tesseramentoanspi.it</info>');

        $username = $dialog->ask($output, '<question>Username:</question> ');
        $password = $dialog->askHiddenResponse($output, '<question>Password:</question> ');



        $output->writeln('<info>Configurazione registrata.</info>');
    }

}
