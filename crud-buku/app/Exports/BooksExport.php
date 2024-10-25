<?php

namespace App\Exports;

use App\Models\Book;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BooksExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Book::select('id', 'name', 'thumbnail', 'description', 'author')->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Thumbnail',
            'Description',
            'Author',
        ];
    }
}
