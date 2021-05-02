<?php

namespace Dcolsay\Drive;

use Exception;
use InvalidArgumentException;
use Dcolsay\Drive\Models\File;
use Illuminate\Support\Facades\Log;
use Dcolsay\Drive\Concerns\GetFiles;
use Dcolsay\Drive\Exceptions\InvalidConfig;
use Illuminate\Filesystem\FilesystemManager;
use Dcolsay\Drive\Contracts\StorageAttributes;
use League\Flysystem\ConnectionRuntimeException;

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

    public function sync(string $directory = null)
    {
        $directory = $directory ?? $this->currentPath;

        // TODO : Add Event Start Sync
        
        // TODO : dispacth inside queue
        $files = $this->lists()
            ->map(fn($attributes) => [
                'name' => $attributes['filename'],
                'dir_name' => $attributes['dirname'],
                'size' => $attributes['size'],
                'disk' => $this->currentDisk,
            ])
            ->toArray();

        Drive::newFileModel()::insert($files);

        // TODO : Add Event End Sync
    }

    public function transfer(File $file)
    {
        $file->addMediaFromDisk($file->path, $this->currentDisk)
            ->preservingOriginal()
            ->toMediaCollection('batch');
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
