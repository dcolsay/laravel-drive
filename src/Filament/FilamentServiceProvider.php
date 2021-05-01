<?php

namespace Dcolsay\Drive\Filament;

use Filament\PluginServiceProvider;
use Dcolsay\Drive\Filament\Resources\DriveResource;
use Dcolsay\Drive\Filament\Resources\DriveResource\Pages\EditDrive;
use Dcolsay\Drive\Filament\Resources\DriveResource\Pages\ListDrives;
use Dcolsay\Drive\Filament\Resources\DriveResource\Pages\CreateDrive;

class FilamentServiceProvider extends PluginServiceProvider
{
    protected $resources = [
        DriveResource::class,
    ];

    // protected $pages = [
    //     ListDrives::class,
    //     EditDrive::class,
    //     CreateDrive::class
    // ];
}
