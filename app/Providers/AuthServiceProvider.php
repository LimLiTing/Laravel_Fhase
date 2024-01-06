<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Firebase\Guard as FirebaseGuard;
use App\Firebase\FirebaseUserProvider;

class AuthServiceProvider extends ServiceProvider
{
  /**
  * The policy mappings for the application.
  *
  * @var array
  */
  protected $policies = [
    // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    User::class => UserPolicy::class,
  ];

  /**
  * Register any authentication / authorization services.
  *
  * @return void
  */
  public function boot() {

    $this->registerPolicies();

    \Illuminate\Support\Facades\Auth::provider('firebaseuserprovider', function($app, array $config) {
      return new FirebaseUserProvider($app['hash'], $config['model']);
    });

    // Define gates for roles
    Gate::define('admin', function ($user) {
      return $user->hasRole('admin');
  });

  Gate::define('editor', function ($user) {
      return $user->hasRole('editor');
  });
  }
}
