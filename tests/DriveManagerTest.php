<?php

namespace Dcolsay\Drive\Tests;

use Dcolsay\Drive\DriveManager;
use Illuminate\Filesystem\FilesystemManager;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\LazyCollection;

class DriveManagerTest extends TestCase
{

    /** @test */
    public function instantiable()
    {
        $drive = $this->getDriveManager();
        $this->assertInstanceOf(DriveManager::class, $drive);
    }

    /** @test */
    public function can_lists_files()
    {
        $drive = $this->getDriveManager();
        $lists = $drive->lists();

        $this->assertInstanceOf(LazyCollection::class,$lists);
        $this->assertEquals(0, $lists->count());

    }

     /** @test */
    public function can_change_disk()
    {
        $storage = Storage::fake('local');
        $storage->put('test1.txt', 'Hello Test');
        $storage->put('test2.txt', 'Hello World');

        $drive = $this->getDriveManager();
        $drive->setDisk('local');

        $lists = $drive->lists();

        $this->assertEquals(2, $lists->count());

    }

    /** @test */
    public function can_lists_array()
    {
        $storage = Storage::fake('local');
        $storage->put('test1.txt', 'Hello Test');
        $storage->put('test2.txt', 'Hello World');

        $drive = $this->getDriveManager();
        $drive->setDisk('local');

        $lists = $drive->listsArray();

        $expected = [
            [
                "name" => "test1",
                "dir_name" => "",
                "size" => 10,
                "disk" => "local",
            ],
            [
                "name" => "test2",
                "dir_name" => "",
                "size" => 11,
                "disk" => "local",
            ],
        ];

        $this->assertIsArray($lists);
        $this->assertSame($expected, $drive->listsArray());

    }

    protected function getDriveManager(): DriveManager
    {
        $drive = new DriveManager(resolve('filesystem'));
        return $drive;
    }
}
