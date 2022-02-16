<?php

namespace App\Http\Controllers;

use App\Models\DetailBorrow;
use Illuminate\Http\Request;

class BorrowController extends Controller
{
    public function index()
    {
        return view('dashboard.borrow.indexborrowcontroller');
       
    }
}
