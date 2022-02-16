<?php

namespace App\Http\Controllers;

use App\Models\Publisher;
use Illuminate\Http\Request;

class PublisherController extends Controller
{
    public function index()
    {
        return view('dashboard.publisher.indexpublishercontroller', [
            'allpublisher' => Publisher::all(),
        ]);
    }

    public function create()
    {
        return view('dashboard.publisher.createpublishercontroller');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_publisher' => 'required|unique:publishers,name_publisher|max:255',
            'address_publisher' => 'required|min:10',
            'desc_publisher' => 'required|min:20',
        ]);

        Publisher::create([
            'name_publisher' => $request->name_publisher,
            'address_publisher' => $request->address_publisher,
            'desc_address' => $request->desc_publisher,
        ]);

        return redirect('/dashboard/publisher');
    }
}
