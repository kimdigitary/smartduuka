<?php

namespace App\Console;

use App\Models\Expense;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule): void
    {
        $now = now('Africa/Kampala');
        $day = $now->day;
        $month = $now->month;
        $schedule->call(function () use ($now) {
            Expense::where([
                'isRecurring' => 1,
                'recurs'      => 3,
            ])
//                ->where('repeats_on', '<=', $now->format('Y-m-d H:i:s'))
                ->chunkById(200, function (Collection $expenses) use ($now) {
                    $expenses->each(function ($expense) {

                    });
                });
        })->everyMinute();
    }

    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
