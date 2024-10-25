<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\BooksExport;
use App\Imports\BooksImport;

class BookController extends Controller
{
    public function index()
    {
        $books = DB::table('books')->get();
        return view('books.index', compact('books'));
    }

    public function create()
    {
        return view('books.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:books,name',
            'thumbnail' => 'nullable',
            'description' => 'nullable',
            'author' => 'required',
        ]);

        Book::create($request->all());

        return redirect()->route('books.index')->with('success', 'Book created successfully.');
    }

    public function edit($id)
    {
        $book = DB::table('books')->find($id);
        return view('books.edit', compact('book'));
    }

    public function update(Request $request, $id)
    {
            $request->validate([
            'name' => 'required|unique:books,name,' . $book->id,
            'thumbnail' => 'nullable',
            'description' => 'nullable',
            'author' => 'required',
        ]);

        $book->update($request->all());

        return redirect()->route('books.index')->with('success', 'Book updated successfully.');
    }

    public function destroy($id)
    {
        DB::table('books')->delete($id);
        return redirect()->route('books.index')->with('success', 'Book deleted successfully!');
    }

    public function massDelete(Request $request)
    {
        $ids = $request->ids;
        
        if (is_array($ids) && !empty($ids)) {
            DB::table('books')->whereIn('id', $ids)->delete();
            return response()->json(['success' => 'Books deleted successfully!']);
        } else {
            return response()->json(['error' => 'No books selected.'], 400);
        }
    }


     // Method untuk export
    public function export() 
    {
        return Excel::download(new BooksExport, 'books.xlsx');
    }

    // Method untuk import
    public function import(Request $request)
    {
        // Validasi bahwa file harus ada dan tipe filenya adalah file yang dapat diunggah
        $request->validate([
            'file' => 'required|mimes:xlsx,csv'
        ]);

        // Simpan file sementara di folder 'temp'
        $file = $request->file('file');
        
        if ($file) {
            Excel::import(new BooksImport, $file->store('temp'));

            return redirect()->route('books.index')->with('success', 'Data berhasil diimpor');
        }

        return redirect()->route('books.index')->with('error', 'File tidak ditemukan atau tidak valid.');
    }
}

