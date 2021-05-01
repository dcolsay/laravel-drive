<?php

namespace Dcolsay\Drive;

use Dcolsay\Drive\Filament\FilamentServiceProvider;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class DriveServiceProvider extends PackageServiceProvider
{
    protected $migrations = [
        'create_files_table'
    ];

    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-drive')
            ->hasMigrations($this->migrations);
    }

    public function packageRegistered()
    {
        $this->app->register(FilamentServiceProvider::class);
    }
}
