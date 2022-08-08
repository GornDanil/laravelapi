<?php

namespace App\Providers;

use App\Repositories\Authentication\Abstracts\UserRepositoryInterface;
use App\Repositories\Authentication\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryProvaider extends ServiceProvider
{
    /** @var string[] */
    protected array $mappings = [
        UserRepositoryInterface::class => UserRepository::class,
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        foreach ($this->mappings as $abstract => $concrete) {
            $this->app->singleton($abstract, $concrete);
        }
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
