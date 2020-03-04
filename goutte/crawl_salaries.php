<?php

use Symfony\Component\DomCrawler\Crawler;

function crawl_salaries(Crawler $crawler): array
{
    $tables = $crawler->filter('table'); // Get all tables

    $table = $tables->first(); // Get the first table (salaries table)

    $rows = $table->filter('tr'); // Get all rows

    $rows = $rows->slice(1); // Remove the first row (header)

    // Iterates through all rows
    $data = $rows->each(function (Crawler $row) {
        $col = $row->filter('td'); // Get all columns

        $normaLegalCol = $col->eq(4);
        $normaLegalLink = $normaLegalCol->filter('a');
        $normaLegal = count($normaLegalLink) ? $normaLegalLink->first()->text() : $normaLegalCol->text();

        return [
            'vigencia' => $col->eq(0)->text(), // Column 0 (first)
            'valor_mensal' => $col->eq(1)->text(), // Column 1 (second)
            'valor_diario' => $col->eq(2)->text(),
            'valor_hora' => $col->eq(3)->text(),
            'norma_legal' => $normaLegal,
            'dou' => $col->eq(5)->text(),
        ];
    });

    return $data;
}
