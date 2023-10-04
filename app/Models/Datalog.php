<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Datalog extends Model
{
    protected $table = 'dados_nobreaks'; // Nome da tabela no banco de dados (se for diferente de 'dados_nobreaks', ajuste conforme necessário)

    protected $fillable = [
        'id', 'id_equipamento', 'Battery_capacity',
        'Battery_runtime_remaining', 'Battery_status',
        'Battery_temperature', 'Battery_voltage',
        'Input_frequency_R', 'Input_frequency_S',
        'Input_frequency_T', 'Input_voltage_R',
        'Input_voltage_S', 'Input_voltage_T',
        'Output_Frequency', 'Output_load_R',
        'Output_load_S', 'Output_load_T', 'Output_voltage_R',
        'Output_voltage_S', 'Output_voltage_T', 'input_type',
        'Uptime', 'data_hora'];

    // Exemplo de um relacionamento (se houver)
    public function algumRelacionamento()
    {
        return $this->belongsTo(OutroModelo::class);
    }
}
