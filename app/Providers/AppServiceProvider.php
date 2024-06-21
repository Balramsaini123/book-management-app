<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Interfaces\BookRepositoryInterface;
use App\Repositories\BookRepository;
use App\Repositories\Interfaces\DownloadedBookRepositoryInterface;
use App\Repositories\DownloadedBookRepository;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\UserRepository;
use App\Services\BookService;
use App\Services\UserService;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(BookRepositoryInterface::class, BookRepository::class);
        $this->app->bind(DownloadedBookRepositoryInterface::class, DownloadedBookRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(BookService::class);
        $this->app->bind(UserService::class);
    }

    public function boot()
    {
        // Method is empty
    }
}
