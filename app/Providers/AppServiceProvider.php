<?php

namespace App\Providers;

use App\Models\Employer;
use App\Models\Job;
use App\Models\User;
use App\Policies\TestPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //

        foreach (['update-job', 'delete-job'] as $ability) {
            Gate::define($ability, function (User $user, Job $job) {
                return $user->id === $job->user_id;
            });
        }


        Gate::define("create-job", [TestPolicy::class, "create"]);
    }
}
