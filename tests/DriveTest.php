<?php

namespace Dcolsay\Drive\Tests;

use Illuminate\Support\Facades\Storage;

class DriveTest extends TestCase
{

    /** @test */
    public function example_true()
    {
        // dd(Storage::disk('ftp'));
        $this->assertTrue(true);
    }
}
