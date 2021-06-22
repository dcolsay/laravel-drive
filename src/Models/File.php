<?php

namespace Dcolsay\Drive\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;

class File extends Model implements HasMedia
{
    use InteractsWithMedia;
    
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

    public function getPathAttribute()
    {
        return "{$this->dir_name}/{$this->name}.{$this->extension}";
    }
}
