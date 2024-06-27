<?php

namespace App\Providers;

use App\Models\Menu;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
//        Menu::truncate();
//        Artisan::call('db:seed --class=MenuTableSeeder');

    }
}
