<?php

namespace App\Providers;

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
        // Prevent broken pipe errors
        ignore_user_abort(true);
        set_time_limit(0);
        
        // Disable output buffering
        if (ob_get_level()) {
            ob_end_clean();
        }
    }
}
