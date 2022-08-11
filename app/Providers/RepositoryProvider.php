<?php

namespace App\Providers;

use App\Repositories\Authentication\Abstracts\UserRepositoryInterface;
use App\Repositories\Authentication\UserRepository;
use App\Repositories\Departments\Abstracts\DepartmentRepositoryInterface;
use App\Repositories\Departments\DepartmentRepository;
use App\Repositories\Images\Abstracts\ImagesRepositoryInterface;
use App\Repositories\Images\ImagesRepository;
use App\Repositories\Workers\Abstracts\WorkersRepositoryInterface;
use App\Repositories\Workers\WorkersRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryProvider extends ServiceProvider
{
    /** @var string[] */
    protected array $mappings = [
        UserRepositoryInterface::class => UserRepository::class,
        DepartmentRepositoryInterface::class => DepartmentRepository::class,
        WorkersRepositoryInterface::class => WorkersRepository::class,
        ImagesRepositoryInterface::class => ImagesRepository::class
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
