<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Comments;
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
        Gate::define('check-admin', function (User $user) {
            return $user->id === 1;
        });
        Gate::define('delete-comment', function (User $user, Comments $comment) {
            return $user->id === 1 || $user->id === $comment->user_id;
        });
    }
}
