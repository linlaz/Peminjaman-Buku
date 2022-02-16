<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use App\Models\Borrow;
use App\Models\Category;
use App\Models\Publisher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class BookController extends Controller
{
    public $findbook;
    public function index()
    {
        return view('dashboard.book.indexcontrollerbook');
    }
    public function indexpage()
    {
        return view('welcome', [
            'books' => Book::where('active', '1')->get()
        ]);
    }

    public function create()
    {
        $category = Category::all();
        $publisher = Publisher::all();
        $author = Author::all();
        return view('dashboard.book.createcontrollerbook', [
            'category' => $category,
            'publisher' => $publisher,
            'author' => $author
        ]);
    }

    public function store(Request $request)
    {
        
        $request->validate([
            'name_book' => 'required|unique:books,name|min:10|max:40',
            'published_book' => 'required',
            'desc_book' => 'required|min:10',
            'publisher_book' => 'required',
            'author_book' => 'required',
            'category_book' => 'required',
            'thumbnail_book' => 'required|mimes:jpeg,jpg,png',
            'type_book' => 'required',
        ]);
        $name_thumbnail = $request->file('thumbnail_book')->store('thumbnail');
        Book::Create([
            'name' => $request->name_book,
            'published_at' => $request->published_book,
            'desc_book' => $request->desc_book,
            'id_publisher' => $request->publisher_book,
            'id_author' => $request->author_book,
            'id_category' => $request->category_book,
            'thumbnail' => $name_thumbnail,
            'type_book' => $request->type_book,
            'active' => '1'
        ]);

        return redirect('/dashboard/book');
    }
    public function detailpage($idbook)
    {
        $idbook = Crypt::decrypt($idbook);
        $findbook = Book::findorfail($idbook);
        return view('book.detailbookcontroller', ['detail' => $findbook]);
    }
    public function edit($idbook)
    {
        $idbook = Crypt::decrypt($idbook);
        $this->findbook = Book::findorfail($idbook);
        $category = Category::all();
        $publisher = Publisher::all();
        $author = Author::all();
        return view('dashboard.book.detailbookcontroller', [
            'detail' => $this->findbook,
            'category' => $category,
            'publisher' => $publisher,
            'author' => $author
        ]);
    }
    public function update(Request $request)
    {
        
        $request->validate([
            'name_book' => 'required|min:10|max:40|unique:books,name,' . $request->id_book,
            'published_book' => 'required',
            'desc_book' => 'required|min:10',
            'publisher_book' => 'required',
            'author_book' => 'required',
            'category_book' => 'required',
            'thumbnail_book' => 'unique:books,thumbnail,' . $request->id_book,
            'type_book' => 'required',
        ]);

        $findbook = Book::findorfail($request->id_book);
        if ($request->hasFile('thumbnail_book')) {
            $name_thumbnail = $request->file('thumbnail_book')->store('thumbnail');
        } else {
            $name_thumbnail = $findbook->thumbnail;
        }
        $findbook->update([
            'name' => $request->name_book,
            'published_at' => $request->published_book,
            'desc_book' => $request->desc_book,
            'id_publisher' => $request->publisher_book,
            'id_author' => $request->author_book,
            'id_category' => $request->category_book,
            'thumbnail' => $name_thumbnail,
            'type_book' => $request->type_book,
            'active' => '1'
        ]);
        return redirect('dashboard/book');
    }
    public function detailborrow()
    {
        return view('book.detailborrow');
    }
}
