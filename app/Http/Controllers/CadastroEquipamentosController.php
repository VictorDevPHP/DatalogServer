<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equipamentos;

class CadastroEquipamentosController extends Controller
{
    public function index()
    {
        return view('cadastroequipamento')->extends('layouts.app');
    }

    public function store(Request $request)
    {   
        $equipamento = new Equipamentos();
        $equipamento->nome = $request->input('nome');
        $equipamento->ip = $request->input('ip');
        $equipamento->porta = $request->input('porta');
        $equipamento->versao_protocolo = $request->input('versao_protocolo');
        $equipamento->comunidade_snmp = $request->input('comunidade_snmp');
        $equipamento->usuario_snmp = $request->input('usuario_snmp');
        $equipamento->senha_snmp = $request->input('senha_snmp');
        $equipamento->save();

        return view('cadastroequipamento')->extends('layouts.app');
    }
    

}

