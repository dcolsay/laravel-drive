<?php

namespace Dcolsay\Drive;

use Closure;

class AddToLaravelMedialibrary
{
    public function handle($passable, Closure $next)
    {
        dd('Inside add to Media', $passable);
        return $next($passable);
    }
}
