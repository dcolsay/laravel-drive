<?php

namespace Dcolsay\Drive\Tests;

use CreateFilesTable;
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

        $this->setUpDatabase($this->app);
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

        config()->set('database.default', 'sqlite');
        config()->set('database.connections.sqlite', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);
    }

    protected function setUpDatabase($app)
    {
        include_once(__DIR__  . '/../database/migrations/create_files_table.php.stub');

        (new CreateFilesTable())->up();
    }
}
