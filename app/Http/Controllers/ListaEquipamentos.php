<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equipamentos;

class ListaEquipamentos extends Controller
{
    public function render(){

        $equipamentos = Equipamentos::all();
        return view('lista.listaEquipamentos', compact('equipamentos'));
    }
}
