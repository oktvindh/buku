<?php

namespace App\Imports;

use App\Models\Book;
use Maatwebsite\Excel\Concerns\ToModel;
 
class BooksImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
   public function model(array $row)
    {
        // Pastikan kolom 'name' tidak kosong
        if (empty($row[0])) {
            return null; // Skip baris jika kolom 'name' kosong
        }

        return new Book([
            'name'        => $row[0],
            'thumbnail'   => $row[1] ?? null, // Atur nilai null jika tidak ada data
            'description' => $row[2] ?? null,
            'author'      => $row[3] ?? null,
        ]);
    }
}
