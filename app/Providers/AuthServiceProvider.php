<?php

namespace App\Providers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //update post
        // Gate::define('update-post',function(User $user , Post $post){
        //    return $user->id === $post->user_id;
        // });
        //delete post
        // Gate::define('delete-post',function(User $user , Post $post){
        //     return $user->id === $post->user_id;
        //  });

        // Blade::if('abc',function($x){
        //     return $x;
        // });

        // Blade::directive('myName',function($x){
        //     return "Lucien -->".$x;
        // });
    }
}
