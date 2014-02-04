#!/usr/bin/env php
<?php
// app/console

require dirname(__DIR__) . '/vendor/autoload.php';

use Symfony\Component\DomCrawler\Crawler;

// Input file: deve essere un esportazione della pagina elenco soci, salvata dal browser in HTML (Salva con nome)

$converter = new Converter(file_get_contents('elenco.html'), new Crawler());
$converter->setParameters(array('active', 'adult'));
$converter->filter();
$converter->exportCsv('elenco.csv');

class Converter
{
    protected $sourceHtml;
    protected $crawler;
    protected $selectedRows = array();
    protected $parameters;

    public function setParameters($parameters)
    {
        $this->parameters = $parameters;
    }

    public function getParameters()
    {
        return $this->parameters;
    }

    public function getSelectedRows()
    {
        return $this->selectedRows;
    }

    public function __construct($html, Crawler $crawler)
    {
        $this->setSourceHtml($html);
        $this->setCrawler($crawler);
        return $this;
    }

    public function filter()
    {
        $this->crawler->filter('table > tbody tr')->reduce(function ($node, $i) {
            $line = array();
            foreach( $node->children() as $cell) {
                array_push(
                    $line,
                    $this->filterNodeValue($cell->nodeValue)
                );
            }
            if($this->validator($line) ) {
                array_push($this->selectedRows, $line);
                return true;
            }
            return false;
        });
    }

    protected function validator($line) {
        // Linea completa?
        if(!count($line) == 7) return false;

        // Il socio ha un numero di tessera?
        if(in_array('active', $this->getParameters()) ) {
            if(!$line || $line[0] == 'Dati mancanti o errati')
                return false;
        }

        // Il numero di tessera finisce con A? Se si e' adulto.
        if(in_array('adult', $this->getParameters()) ) {
            if($line[0][strlen($line[0])-1] != 'A')
                return false;
        }

        return true;
    }

    public function exportCsv($file)
    {
        $fp = fopen($file, 'w');
        foreach ($this->getSelectedRows() as $row) {
            fputcsv($fp, $row);
        }
        fclose($fp);
    }

    public function filterNodeValue($value)
    {
        return trim(strip_tags($value));
    }

    public function setSourceHtml($sourceHtml)
    {
        $this->sourceHtml = $sourceHtml;
    }

    public function getSourceHtml()
    {
        return $this->sourceHtml;
    }

    public function getCrawler()
    {
        return $this->crawler;
    }

    public function setCrawler(Crawler $crawler)
    {
        $crawler->add($this->getSourceHtml());
        $this->crawler = $crawler;
    }

}
