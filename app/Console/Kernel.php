<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

// ✅ Toegevoegde commando’s
use App\Console\Commands\CleanMaterialCategories;
use App\Console\Commands\CleanCategoryMapping;
use App\Console\Commands\MigreerCategorieen;

class Kernel extends ConsoleKernel
{
    /**
     * De Artisan commands voor jouw applicatie.
     *
     * @var array
     */
    protected $commands = [
        MigreerCategorieen::class,
        CleanMaterialCategories::class,
        CleanCategoryMapping::class,
    ];

    /**
     * Plan geplande Artisan-taken.
     */
    protected function schedule(Schedule $schedule): void
    {
        // Bijvoorbeeld dagelijks uitvoeren:
        // $schedule->command('clean:category-mapping')->daily();
    }

    /**
     * Registreer de commands voor de applicatie.
     */
    protected function commands(): void
    {
        $this->load(_DIR_.'/Commands');
        require base_path('routes/console.php');
    }
}