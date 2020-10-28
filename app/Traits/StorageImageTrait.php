<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait StorageImageTrait
{
    public function storageTraitUpload($request, $fieldName, $foderName)
    {
        if ($request->hasFile($fieldName)) {

            $file = $request->$fieldName;

            $fileNameOrigin = $file->getClientOriginalName();

            $fileNameHash = Str::random(20) . '.' . $file->extension();

            $path = $request->file($fieldName)->storeAs('public/' . $foderName . '/' . auth()->id(), $fileNameHash);

            $data = [
                'file_name' => $fileNameOrigin,
                'file_path' => $url = Storage::url($path),
            ];

            return $data;

        }

        return null;

    }

    public function storageTraitUploadMutiple($file, $foderName)
    {
        $fileNameOrigin = $file->getClientOriginalName();

        $fileNameHash = Str::random(20) . '.' . $file->extension();

        $filePath = $file->storeAs('public/' . $foderName . '/' . auth()->id(), $fileNameHash);

        $dataUploadTrait = [
            'file_name' => $fileNameOrigin,
            'file_path' => Storage::url($filePath),
        ];
        return $dataUploadTrait;
    }

}
