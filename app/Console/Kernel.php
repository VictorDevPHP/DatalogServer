<?php

namespace App\Console;

use App\Models\Datalog;
use App\Models\Equipamentos;
use App\Models\Logevent;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('backup:run')
            ->daily()->at('02:00');

        $schedule->command('GeraLog:run')
            ->everyTenMinutes();
    }

    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');
        $this->load(__DIR__ . '/Commands/Backup.php');
        require base_path('routes/console.php');
    }
}