<?php

namespace App\Http\Livewire\publisher;

use Livewire\Component;
use App\Models\Publisher;
use Illuminate\Support\Facades\Crypt;

class IndexPublisherLivewire extends Component
{
    public $form, $name_publisher, $address_publisher, $desc_address, $idpublisher;
    public function render()
    {
        return view('dashboard.publisher.index-publisher-livewire', [
            'allpublisher' => Publisher::paginate(5)
        ]);
    }
    public function create()
    {
        $this->form = 'store';
    }
    public function store()
    {
        $this->validate([
            'name_publisher' => 'required|unique:publishers,name_publisher|max:100',
            'address_publisher' => 'required|min:10',
            'desc_address' => 'required|min:20',
        ]);

        Publisher::create([
            'name_publisher' => $this->name_publisher,
            'address_publisher' => $this->address_publisher,
            'desc_address' => $this->desc_address,
        ]);
        $this->cancel();
        session()->flash('success', 'publisher successfully Created.');
    }
    public function edit($idpublisher)
    {
        $this->form = 'update';
        $idpublisher = Crypt::decrypt($idpublisher);
        $findpublisher = Publisher::findorfail($idpublisher);
        $this->idpublisher = $findpublisher;
        $this->name_publisher = $findpublisher->name_publisher;
        $this->address_publisher = $findpublisher->address_publisher;
        $this->desc_address = $findpublisher->desc_address;
    }
    public function destroy($idpublisher)
    {
        $idpublisher = Crypt::decrypt($idpublisher);
        Publisher::destroy($idpublisher);
        $this->cancel();
        session()->flash('success', 'publisher successfully Created.');
    }
    public function show($idpublisher)
    {
        $this->form = 'show';
        $idpublisher = Crypt::decrypt($idpublisher);
        $publisher = Publisher::findorfail($idpublisher);
        $this->name_publisher = $publisher->name_publisher;
        $this->address_publisher = $publisher->address_publisher;
        $this->desc_address = $publisher->desc_address;
    }
    public function update()
    {
        $this->validate([
            'name_publisher' => 'required|max:100||unique:publishers,name_publisher,' . $this->idpublisher->id,
            'address_publisher' => 'required|min:10',
            'desc_address' => 'required|min:20',
        ]);
        $this->idpublisher->update([
            'name_publisher' => $this->name_publisher,
            'address_publisher' => $this->address_publisher,
            'desc_address' => $this->desc_address,
        ]);
        $this->cancel();
        session()->flash('success', 'Publisher successfully Update.');
    }
    public function cancel()
    {
        $this->form = null;
        $this->name_publisher = null;
        $this->address_publisher = null;
        $this->desc_address = null;
    }
}
