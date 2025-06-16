<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

// Toegevoegde commando’s
use App\Console\Commands\CleanMaterialCategories;
use App\Console\Commands\CleanCategoryMapping;

class Kernel extends ConsoleKernel
{
    /**
     * De Artisan commands voor jouw applicatie.
     *
     * @var array
     */
    protected $commands = [
        CleanMaterialCategories::class,
        CleanCategoryMapping::class, // ✅ Voeg dit toe voor mapping cleanup
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
        $this->load(__DIR__.'/Commands'); // ✅ correcte directory
        require base_path('routes/console.php');
    }
}