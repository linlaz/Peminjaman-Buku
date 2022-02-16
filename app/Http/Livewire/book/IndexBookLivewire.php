<?php

namespace App\Http\Livewire\book;

use App\Models\Book;
use App\Models\Borrow;
use App\Models\DetailBorrow;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Crypt;


class IndexBookLivewire extends Component
{
    use WithPagination;
    public function render()
    {
        return view('dashboard.book.index-book-livewire', [
            'allbook' => Book::paginate(5)
        ]);
    }

    public function destroy($idcategory)
    {
        $idcategory = Crypt::decrypt($idcategory);
        Book::destroy($idcategory);
        session()->flash('success', 'Category successfully Deleted.');
    }
}
