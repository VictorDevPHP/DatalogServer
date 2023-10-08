<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Atividades extends Controller
{
    public $logsContent;

    public function render()
    {

        return view('nav.logs');
    }

    public function show()
    {
        $logsPath = storage_path('logs\atividades.log');
        $logs = fopen($logsPath, 'r');

        if (!empty($logs) || $logs != null) {
            $logsContent = fread($logs, filesize($logsPath));
            fclose($logs);
        }
        // dd($logsContent);

        return view('nav.logs', compact('logsContent'));
    }

}