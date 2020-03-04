<?php

require_once 'vendor/autoload.php';

use Goutte\Client;

$client = new Client();

$url = 'http://www.guiatrabalhista.com.br/guia/salario_minimo.htm';

$crawler = $client->request('GET', $url);

$data = crawl_salaries($crawler);

print_r($data);
