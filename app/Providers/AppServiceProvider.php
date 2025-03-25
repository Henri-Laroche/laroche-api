<?php

namespace App\Providers;

use App\Repositories\Contracts\ProfileRepositoryInterface;
use App\Repositories\Eloquent\ProfileRepository;
use App\Services\Contracts\AuthServiceInterface;
use App\Services\Contracts\CommentServiceInterface;
use App\Services\Contracts\ProfileServiceInterface;
use App\Services\Implementations\AuthService;
use App\Services\Implementations\CommentService;
use App\Services\Implementations\ProfileService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(AuthServiceInterface::class, AuthService::class);
        $this->app->bind(ProfileRepositoryInterface::class, ProfileRepository::class);
        $this->app->bind(ProfileServiceInterface::class, ProfileService::class);
        $this->app->bind(CommentServiceInterface::class, CommentService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
