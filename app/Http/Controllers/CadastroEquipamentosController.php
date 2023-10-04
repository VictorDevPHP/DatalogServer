<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equipamentos;

class CadastroEquipamentosController extends Controller
{
    public function index()
    {
        return view('cadastroequipamento');
    }

    public function store(Request $request)
    {   
        // validar os dados do formulário
        $validatedData = $request->validate([
            'nome' => 'required|string|max:255',
            'ip' => 'required|ip',
            'porta' => 'required|integer',
            'versao_protocolo' => 'required|string|max:255',
            'comunidade_snmp' => 'required|string|max:255',
            'usuario_snmp' => 'required|string|max:255',
            'senha_snmp' => 'required|string|max:255',
        
        ]);
        
        // criar um novo equipamento com os dados validados
        $equipamento = new Equipamentos();
        $equipamento->nome = $validatedData['nome'];
        $equipamento->ip = $validatedData['ip'];
        $equipamento->porta = $validatedData['porta'];
        $equipamento->versao_protocolo = $validatedData['versao_protocolo'];
        $equipamento->comunidade_snmp = $validatedData['comunidade_snmp'];
        $equipamento->usuario_snmp = $validatedData['usuario_snmp'];
        $equipamento->senha_snmp = $validatedData['senha_snmp'];
        
        try {
            // salvar o equipamento no banco de dados
            $equipamento->save();
        } catch (\Exception $e) {
            // lidar com a exceção
            return redirect()->route('cadastroequipamento')->with('error', 'Erro ao cadastrar equipamento!');
        }
        // redirecionar para a página de visualização de equipamentos
        return redirect()->route('cadastroequipamento')->with('success', 'Equipamento cadastrado com sucesso!');
       
        
    }
    

}

