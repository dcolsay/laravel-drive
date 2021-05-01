<?php

declare(strict_types=1);

namespace Dcolsay\Drive;

use Dcolsay\Drive\Concerns\ProxyArrayAccessToProperties;
use Dcolsay\Drive\Contracts\StorageAttributes;

class FileAttributes implements StorageAttributes
{
    use ProxyArrayAccessToProperties;

    /**
     * @var string
     */
    private $type = StorageAttributes::TYPE_FILE;

    /**
     * @var string
     */
    private $path;

    /**
     * @var string
     */
    private $dirname;
    /**
     * @var string
     */
    private $filename;

    /**
     * @var int|null
     */
    private $size;

    /**
     * @var string|null
     */
    private $visibility;

    /**
     * @var int|null
     */
    private $lastModified;

    /**
     * @var string|null
     */
    private $mimeType;

    /**
     * @var string|null
     */
    private $extension;

    /**
     * @var array
     */
    private $extraMetadata;

    public function __construct(
        string $path,
        string $dirname,
        string $filename,
        ?int $size = null,
        ?string $visibility = null,
        ?int $lastModified = null,
        ?string $mimeType = null,
        ?string $extension = null,
        array $extraMetadata = []
    ) {
        $this->path = $path;
        $this->dirname = $dirname;
        $this->filename = $filename;
        $this->size = $size;
        $this->visibility = $visibility;
        $this->lastModified = $lastModified;
        $this->mimeType = $mimeType;
        $this->extension = $extension;
        $this->extraMetadata = $extraMetadata;
    }

    public function type(): string
    {
        return $this->type;
    }

    public function path(): string
    {
        return $this->path;
    }

    public function size(): ?int
    {
        return $this->size;
    }

    public function visibility(): ?string
    {
        return $this->visibility;
    }

    public function lastModified(): ?int
    {
        return $this->lastModified;
    }

    public function mimeType(): ?string
    {
        return $this->mimeType;
    }

    public function extension(): ?string
    {
        return $this->mimeType;
    }

    public function extraMetadata(): array
    {
        return $this->extraMetadata;
    }

    public function isFile(): bool
    {
        return true;
    }

    public function isDir(): bool
    {
        return false;
    }

    public function withPath(string $path): StorageAttributes
    {
        $clone = clone $this;
        $clone->path = $path;

        return $clone;
    }

    public static function fromArray(array $attributes): StorageAttributes
    {
        // dd($attributes);
        return new FileAttributes(
            $attributes[StorageAttributes::ATTRIBUTE_PATH],
            $attributes[StorageAttributes::ATTRIBUTE_DIRNAME],
            $attributes[StorageAttributes::ATTRIBUTE_FILENAME],
            $attributes[StorageAttributes::ATTRIBUTE_FILE_SIZE] ?? null,
            $attributes[StorageAttributes::ATTRIBUTE_VISIBILITY] ?? null,
            $attributes[StorageAttributes::ATTRIBUTE_LAST_MODIFIED] ?? null,
            $attributes[StorageAttributes::ATTRIBUTE_MIME_TYPE] ?? null,
            $attributes[StorageAttributes::ATTRIBUTE_EXTENSION] ?? null,
            $attributes[StorageAttributes::ATTRIBUTE_EXTRA_METADATA] ?? []
        );
    }

    public function jsonSerialize(): array
    {
        return [
            StorageAttributes::ATTRIBUTE_TYPE => self::TYPE_FILE,
            StorageAttributes::ATTRIBUTE_PATH => $this->path,
            StorageAttributes::ATTRIBUTE_PATH => $this->filename,
            StorageAttributes::ATTRIBUTE_PATH => $this->dirname,
            StorageAttributes::ATTRIBUTE_FILE_SIZE => $this->size,
            StorageAttributes::ATTRIBUTE_VISIBILITY => $this->visibility,
            StorageAttributes::ATTRIBUTE_LAST_MODIFIED => $this->lastModified,
            StorageAttributes::ATTRIBUTE_MIME_TYPE => $this->mimeType,
            StorageAttributes::ATTRIBUTE_EXTENSION => $this->extension,
            StorageAttributes::ATTRIBUTE_EXTRA_METADATA => $this->extraMetadata,
        ];
    }
}
