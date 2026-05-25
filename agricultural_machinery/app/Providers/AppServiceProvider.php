<?php

declare(strict_types=1);

namespace App\Providers;

use App\Models\CarImage;
use App\Models\Category;
use App\Models\MachineModel;
use App\Models\Manufacturer;
use App\Observers\CarImageObserver;
use App\Observers\CategoryObserver;
use App\Observers\MachineModelObserver;
use App\Observers\ManufacturerObserver;
use App\Repositories\Contracts\CarImageRepositoryInterface;
use App\Repositories\Contracts\CarRepositoryInterface;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Contracts\CompanyRepositoryInterface;
use App\Repositories\Contracts\MachineModelRepositoryInterface;
use App\Repositories\Contracts\ManufacturerRepositoryInterface;
use App\Repositories\Contracts\WorkingTimeRepositoryInterface;
use App\Repositories\Eloquent\CarImageRepository;
use App\Repositories\Eloquent\CarRepository;
use App\Repositories\Eloquent\CategoryRepository;
use App\Repositories\Eloquent\CompanyRepository;
use App\Repositories\Eloquent\MachineModelRepository;
use App\Repositories\Eloquent\ManufacturerRepository;
use App\Repositories\Eloquent\WorkingTimeRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(CompanyRepositoryInterface::class, CompanyRepository::class);
        $this->app->bind(WorkingTimeRepositoryInterface::class, WorkingTimeRepository::class);
        $this->app->bind(ManufacturerRepositoryInterface::class, ManufacturerRepository::class);
        $this->app->bind(MachineModelRepositoryInterface::class, MachineModelRepository::class);
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(CarRepositoryInterface::class, CarRepository::class);
        $this->app->bind(CarImageRepositoryInterface::class, CarImageRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Manufacturer::observe(ManufacturerObserver::class);
        MachineModel::observe(MachineModelObserver::class);
        Category::observe(CategoryObserver::class);
        CarImage::observe(CarImageObserver::class);
    }
}
