<?php

namespace App\Providers;

use App\Libraries\General;
use App\Models\Hotel;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        View::share('deletedUsers',User::onlyTrashed()->count()); // Counts Deleted Users and returns the result in the dashboard.
        View::share('deletedHotels',Hotel::onlyTrashed()->count()); // Counts Deleted Hotels and returns the result in the dashboard.

//Fills up Enum Lists for Adding Forms
        //Add Staff Members
        View::share('employmentType',General::getEnumValues('staff','employmenttype'));
        View::share('status',General::getEnumValues('staff','status'));
        View::share('personalLicense',General::getEnumValues('staff','personallicense'));
        View::share('hotels',Hotel::all());

        View::share('rota0',General::FindMeAMonday(Carbon::now()));
        View::share('rota1',General::FindMeAMonday(Carbon::now()->addWeek()));
        View::share('rota2',General::FindMeAMonday(Carbon::now()->addWeek(2)));
        View::share('rota3',General::FindMeAMonday(Carbon::now()->addWeek(3)));
        View::share('rota4',General::FindMeAMonday(Carbon::now()->addWeek(4)));


            }
}
