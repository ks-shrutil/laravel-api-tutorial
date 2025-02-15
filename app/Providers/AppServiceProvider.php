<?php

namespace App\Providers;

use App\Exceptions\Handler;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class AppServiceProvider extends ServiceProvider
{

    public function register(): void
    {
        $this->app->singleton(ExceptionHandler::class, Handler::class);
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function boot(): void
    {
        $this->loadRoutes();
    }



    /**
     * Undocumented function
     *
     * @return void
     */
    protected function loadRoutes(): void
    {
        Route::middleware('api')
            ->prefix('api')
            ->group(base_path('routes/api.php'));
        Route::middleware('api')
            ->prefix('api/v1')
            ->group(base_path('routes/api_v1.php'));
        Route::middleware('web')
            ->group(base_path('routes/web.php'));
    }
}
