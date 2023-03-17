<?php

namespace App\Console\Commands;

use App\Helpers\ShopHelper;
use App\Jobs\ResizeDefaultImagesJob;
use App\Jobs\ResizeImageJob;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ResizeImagesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'resize:images {directory?} {image_type?} {--is_only_webp=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Resize site images';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Log::info('start compress:images');
        $allowedExtensions = explode(',', config('app.image_mimes'));
        $onlyWebp = $this->option('is_only_webp');
        $singleImageType = false;
        $image_type = $this->argument('image_type');

	    if($directory = $this->argument('directory')) {
		    $directories = [$this->argument('directory')];
            $filters = config('customimagecache.types.' . $directory);
		    if ($filters && !$onlyWebp) {
                $singleImageType = array_key_exists($image_type, $filters);
			    if($singleImageType) {
                    Storage::disk('public')->deleteDirectory("cache/{$directory}/{$image_type}");
                } else {
                    foreach ($filters as $typeKey => $filter) {
                        Storage::disk('public')->deleteDirectory("cache/{$typeKey}");
                    }
                }
		    } elseif ($filters) {
                $singleImageType = array_key_exists($image_type, $filters);
                if($singleImageType) {
                    Storage::disk('public')->deleteDirectory("cache/{$directory}/{$image_type}/webp");
                } else {
                    foreach ($filters as $typeKey => $filter) {
                        Storage::disk('public')->deleteDirectory("cache/{$directory}/{$typeKey}/webp");
                    }
                }
            }
	    } else {
		    $directories = Storage::disk('public')->directories();
		    if(!$onlyWebp) {
                Storage::disk('public')->deleteDirectory('cache');
            } else {
                $filter_directories = config('customimagecache.types');
                foreach ($filter_directories as $directory => $filters) {
                    foreach($filters as $typeKey => $filter) {
                        Storage::disk('public')->deleteDirectory("cache/{$typeKey}/webp");
                    }
			    }
            }
	    }

        foreach ($directories as $directory) {
            if (config('customimagecache.types.' . $directory)) {
                foreach (Storage::disk('public')->allFiles($directory) as $filePath) {
                    $extension = pathinfo(storage_path('app/public/'. $filePath), PATHINFO_EXTENSION);
                    if(in_array($extension, $allowedExtensions)) {
                        dispatch(
                            new ResizeImageJob(
                                $filePath,
                                config('customimagecache.types.' . $directory),
                                $directory,
                                $onlyWebp,
                                $singleImageType,
                                $image_type
                            )
                        );
                    }
                }
            }
        }
        // default products
        dispatch(
            new ResizeDefaultImagesJob(
                basename(ShopHelper::setting('no_product_image', config('app.no_product_image'))),
                base_path('resources/assets/frontend/images/'),
                config('customimagecache.types.products')
            )
        );
        // default pages
        dispatch(
            new ResizeDefaultImagesJob(
                basename(ShopHelper::setting('no_image', config('app.no_product_image'))),
                base_path('resources/assets/frontend/images/'),
                config('customimagecache.types.pages')
            )
        );
	    // default sliders
	    dispatch(
		    new ResizeDefaultImagesJob(
			    basename(ShopHelper::setting('no_image', config('app.no_product_image'))),
			    base_path('resources/assets/frontend/images/'),
			    config('customimagecache.types.sliders')
		    )
	    );

        Log::info('complete compress:images');
    }
}
