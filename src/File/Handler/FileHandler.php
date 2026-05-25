<?php

declare(strict_types=1);

namespace App\File\Handler;

use App\File\Uploader\FileUploaderInterface;
use Symfony\Component\HttpFoundation\File\File;

final class FileHandler
{
    public function handle(File $file, FileUploaderInterface $fileUploader): string
    {
        return $fileUploader->upload($file, $this->generateSafeFilename($file));
    }

    private function generateSafeFilename(File $file): string
    {
        $originalFilename = \pathinfo($file->getClientOriginalName(), \PATHINFO_FILENAME);
        $safeFilename = \preg_replace('/[^a-zA-Z0-9_-]+/', '-', $originalFilename) ?: 'course';

        return \sprintf('%s-%s.%s', \strtolower(\trim($safeFilename, '-')), \uniqid(), $file->guessExtension());
    }
}
