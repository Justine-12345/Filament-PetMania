<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;

use App\Models\Animal;
use App\Models\User;
use App\Policies\AnimalPolicy;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Animal::class => AnimalPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::before(function (User $user, string $ability) {
            if (Auth::user()->role->name == "Admin") {
                return true;
            }
        });
    }
}
