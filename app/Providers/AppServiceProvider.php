<?php

namespace App\Providers;

use App\Models\Period;
use Illuminate\Support\Facades\Auth;
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
        if (Auth::check() && ! session()->has('active_period_id')) {

            $latestPeriod = Period::where('company_id', Auth::user()->company->id)
                ->latest('created_at') // atau ->orderBy('year', 'desc')
                ->first();

            if ($latestPeriod) {
                session(['active_period_id' => $latestPeriod->id]);
            }
            // kalau NULL → biarin aja, jangan set session
        }
    }
}
