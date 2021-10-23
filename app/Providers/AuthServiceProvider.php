<?php

namespace App\Providers;

use App\Models\BlogPost;
use App\Models\User;
use App\Policies\BlogPostPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        'App\Models\BlogPost' => 'App\Policies\BlogPostPolicy'
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        /* Gate::define('update-post', function (User $user, BlogPost $blogPost) {
            return $user->id === $blogPost->user_id;
        });

        Gate::define('delete-post', function (User $user, BlogPost $blogPost) {
            return $user->id === $blogPost->user_id;
        }); */

        Gate::define('home.secret', function($user) {
            return $user->is_admin == 'true';
        });

        Gate::define('posts-update', [BlogPostPolicy::class, 'update']);
        Gate::define('posts-delete', [BlogPostPolicy::class, 'delete']);

        Gate::resource('posts', BlogPostPolicy::class);

        Gate::before(function ($user, $ability) {
            if($user->is_admin == 'true' && in_array($ability, ['update', 'delete'])) {
                return true;
            }
        });
    }
}
