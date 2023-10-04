<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Logevent extends Model
{
    protected $table = 'log_event'; // Nome da tabela no banco de dados (se for diferente de 'log event', ajuste conforme necessário)

    protected $fillable = ['id_equipamento', 'data_cadastro', 'log']; // Colunas preenchíveis em massa

    // Aqui você pode definir relacionamentos, acessores, mutadores ou outras configurações do modelo

    // Exemplo de um relacionamento (se houver)
    public function algumRelacionamento()
    {
        return $this->belongsTo(OutroModelo::class);
    }
}
