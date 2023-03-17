<?php

namespace App\Observers;

use App\Models\Order\ServiceOrder;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ServiceObserver
{
    public function saving(ServiceOrder $service)
    {
        $file = request()->file('file');

        if (!$service->getKey()) {
            $service->{$service->getKeyName()} = (string)Str::uuid();
        }

        if ($file instanceof UploadedFile) {
            $dirPath  = ServiceOrder::GALLERY_PATH . $service->id . DIRECTORY_SEPARATOR;
            $filePath = $dirPath . $file->getClientOriginalName();
            if (Storage::disk('public')
                       ->exists($filePath)) {
                Storage::disk('public')
                       ->delete($filePath);
            }
            $image         = Storage::disk('public')
                                    ->putFileAs($dirPath, $file, $file->getClientOriginalName());
            $service->file = basename($image);
        }
    }
}
