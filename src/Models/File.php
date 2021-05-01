<?php

namespace Dcolsay\Drive\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = [
        'name',
        'dir_name',
        'size',
    ];
    public static function createFromFileAttributes($attributes)
    {
        return [
            
        ];
    }
}
