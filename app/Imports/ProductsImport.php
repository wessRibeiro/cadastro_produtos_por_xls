<?php

namespace Leroy\Imports;

use Leroy\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;

class ProductsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Product([
            'category'      => $row[0],
            'im'            => $row[1],
            'name'          => $row[2],
            'free_shipping' => $row[3],
            'description'   => $row[4],
            'price'         => $row[5],
        ]);
    }
}
