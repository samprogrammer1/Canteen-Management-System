<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;

class ProductsImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        $data = [];
        foreach ($rows->skip(1) as $row) {
            $data[] = [
                'name' => $row[0],
                'stock' => $row[1],
                'cost_price' => $row[2],
                'price' => $row[3]
            ];
        }
        return $data;
    }
}
