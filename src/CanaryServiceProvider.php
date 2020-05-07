<?php

namespace RandomState\Canary;

use Illuminate\Support\Facades\Gate;
use RandomState\Canary\Laravel\Cage;
use Illuminate\Support\ServiceProvider;
use RandomState\Canary\Laravel\Cageable;

class CanaryServiceProvider extends ServiceProvider
{
    public static $skipMigrations = false;

    public function register()
    {
        Gate::before(function ($authorizable, $ability) {
            if ($authorizable instanceof Cage) {
                return $authorizable->features()->find($ability) || $this->hasCageWithAbility($authorizable, $ability);
            }

            if (method_exists($authorizable, 'cages')) {
                return $this->hasCageWithAbility($authorizable, $ability);
            }
        });
    }

    public function boot()
    {
        if (!static::$skipMigrations) {
            $this->loadMigrationsFrom(__DIR__ . '/Laravel/database/migrations');
        }
    }

    protected function hasCageWithAbility($authorizable, $ability)
    {
        return $authorizable->cages->first(function (Cage $cage) use ($ability) {
            return $cage->can($ability);
        });
    }
}
