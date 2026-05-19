<?php

namespace App\Providers;

use App\Repositories\Eloquent\EloquentAttendanceRepository;
use App\Repositories\Eloquent\EloquentStudentRepository;
use App\Repositories\Interfaces\AttendanceRepositoryInterface;
use App\Repositories\Interfaces\StudentRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(StudentRepositoryInterface::class, EloquentStudentRepository::class);
        $this->app->bind(AttendanceRepositoryInterface::class, EloquentAttendanceRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
