<?php

require_once 'vendor/autoload.php';

use \GuzzleHttp\Client;
use Crawler\Crawler;
use Crawler\Operation\GetSalariesData;

$client = new Client();
$crawler = new Crawler($client);
$operation = new GetSalariesData();

$crawler->load('http://www.guiatrabalhista.com.br/guia/salario_minimo.htm');

print_r($crawler->execOperation($operation));
