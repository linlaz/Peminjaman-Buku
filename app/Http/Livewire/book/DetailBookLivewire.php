<?php

namespace App\Http\Livewire\book;

use App\Models\Borrow;
use App\Models\DetailBorrow;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class DetailBookLivewire extends Component
{
    public $detail, $start_date, $end_date;
    public function render()
    {
        return view('book.detail-book-livewire');
    }
    public function borrow($idbook)
    {
        $this->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);
        if (Auth::user()) {
            $idbook = Crypt::decrypt($idbook);
            $findborrow = Borrow::where('id_book', $idbook)->whereRaw('? between start_borrow and finish_borrow', [$this->start_date])->first();
            if (is_null($findborrow)) {
                $idborrow = Borrow::create([
                    'id_user' => Auth::user()->id,
                    'id_book' => $idbook,
                    'start_borrow' => $this->start_date,
                    'finish_borrow' => $this->end_date,
                    'back' => '0'
                ]);

                DetailBorrow::create([
                    'id_borrow' => $idborrow->id,
                    'active' => '0'
                ]);

                $value = "successfully";
                $this->dispatchBrowserEvent('success', ['newName' => $value]);
                return redirect()->to('/borrow');
            } else {
                $value = "unsuccessfully because have a borrow";
                $this->dispatchBrowserEvent('success', ['newName' => $value]);
            }
        } else {
            $value = "unsuccessfully because you must login for borrow";
            $this->dispatchBrowserEvent('success', ['newName' => $value]);
            return redirect()->to('/login');
        }
    }
}
