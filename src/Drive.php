<?php

namespace Dcolsay\Drive;

use Dcolsay\DataSource\File\Models\File;

class Drive
{
    public static $fileModel = File::class;

    /**
     * Get the name of the file model used by the application.
     *
     * @return string
     */
    public static function fileModel()
    {
        return static::$fileModel;
    }

    /**
     * Get a new instance of the file model.
     *
     * @return mixed
     */
    public static function newFileModel()
    {
        $model = static::fileModel();

        return new $model;
    }

    public static function useFileModel(string $model)
    {
        static::$fileModel = $model;

        return new static;
    }
}
