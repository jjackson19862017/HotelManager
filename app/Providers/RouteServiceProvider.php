<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * The path to the "home" route for your application.
     *
     * @var string
     */
    public const HOME = '/';
    public const ADMIN = '/admin';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        $this->mapUserRoutes();

        $this->mapHotelRoutes();

        $this->mapPermissionRoutes();

        $this->mapRoleRoutes();

        $this->mapStaffRoutes();

        $this->mapPositionsRoutes();

        $this->mapCustomerRoutes();
        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/web/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/api/api.php'));
    }

    protected function mapUserRoutes()
    {
        Route::prefix('admin')
            ->middleware(['web'])
            ->namespace($this->namespace)
            ->group(base_path('routes/user/users.php'));
    }

    protected function mapHotelRoutes()
    {
        Route::prefix('admin')
            ->middleware(['web'])
            ->namespace($this->namespace)
            ->group(base_path('routes/hotel/hotels.php'));
    }

    protected function mapRoleRoutes()
    {
        Route::prefix('admin')
            ->middleware(['web'])
            ->namespace($this->namespace)
            ->group(base_path('routes/user/roles.php'));
    }

    protected function mapPermissionRoutes()
    {
        Route::prefix('admin')
            ->middleware(['web'])
            ->namespace($this->namespace)
            ->group(base_path('routes/user/permissions.php'));
    }

    protected function mapStaffRoutes()
    {
        Route::prefix('admin')
            ->middleware(['web'])
            ->namespace($this->namespace)
            ->group(base_path('routes/staff/staffs.php'));
    }

    protected function mapPositionsRoutes()
    {
        Route::prefix('admin')
            ->middleware(['web'])
            ->namespace($this->namespace)
            ->group(base_path('routes/staff/positions.php'));
    }

    protected function mapCustomerRoutes()
    {
        Route::prefix('admin')
            ->middleware(['web'])
            ->namespace($this->namespace)
            ->group(base_path('routes/events/customers.php'));
    }
}
