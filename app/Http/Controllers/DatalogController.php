<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class DatalogController extends Controller
{
    public function index()
    {
        Log::channel('atividades')->info('O usuario '. auth()->user()->name. ' acessou o DataLog');
        return view('datalog');
    }
}
