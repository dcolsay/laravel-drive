<?php

namespace Dcolsay\Drive\Tests;

use Dcolsay\Drive\DriveServiceProvider;
use Livewire\LivewireServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

abstract class TestCase extends Orchestra
{
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
}
