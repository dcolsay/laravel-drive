<?php

namespace Dcolsay\Drive\Tests;

use Dcolsay\Drive\DriveServiceProvider;
use Illuminate\Support\Facades\Storage;
use Livewire\LivewireServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

abstract class TestCase extends Orchestra
{
    use HasStorage;

    public function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app)
    {
        return [
            DriveServiceProvider::class,
            LivewireServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        // $this->configureDisk('ftp', 'ftp');
        Storage::fake('ftp',  ['root' => $this->getStorageDirectory('ftp')]);
    }
}
