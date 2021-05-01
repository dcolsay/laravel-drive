<?php

namespace Dcolsay\Drive\Exceptions;

use Exception;

class InvalidConfig extends Exception
{
    public static function driverNotSupported($driver)
    {
        return new static("Driver {$driver} not supported. Please check your configuration");
    }
}
