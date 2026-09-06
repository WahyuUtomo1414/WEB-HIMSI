<?php

namespace App\Providers;

use App\Support\PublicData\GlobalData;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        View::composer('*', function ($view): void {
            GlobalData::load();

            $view->with('globalOrganization', GlobalData::organization());
            $view->with('globalDivisions', GlobalData::divisions());
            $view->with('globalAiEnabled', GlobalData::aiEnabled());
            $view->with('globalAiGreeting', GlobalData::aiGreeting());
        });
    }
}
