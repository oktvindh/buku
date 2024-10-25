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
            'name' => 'required|unique:books',
            'description' => 'required',
            'author' => 'required',
        ]);

        DB::table('books')->insert([
            'name' => $request->name,
            'thumbnail' => $request->thumbnail,
            'description' => $request->description,
            'author' => $request->author,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('books.index')->with('success', 'Book added successfully!');
    }

    public function edit($id)
    {
        $book = DB::table('books')->find($id);
        return view('books.edit', compact('book'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:books,name,'.$id,
            'description' => 'required',
            'author' => 'required',
        ]);

        DB::table('books')->where('id', $id)->update([
            'name' => $request->name,
            'thumbnail' => $request->thumbnail,
            'description' => $request->description,
            'author' => $request->author,
            'updated_at' => now(),
        ]);

        return redirect()->route('books.index')->with('success', 'Book updated successfully!');
    }

    public function destroy($id)
    {
        DB::table('books')->delete($id);
        return redirect()->route('books.index')->with('success', 'Book deleted successfully!');
    }

    public function massDelete(Request $request)
    {
        $ids = $request->ids;
        DB::table('books')->whereIn('id', $ids)->delete();
        return response()->json(['success' => 'Books deleted successfully!']);
    }

     // Method untuk export
    public function export() 
    {
        return Excel::download(new BooksExport, 'books.xlsx');
    }

    // Method untuk import
    public function import(Request $request) 
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv'
        ]);

        Excel::import(new BooksImport, $request->file('file'));

        return redirect()->route('books.index')->with('success', 'Books imported successfully!');
    }
}

