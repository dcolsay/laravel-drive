<?php

namespace Dcolsay\Drive;

use Closure;
use Illuminate\Support\Facades\Log;

class AddToLaravelMedialibrary
{
    public function handle($traveler, Closure $next)
    {
        Log::info("{$traveler->file->getPath()} is inside pipeline");
        return $next($traveler);
    }
}
