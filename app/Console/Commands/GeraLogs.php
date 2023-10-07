<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Datalog;
use App\Models\Equipamentos;
use App\Models\Logevent;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class GeraLogs extends Command
{
    protected $signature = 'GeraLog:run';

    protected $description = 'Rotina de logs';

    public function handle(){
        $equipamentos = Equipamentos::all();
        foreach ($equipamentos as $equipamento) {
            $latestCapacity = Datalog::where('id_equipamento', $equipamento->id)
                ->orderBy('data_hora', 'desc')
                ->value('Battery_capacity');

            $previousCapacity = Datalog::where('id_equipamento', $equipamento->id)
                ->orderBy('data_hora', 'desc')
                ->skip(1)
                ->value('Battery_capacity');

            if ($previousCapacity == 100 && $latestCapacity != 100) {
                // Registra um novo log apenas quando a bateria sai de 100
                $logMessage = "A UPS mudou para alimentação por bateria.";
                $log = new Logevent();
                $log->id_equipamento = $equipamento->id;
                $log->data_cadastro = Carbon::now();
                $log->log = $logMessage;
                $log->save();

                $equipamento->log_gravado = false;
                $equipamento->save();

                Log::info("Log gravado com sucesso para o equipamento {$equipamento->id}");
            } elseif ($previousCapacity != 100 && $latestCapacity == 100) {
                // Registra um novo log apenas quando a bateria volta para 100
                $logMessage = "A energia elétrica foi restaurada.";
                $log = new Logevent();
                $log->id_equipamento = $equipamento->id;
                $log->data_cadastro = Carbon::now();
                $log->log = $logMessage;
                $log->save();

                $equipamento->log_gravado = false;
                $equipamento->save();

                Log::info("Log gravado com sucesso para o equipamento {$equipamento->id}");
            } elseif ($latestCapacity <= 10 && $equipamento->log_gravado == false) {
                // Registra um novo log apenas quando a bateria está abaixo de 10 e o log correspondente ainda não foi gravado
                $logMessage = "A capacidade da bateria do equipamento {$equipamento->id} esta abaixo de 10%. A UPS sera desligada.";
                $log = new Logevent();
                $log->id_equipamento = $equipamento->id;
                $log->data_cadastro = Carbon::now();
                $log->log = $logMessage;
                $log->save();

                $equipamento->log_gravado = true;
                $equipamento->save();

                $logMessage = "A UPS voltou de uma bateria fraca.";
                $log = new Logevent();
                $log->id_equipamento = $equipamento->id;
                $log->data_cadastro = Carbon::now();
                $log->log = $logMessage;
                $log->save();

                Log::info("Log gravado com sucesso para o equipamento {$equipamento->id}");
            }
        }        
        Log::info('Verificação realizada');
    }
 
}
