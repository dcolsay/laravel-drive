<?php

namespace Dcolsay\Drive;

use Dcolsay\Drive\Concerns\GetFiles;
use Exception;
use InvalidArgumentException;
use Illuminate\Support\Facades\Log;
use Illuminate\Filesystem\FilesystemManager;
use League\Flysystem\ConnectionRuntimeException;
use Dcolsay\Drive\Exceptions\InvalidConfig;

class DriveManager
{
    use GetFiles;

    protected $filesystem;

    protected $storage;

    protected string $currentDisk = "ftp";

    protected string $currentPath;

    public function __construct(FilesystemManager $filesystem)
    {
        $this->filesystem = $filesystem;
    }

    public function lists()
    {
        try {

            $this->storage = $this->filesystem->disk($this->currentDisk);

        } catch (InvalidArgumentException $e) {

            throw InvalidConfig::driverNotSupported($this->currentDisk);
        }

        return $this->getFiles($this->currentPath);     
      
    }

    /**
     * Get the Flysystem driver.
     *
     * @return \League\Flysystem\FilesystemInterface
     */
    public function getDriver()
    {
        return $this->storage->getDriver();
    }

    public function setCurrentPath(string $path)
    {
        $this->currentPath = $path;

        return $this;
    }

    public function setDisk(string $disk)
    {
        $this->currentDisk = $disk;
    }
}
