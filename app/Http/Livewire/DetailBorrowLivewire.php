<?php

namespace App\Http\Livewire;

use App\Models\Borrow;
use App\Models\DetailBorrow;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class DetailBorrowLivewire extends Component
{
    use WithPagination;
    public function render()
    {
        $borrow = Borrow::with('book')->where('id_user', Auth::user()->id)->paginate(5);
        return view('book.detail-borrow-livewire', [
            'list' => $borrow
        ]);
    }
    public function destroy($idborrow)
    {
        $idborrow = Crypt::decrypt($idborrow);
        DetailBorrow::where('id_borrow', $idborrow)->delete();
        Borrow::destroy($idborrow);
        $this->dispatchBrowserEvent('success');
    }
}
