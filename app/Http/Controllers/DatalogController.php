<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DatalogController extends Controller
{
    public function index()
    {
        return view('datalog');
    }
}
