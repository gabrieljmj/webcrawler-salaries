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
                $data[] = [
                    'vigencia' => $columns[0]->nodeValue,
                    'valor_mensal' => $columns[1]->nodeValue,
                ];
            }
        }

        return $data;
    }
}
