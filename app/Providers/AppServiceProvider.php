<?php

namespace App\Providers;

use App\Http\Repositories\Blog\BlogRepository;
use App\Http\Repositories\Blog\IBlogRepository;
use App\Http\Repositories\User\IUserRepository;
use App\Http\Repositories\User\UserRepository;
use App\Http\Services\Blog\BlogService;
use App\Http\Services\Blog\IBlogService;
use App\Http\Services\Comment\CommentService;
use App\Http\Services\Comment\ICommentService;
use App\Http\Services\User\IUserService;
use App\Http\Services\User\UserService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(IUserService::class, UserService::class);
        $this->app->bind(IUserRepository::class, UserRepository::class);
        $this->app->bind(IBlogService::class, BlogService::class);
        $this->app->bind(IBlogRepository::class, BlogRepository::class);
        $this->app->bind(ICommentService::class, CommentService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
