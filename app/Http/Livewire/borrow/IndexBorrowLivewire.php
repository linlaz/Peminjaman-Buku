<?php

namespace App\Http\Livewire\borrow;

use App\Models\Borrow;
use Livewire\Component;
use App\Models\Category;
use App\Models\DetailBorrow;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Crypt;

class IndexBorrowLivewire extends Component
{
    use WithPagination;
    public function render()
    {
        return view('dashboard.borrow.index-borrow-livewire', [
            'borrow' =>  DetailBorrow::with('borrow')->paginate(5)
        ]);
    }
    public function acc($idborrow)
    {
        $idborrow = Crypt::decrypt($idborrow);
        $detail = DetailBorrow::where('id_borrow',$idborrow)->first();
        $detail->update([
            'active' =>'1'
        ]);
        Borrow::findorfail($idborrow)->update(['back'=>'1']);
        session()->flash('success', 'Category successfully Deleted.');
    }
}
