<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;

trait HandlesTicketAttachments
{
    /**
     * Handle attachments for a model.
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param array $attachments
     * @param string $collectionName
     * @param string|null $filenamePrefix
     * @return array
     */
    public function handleTicketAttachments($model, array $attachments, string $collectionName, string|null $filenamePrefix = null): array
    {
        $uploadErrors = [];

        foreach ($attachments as $attachment) {
            if (!$attachment instanceof UploadedFile || !$attachment->isValid()) {
                $uploadErrors[] = 'File ' . ($attachment->getClientOriginalName() ?? 'unknown') . ' is not valid.';
                continue;
            }

            try {
                $prefix = $filenamePrefix ?? 'file-' . time();
                $cleanFilename = preg_replace('/[^a-zA-Z0-9_\.-]/', '_', $attachment->getClientOriginalName());

                $model->addMedia($attachment->getRealPath())
                    ->usingFileName($prefix . '_' . $cleanFilename)
                    ->toMediaCollection($collectionName);
            } catch (\Exception $e) {
                Log::error('File upload error: ' . $e->getMessage());
                $uploadErrors[] = 'Error uploading file ' . $attachment->getClientOriginalName() . '.';
            }
        }

        return $uploadErrors;
    }

    /**
     * Validate attachments manually with custom error messages including filenames.
     *
     * @param Request $request
     * @param string $fieldName The name of the attachments field in the request
     * @param int $maxSizeKB Maximum allowed size per file in kilobytes (default 20420 KB = 20MB)
     * @param array $allowedMimeTypes Allowed mime types for the files
     * @return array Array of error messages. Empty if no errors.
     */
    public function validateAttachments(Request $request, string $fieldName = 'attachments', int $maxSizeKB = 20480, array $allowedMimeTypes = ['image/jpeg', 'image/jpg', 'image/png']): array
    {
        $errors = [];
        $maxSizeMB = number_format($maxSizeKB / 1024, 2);
        
        if ($request->hasFile($fieldName)) {
            foreach ($request->file($fieldName) as $file) {
                $fileName = $file->getClientOriginalName();

                if (!$file->isValid()) {
                    $errors[] = "File \"{$fileName}\" is not a valid upload.";
                    continue;
                }
                if (!in_array($file->getMimeType(), $allowedMimeTypes)) {
                    $errors[] = "File \"{$fileName}\" must be a JPG or PNG image.";
                }

                if (($file->getSize() / 1024) > $maxSizeKB) {
                    $errors[] = "File \"{$fileName}\" exceeds the {$maxSizeMB} MB size limit.";
                }
            }
        }

        return $errors;
    }
}
