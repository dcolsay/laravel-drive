<?php

namespace Dcolsay\Drive\Tests;

trait HasStorage
{
    public function configureDisk($diskName, $path="", $driver = 'local')
    {
        config()->set("filesystems.disks.{$diskName}", [
            'driver' => $driver,
            'root' => $this->getStorageDirectory($path),
        ]);
    }

    public function getStorageDirectory($path = "")
    {
        return __DIR__ . "/storage/" . $path;
    }
}
