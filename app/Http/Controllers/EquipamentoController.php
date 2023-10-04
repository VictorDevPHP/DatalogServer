<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equipamentos;

class EquipamentoController extends Controller
{
    public function index()
    {
        $equipamentos = Equipamentos::all();
        return view('equipamentos.index', compact('equipamentos'));
    }

    public function create()
    {
        return view('equipamentos.create');
    }

    public function store(Request $request)
    {
        $equipamento = new Equipamentos;
        $equipamento->nome = $request->nome;
        $equipamento->modelo = $request->modelo;
        $equipamento->numero_serie = $request->numero_serie;
        $equipamento->save();

        return redirect()->route('equipamentos.index')->with('success', 'Equipamento cadastrado com sucesso!');
    }

    public function edit($id)
    {
        $equipamento = Equipamentos::findOrFail($id);
        return view('equipamentos.edit', compact('equipamento'));
    }

    public function update(Request $request, $id)
    {
        $equipamento = Equipamentos::findOrFail($id);
        $equipamento->nome = $request->nome;
        $equipamento->modelo = $request->modelo;
        $equipamento->numero_serie = $request->numero_serie;
        $equipamento->save();

        return redirect()->route('equipamentos.index')->with('success', 'Equipamento atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $equipamento = Equipamentos::findOrFail($id);
        $equipamento->delete();

        return redirect()->route('equipamentos.index')->with('success', 'Equipamento excluído com sucesso!');
    }
}
