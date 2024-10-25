<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BookController extends Controller
{
    public function AllBook(){
 
        $books = DB::table('books')->get();
        return view('dashboard.book.all_book',compact('books'));

    }// End Method 

    public function AddBook(){

        $book = Book::latest()->get();
        return view('dashboard.book.add_book',compact('book'));

    }// End Method 


    

    public function StoreBook(Request $request){

      

        $image = $request->file('thumbnail');  
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(370,246)->save('upload/book/thambnail/'.$name_gen);
        $save_url = 'upload/book/thambnail/'.$name_gen;

        

        $book_id = Book::insertGetId([

           
            'name' => $request->input('book_name'),
            'thumbnail' => $save_url,
            'description' => $request->description,
            'author' => $request->author,
            
            
            'created_at' => Carbon::now(),

        ]);

        

        $notification = array(
            'message' => 'Book Inserted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.book')->with($notification);  

    }// End Method 


    public function EditBook($id){

        $book = Book::find($id);
        
        return view('dashboard.book.edit_book',compact('book'));

    }// End Method 


    public function UpdateBook(Request $request){

        $cid = $request->book_id;
         
           Book::find($cid)->update([
            
            'name' => $request->input('book_name'),
           
            'description' => $request->description, 

           
            'author' => $request->author,  

        ]); 

        $notification = array(
            'message' => 'Book Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.book')->with($notification);  

    }// End Method 


    public function UpdateBookThumbnail(Request $request){

        $book_id = $request->id;
        $oldImage = $request->old_img;

        $image = $request->file('thumbnail');  
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(370,246)->save('upload/book/thambnail/'.$name_gen);
        $save_url = 'upload/book/thambnail/'.$name_gen;

        if (file_exists($oldImage)) {
            unlink($oldImage);
        }

        Book::find($book_id)->update([
            'thumbnail' => $save_url,
            'updated_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Book Thumbnail Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.book')->with($notification); 

    }// End Method 

    public function DeleteBook($id){
        $book = Book::find($id);
        unlink($book->thumbnail);

        Book::find($id)->delete();

        $notification = array(
            'message' => 'Book Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification); 

    }// End Method 

} 
