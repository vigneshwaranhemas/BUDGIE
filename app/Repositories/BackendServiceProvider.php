<?php
namespace App\Repositories;

use Illuminate\Support\ServiceProvider;

class BackendServiceProvider extends ServiceProvider
{
    public function register() {

        $this->app->bind(
            'App\Repositories\IAdminRepository',
            'App\Repositories\AdminRepository'
        );

        $this->app->bind(
            'App\Repositories\IBuddyrepositories',
            'App\Repositories\Buddyrepositories'
        );
        $this->app->bind(
            'App\Repositories\IEventCategoryrepositories',
            'App\Repositories\EventCategoryrepositories'
        );
        $this->app->bind(
            'App\Repositories\IEventTypeRepositories',
            'App\Repositories\EventTyperepositories'
        );
        $this->app->bind(
            'App\Repositories\IEventRepositories',
            'App\Repositories\EventRepositories'
        );
        $this->app->bind(
            'App\Repositories\IPreOnboardingrepositories',
            'App\Repositories\PreOnboardingrepositories'
        );
        $this->app->bind(
            'App\Repositories\IHrPreonboardingrepositories',
            'App\Repositories\HrPreonboardingrepositories'
        );
        $this->app->bind(
            'App\Repositories\IHolidayRepository',
            'App\Repositories\HolidayRepository'
        );
        $this->app->bind(
            'App\Repositories\IProfileRepositories',
            'App\Repositories\ProfileRepositories'
        );
        $this->app->bind(
            'App\Repositories\IITInfraRepository',
            'App\Repositories\ITInfraRepository'
        );
        $this->app->bind(
            'App\Repositories\ICommonRepositories',
            'App\Repositories\CommonRepositories'
        );
        $this->app->bind(
            'App\Repositories\IPeopleRepository',
            'App\Repositories\PeopleRepository'
        );
        $this->app->bind(
            'App\Repositories\IGoalRepository',
            'App\Repositories\GoalRepository'
        );

    }

    /**
     * Bootstrap services. 
     *
     * @return void
     */
    public function boot()
    {

    }
}


?>
