<?php

namespace Dcolsay\Drive\Filament\Resources\DriveResource\Pages;

use Dcolsay\Drive\DriveManager;
use Dcolsay\Drive\Models\File;
use Filament\Resources\Pages\ListRecords;
use Dcolsay\Drive\Filament\Resources\DriveResource;
use Dcolsay\Drive\Jobs\TransferJob;

class ListDrives extends ListRecords
{
    public static $resource = DriveResource::class;

    public function canCreate()
    {
        return false;
    }

    public function handleTransfer(File $file)
    {
        TransferJob::dispatch($file);
        
    }
}
