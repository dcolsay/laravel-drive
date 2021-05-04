<?php

namespace Dcolsay\Drive\Pipeline;

use Illuminate\Pipeline\Hub;
use Dcolsay\Drive\Pipeline\DriveTraveler;
use Dcolsay\Drive\AddToLaravelMedialibrary;

class DriveHub extends Hub
{
    /**
     * Send an object through one of the available pipelines.
     *
     * @param  mixed  $object
     * @param  string|null  $pipeline
     * @return mixed
     */
    public function pipe($object, $pipeline = null)
    {
        // If a pipeline was issued but it wasn't created, we will call the method to create it
        if ($pipeline && ! isset($this->pipelines[$pipeline])) {
            // $this->{'register' . ucfirst($pipeline)}();
            $this->register($pipeline);
        }
        
        $traveler = new DriveTraveler();
        $traveler->file = $object;
        return parent::pipe($traveler, $pipeline);
    }

    /**
     * Registers the Body Pipeline
     *
     * @return void
     */
    protected function registerBatch()
    {
         $this->pipeline('batch', function ($pipeline, $object) {
            return $pipeline->send($object)
                ->through([
                    AddToLaravelMedialibrary::class
                ])
                ->thenReturn();
        });
    }

    public function register($pipeline)
    {
        $list = config('drive.pipeline')[$pipeline];
        $this->pipeline('batch', function ($pipeline, $object) use ($list) {
            return $pipeline->send($object)
                ->through($list)
                ->thenReturn();
        });
    }
}
