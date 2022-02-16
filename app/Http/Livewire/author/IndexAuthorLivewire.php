<?php

namespace App\Http\Livewire\author;

use App\Models\Book;
use App\Models\Author;
use App\Models\Borrow;
use Livewire\Component;
use App\Models\DetailBorrow;
use Illuminate\Support\Facades\Crypt;

class IndexAuthorLivewire extends Component
{
    public $form, $name_author, $address_author, $desc_author, $idauthors;


    public function render()
    {
        return view('dashboard.author.index-author-livewire', [
            'allauthor' => Author::paginate(5)
        ]);
    }
    public function create()
    {
        $this->form = 'store';
    }
    public function store()
    {
        $this->validate([
            'name_author' => 'required|unique:authors,name_author|max:100',
            'address_author' => 'required|min:10',
            'desc_author' => 'required|min:20',
        ]);

        Author::create([
            'name_author' => $this->name_author,
            'address_author' => $this->address_author,
            'desc_author' => $this->desc_author,
        ]);
        $this->cancel();
        session()->flash('success', 'Author successfully Created.');
    }
    public function edit($idauthor)
    {
        $this->form = 'update';
        $idauthor = Crypt::decrypt($idauthor);
        $findauthor = Author::findorfail($idauthor);
        $this->idauthors = $findauthor;
        $this->name_author = $findauthor->name_author;
        $this->address_author = $findauthor->address_author;
        $this->desc_author = $findauthor->desc_author;
    }
    public function update()
    {
        $this->validate([
            'name_author' => 'required|max:100||unique:authors,name_author,' . $this->idauthors->id,
            'address_author' => 'required|min:10',
            'desc_author' => 'required|min:20',
        ]);
        $this->idauthors->update([
            'name_author' => $this->name_author,
            'address_author' => $this->address_author,
            'desc_author' => $this->desc_author,
        ]);
        $this->cancel();
        session()->flash('success', 'Author successfully Update.');
    }
    public function destroy($idauthor)
    {
        $idauthor = Crypt::decrypt($idauthor);
        Author::destroy($idauthor);
        $this->cancel();
        session()->flash('success', 'Author successfully Created.');
    }
    public function show($idauthor)
    {
        $this->form = 'show';
        $idauthor = Crypt::decrypt($idauthor);
        $author = Author::findorfail($idauthor);
        $this->name_author = $author->name_author;
        $this->address_author = $author->address_author;
        $this->desc_author = $author->desc_author;
    }
    public function cancel()
    {
        $this->form = null;
        $this->name_author = null;
        $this->address_author = null;
        $this->desc_author = null;
        $this->idauthors = null;
    }
}
