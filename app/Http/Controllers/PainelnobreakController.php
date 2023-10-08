<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class PainelnobreakController extends Controller
{
    protected function index()
    {   
        Log::channel('atividades')->info('O usuario '. auth()->user()->name. ' acessou o Painel');
        return view('painelnobreak');
    }
}
