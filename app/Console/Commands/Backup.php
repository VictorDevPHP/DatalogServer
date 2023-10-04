<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Backup extends Command
{
    protected $signature = 'backup:run';

    protected $description = 'Run database backup';

    public function handle()
    {
        $backupDirectory = ('C:/laragon/backup');
        $backupFileName = 'monitoramento_snmp-' . date('d-m-Y') . '.sql';
        $backupFilePath = $backupDirectory . '/' . $backupFileName;
    
        $command = sprintf(
            'C:\xampp\mysql\bin\mysqldump --user=%s --password=%s --host=%s %s > %s',
            env('DB_USERNAME'),
            env('DB_PASSWORD'),
            env('DB_HOST'),
            env('DB_DATABASE'),
            $backupFilePath
        );
    
        exec($command);
    
        $this->info('Backup realizado');
    }
}
