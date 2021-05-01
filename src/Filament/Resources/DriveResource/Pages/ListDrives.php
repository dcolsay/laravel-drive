<?php

namespace Dcolsay\Drive\Filament\Resources\DriveResource\Pages;

use Dcolsay\Drive\Models\File;
use Filament\Resources\Pages\ListRecords;
use Dcolsay\Drive\Filament\Resources\DriveResource;

class ListDrives extends ListRecords
{
    public static $resource = DriveResource::class;

    public function canCreate()
    {
        return false;
    }

    public function handleTransfer(File $file)
    {
        dd($file);
    }
}
