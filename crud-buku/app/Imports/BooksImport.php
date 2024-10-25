<?php

namespace App\Imports;

use App\Models\Book;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;



class BooksImport implements ToModel, WithHeadingRow, WithValidation
{
    public function model(array $row)
    {
        return new Book([
            'name'        => $row['name'],
            'thumbnail'   => $row['thumbnail'],
            'description' => $row['description'],
            'author'      => $row['author'],
        ]);
    }

    public function rules(): array
    {
        return [
            '*.name' => ['required', Rule::unique('books', 'name')],
            '*.description' => ['required'],
            '*.author' => ['required'],
        ];
    }
}
