<?php

namespace Dcolsay\Drive\Concerns;

use Illuminate\Support\Str;
use Dcolsay\Drive\FileAttributes;
use Dcolsay\Drive\DirectoryAttributes;
use Illuminate\Support\LazyCollection;
use Dcolsay\Drive\Contracts\StorageAttributes;

trait GetFiles
{

    public function getFiles($directory)
    {
       $filesData = $this->getDriver()->listContents($directory);

       return LazyCollection::make(function() use ($filesData){
            foreach ($filesData as $file) {

                $file['mime_type'] = $this->getFileType($file);

                yield ($file['type'] == StorageAttributes::TYPE_DIRECTORY) 
                    ? DirectoryAttributes::fromArray($file)
                    : FileAttributes::fromArray($file);
            }
       });
    }

    /**
     * @param $file
     *
     * @return bool|string
     */
    public function getFileType($file)
    {
        if ($file['type'] == 'dir') {
            return 'dir';
        }

        $mime = $this->storage->getMimetype($file['path']);
        $extension = $file['extension'];

        if (Str::contains($mime, 'directory')) {
            return 'dir';
        }

        if (Str::contains($mime, 'image') || $extension == 'svg') {
            return 'image';
        }

        if (Str::contains($mime, 'pdf')) {
            return 'pdf';
        }

        if (Str::contains($mime, 'audio')) {
            return 'audio';
        }

        if (Str::contains($mime, 'video')) {
            return 'video';
        }

        if (Str::contains($mime, 'zip')) {
            return 'file';
        }

        if (Str::contains($mime, 'rar')) {
            return 'file';
        }

        if (Str::contains($mime, 'octet-stream')) {
            return 'file';
        }

        if (Str::contains($mime, 'excel')) {
            return 'text';
        }

        if (Str::contains($mime, 'word')) {
            return 'text';
        }

        if (Str::contains($mime, 'css')) {
            return 'text';
        }

        if (Str::contains($mime, 'javascript')) {
            return 'text';
        }

        if (Str::contains($mime, 'plain')) {
            return 'text';
        }

        if (Str::contains($mime, 'rtf')) {
            return 'text';
        }

        if (Str::contains($mime, 'text')) {
            return 'text';
        }

        return false;
    }
}
