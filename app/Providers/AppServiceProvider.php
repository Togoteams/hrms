<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Traits\GlobalTraits;
class AppServiceProvider extends ServiceProvider
{
    use GlobalTraits;
    /**
     * Register any application services.
     */
    public function register(): void
    {
      
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        // $result = $this->updateCurrentLeaveOfEachEmployee();
        
        // // You can use $result as needed
        // // For example, you can bind it to the service container:
        // $this->app->bind('exampleResult', function () use ($result) {
        //     return $result;
        // });
    }
    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['exampleResult'];
    }

}
