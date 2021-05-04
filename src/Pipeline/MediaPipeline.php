<?php

namespace Dcolsay\Drive\Pipeline;

use Illuminate\Support\Facades\Log;
use Dcolsay\Drive\Pipeline\DriveHub;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class MediaPipeline
{
    protected $hub;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(DriveHub $hub)
    {
        $this->hub = $hub;
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $media = $event->media;
        $path = $media->getPath();
        Log::info("file {$path} has been saved for media {$media->id}");
        Log::info("Collection is {$media->collection_name} has been saved for media {$media->id}");
        $this->hub->pipe($media, $media->collection_name);
    }
}
