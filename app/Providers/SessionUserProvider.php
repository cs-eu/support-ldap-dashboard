<?php

namespace App\Providers;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;

class SessionUserProvider extends ServiceProvider implements UserProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }

    public function retrieveById($identifier)
    {
        $user = Session::get('user');
        return $user;
    }

    public function retrieveByToken($identifier, $token)
    {
        throw new AuthenticationException();
    }

    public function updateRememberToken(Authenticatable $user, $token)
    {
        throw new AuthenticationException();
    }

    public function retrieveByCredentials(array $credentials)
    {
        throw new AuthenticationException();
    }

    public function validateCredentials(Authenticatable $user, array $credentials)
    {
        throw new AuthenticationException();
    }

    public function rehashPasswordIfRequired(Authenticatable $user, array $credentials, bool $force = false)
    {
        throw new AuthenticationException();
    }
}
