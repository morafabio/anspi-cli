# ANSPI Cli

[![Build Status](https://secure.travis-ci.org/morafabio/anspi-cli.png?branch=master)](http://secure.travis-ci.org/morafabio/anspi-cli)

Collezione di tool per l'automazione di procedure legate alla gestione delle associazioni affiliate ANSPI.

**Il progetto é in fase di sviluppo, non si assume nessuna responsabilità per i danni eventuali causati.**

## Installazione

Requisito é un terminale

1. Prerequisiti: git, java, PHP5.4
2. Clonare il progetto: `git clone https://github.com/morafabio/anspi-cli.git`
2. Installare le dipendenze con [Composer](https://getcomposer.org/): `composer.phar install`
3. Installare un server [Selenium](https://code.google.com/p/selenium/downloads/detail?name=selenium-server-standalone-2.39.0.jar&can=2&q=) (è necessario [Mozilla Firefox](http://www.mozilla.org/it/firefox/new/))

## Esecuzione

1. Avviare il server Selenium
2. Digitare `php app/console` per l'elenco dei comandi disponibili
