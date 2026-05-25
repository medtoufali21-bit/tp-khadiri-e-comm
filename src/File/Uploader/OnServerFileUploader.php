<?php

declare(strict_types=1);

namespace App\File\Uploader;

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\File;

final readonly class OnServerFileUploader implements FileUploaderInterface
{
    public function __construct(private string $baseDirectory)
    {
    }

    public function upload(File $file, string $destination): string
    {
        (new Filesystem())->mkdir($this->baseDirectory);
        $file->move($this->baseDirectory, $destination);

        return 'uploads/courses/'.$destination;
    }
}
