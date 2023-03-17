<?php

    namespace App\Observers;

    use App\Jobs\ResizeImageJob;
    use App\Models\Stock\Stock;
    use Illuminate\Http\UploadedFile;
    use Illuminate\Support\Facades\Storage;
    use Illuminate\Support\Str;

    class StockObserver
    {
        public function saving(Stock $stock)
        {
            if (!$stock->getKey()) {
                $stock->{$stock->getKeyName()} = (string)Str::uuid();
            }
            if ($stock->uploaded_image instanceof UploadedFile) {
                $dirPath  = Stock::GALLERY_PATH . $stock->id . DIRECTORY_SEPARATOR;
                $filePath = $dirPath . $stock->image;
                if (Storage::disk('public')->exists($filePath)) {
                    Storage::disk('public')->delete($filePath);
                }
                $image        = Storage::disk('public')->putFile($dirPath, $stock->uploaded_image);
                $stock->image = basename($image);
                ResizeImageJob::dispatch(
                    $dirPath . $stock->image,
                    config('customimagecache.types.stocks'),
                    'stocks'
                );
                unset($stock->uploaded_image);
            }
        }
    }
