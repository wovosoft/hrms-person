<?php

namespace Wovosoft\HrmsPerson;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class HrmsPersonServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package->name('hrms-person')
            ->hasConfigFile()
            ->runsMigrations();

        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }
}
