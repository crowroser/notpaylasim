<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class FileService
{
    public function uploadFile(UploadedFile $file)
    {
        $fileName = time() . '_' . $file->getClientOriginalName();
        // Storage facade'ini kullanarak doğrudan public diske kaydet
        $path = Storage::disk('public')->putFileAs('notes', $file, $fileName);
        return $path;
    }

    public function deleteFile($filePath)
    {
        if (Storage::disk('public')->exists($filePath)) {
            Storage::disk('public')->delete($filePath);
        }
    }
}