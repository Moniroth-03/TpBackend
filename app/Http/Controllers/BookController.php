<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    public function index(){
        $books = Book::all();
        return view("books.index",['books'=>$books]);
     
    }
    public function create(){
        return view("books.create");
    }
    public function store(Request $request){
        // show all column
        // dd($request);
        // show a specific column
        // dd($request->title);
        $data = $request->validate([
            "title" => "required",
            "price" => "required|numeric",
            "quantity" => "required|numeric",
            "description" => "required",
        ]);
        $newBook = Book::create($data);
        return redirect(route("book.index"));
    }
    public function edit(Book $book){
        return view('books.edit',['book'=>$book]);
    }
    public function update(Book $book, Request $request){
        $data = $request->validate([
            "title" => "required",
            "price" => "required|numeric",
            "quantity" => "required|numeric",
            "description" => "required",
        ]);
        $book->update($data);
        return redirect(route('book.index'))->with('success,"update sucessfully');
    }
    public function delete(Book $book){
        $book -> delete();
        return redirect(route('book.index'))->with('success,"delete sucessfully');
    }
}
