<?php

namespace App\Http\Livewire\category;

use App\Models\Category;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;

class IndexCategoryLivewire extends Component
{
    public $name, $category, $form;
    public function render()
    {
        return view('dashboard.category.index-category-livewire', [
            'allcategory' => Category::paginate(5)
        ]);
    }
    public function create()
    {
        $this->name = null;
        $this->form = 'create';
    }
    public function store()
    {

        $this->validate([
            'name' => "required|max:50|unique:categories,name_category"
        ]);
        Category::create([
            'name_category' => $this->name,
            'slug_category' => Str::of($this->name)->slug('-'),
        ]);
        $this->cancel();
        session()->flash('success', 'Category successfully Created.');
    }
    public function show($idcategory)
    {
        $this->form = 'show';
        $idcategory = Crypt::decrypt($idcategory);
        $this->name = Category::findorfail($idcategory)->name_category;
    }
    public function cancel()
    {
        $this->form = null;
    }
    public function destroy($idcategory)
    {
        $idcategory = Crypt::decrypt($idcategory);
        Category::destroy($idcategory);
        session()->flash('success', 'Category successfully Deleted.');
    }
}
