<?php

namespace App\Providers;

use App\Services\Authentication\Abstracts\AuthenticationServiceInterface;
use App\Services\Authentication\AuthenticationService;
use App\Services\Departments\Abstracts\DepartmentsServiceInterface;
use App\Services\Departments\DepartmentsService;
use App\Services\Workers\Abstracts\WorkersServiceInterface;
use App\Services\Workers\WorkersService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * @var array|string[]
     */
    protected array $mappings = [
        AuthenticationServiceInterface::class => AuthenticationService::class,
        DepartmentsServiceInterface::class => DepartmentsService::class,
        WorkersServiceInterface::class => WorkersService::class,
    ];
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        foreach ($this->mappings as $abstract => $concrete) {
            $this->app->singleton($abstract, $concrete);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        //
    }
}
