<?php


namespace App\Providers;


use App\Services\Category\CategoryService;
use App\Services\Category\CategoryServiceInterface;
use App\Services\Image\ImageService;
use App\Services\Image\ImageServiceInterface;
use App\Services\User\UserService;
use App\Services\User\UserServiceInterface;
use Illuminate\Support\ServiceProvider;

/**
 * Class ServicesServiceProvider
 * @package App\Providers
 */
class ServicesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CategoryServiceInterface::class, CategoryService::class);
        $this->app->bind(ImageServiceInterface::class, ImageService::class);
        $this->app->bind(UserServiceInterface::class, UserService::class);
    }
}
