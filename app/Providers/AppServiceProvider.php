<?php

namespace App\Providers;

use App\Models\Division;
use App\Models\Organization;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view): void {
            static $organization = null;
            static $divisions = null;
            static $loaded = false;

            if (! $loaded) {
                $loaded = true;

                try {
                    $organization = Organization::query()
                        ->where('active', true)
                        ->latest()
                        ->first();

                    $divisions = Division::query()
                        ->where('active', true)
                        ->orderBy('name')
                        ->limit(6)
                        ->get();
                } catch (\Throwable) {
                    // DB tidak tersedia, view menerima null
                }
            }

            $view->with('globalOrganization', $organization);
            $view->with('globalDivisions', $divisions);
        });
    }
}
