<?php

namespace Crawler\Operation;

class GetSalariesData implements OperationInterface
{
    /**
     * @param string $body
     *
     * @return array
     */
    public function getData(string $body)
    {
        $dom = \DOMDocument::loadHTML($body, LIBXML_NOERROR); // Does not show errors, because the raw HTML is invalid

        $tables = $dom->getElementsByTagName('table');
        $table = $tables[0];
        $rows = $table->getElementsByTagName('tr');
        $data = [];

        foreach ($rows as $i => $row) {
            if ($i > 0) {
                $columns = $row->getElementsByTagName('td');

                $normaLegalCol = $columns[4];
                $normaLegalLink = $normaLegalCol->getElementsByTagName('a');
                $normaLegal = count($normaLegalLink) ? $normaLegalLink[0]->nodeValue : $normaLegalCol->nodeValue;

                $data[] = [
                    'vigencia' => trim($columns[0]->nodeValue),
                    'valor_mensal' => trim($columns[1]->nodeValue),
                    'valor_diario' => trim($columns[2]->nodeValue),
                    'valor_hora' => trim($columns[3]->nodeValue),
                    'norma_legal' => trim($normaLegal),
                    'dou' => trim($columns[5]->nodeValue),
                ];
            }
        }

        return $data;
    }
}
