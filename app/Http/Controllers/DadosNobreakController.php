<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DadosNobreak;
use App\Models\Equipamentos;
use Illuminate\Support\Facades\Log;


class DadosNobreakController extends Controller
{
    public function index(Request $request)
    {
        $equipamentos = Equipamentos::all();
        $selectedEquipamento = $request->query('equipamento');
        $dadosNobreak = DadosNobreak::when($selectedEquipamento, function ($query, $selectedEquipamento) {
            return $query->where('id_equipamento', $selectedEquipamento);
        })->get();
        Log::channel('atividades')->info('O usuario '. auth()->user()->name. ' acessou o DashBoard');
        return view('dashboard', compact('dadosNobreak', 'equipamentos', 'selectedEquipamento'));
    }


    public function show($id)
    {
        $equipamentos = Equipamentos::all();
        $selectedEquipamento = $id;

        $dadosNobreak = DadosNobreak::where('id_equipamento', $id)
                        ->orderBy('data_cadastro', 'desc')
                        ->paginate(20);

        return view('dashboard', compact('dadosNobreak', 'equipamentos', 'selectedEquipamento'));
    }

    public function getLogs($id_equipamento)
    {
        $logs = DadosNobreak::where('id_equipamento', $id_equipamento)->get();
        return response()->json($logs);
    }


}
