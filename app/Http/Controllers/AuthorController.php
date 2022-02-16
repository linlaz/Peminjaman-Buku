<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class AuthorController extends Controller
{
    public function index()
    {
        return view('dashboard.author.indexcontrollerauthor');
    }
    public function create()
    {
        return view('dashboard.author.createcontrollerauthor');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name_author' => 'required|unique:authors,name_author|max:255',
            'address_author' => 'required|min:10',
            'desc_author' => 'required|min:20',
        ]);

        Author::create([
            'name_author' => $request->name_author,
            'address_author' => $request->address_author,
            'desc_author' => $request->desc_author,
        ]);

        return redirect('/dashboard/author');
    }
    public function edit($idauthor)
    {
        $idauthor = Crypt::decrypt($idauthor);
        $findauthor = Author::findorfail($idauthor);
        return view('dashboard.author.editcontrollerauthor', [
            'author' => $findauthor,
        ]);
    }
    public function update(Request $request)
    {
        $request->validate([
            'name_author' => 'required|unique:authors,name_author|max:255',
            'address_author' => 'required|min:10',
            'desc_author' => 'required|min:20',
        ]);
        $idauthor = Crypt::decrypt($request->id_author);
        $findauthor = Author::findorfail($idauthor);
        $findauthor->update([
            'name_author' => $request->name_author,
            'address_author' => $request->address_author,
            'desc_author' => $request->desc_author,
        ]);

        return redirect('/dashboard/author');
    }
}
