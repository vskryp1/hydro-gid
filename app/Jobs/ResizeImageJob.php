<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ResizeImageJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $filePath;
    protected $filters;
    protected $savePath;
    protected $directory;
    protected $onlyWebp;
    protected $singleImageType;
    protected $image_type;

    /**
     * ResizeImageJob constructor.
     * @param string $filePath
     * @param array $filters
     * @param string $directory
     * @param $onlyWebp
     * @param bool $singleImageType
     * @param $image_type
     */
    public function __construct(
        string $filePath,
        array $filters,
        string $directory,
        $onlyWebp = false,
        bool $singleImageType = false,
        $image_type = null
    ) {
        $this->filePath  = $filePath;
        $this->filters   = $filters;
        $this->directory = $directory;
        $this->savePath  = str_replace($directory, '', $filePath);
        $this->onlyWebp  = $onlyWebp;
        $this->singleImageType  = $singleImageType;
        $this->image_type  = $image_type;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach ($this->filters as $typeKey => $filter) {
            if($this->singleImageType && $this->image_type !== $typeKey)
                continue;

            if(!$this->onlyWebp)
            {
                $image = Image::make(Storage::disk('public')->get($this->filePath));
                (new $filter())->applyFilter($image);
                Storage::disk('public')->put(
                    'cache/' . $typeKey . $this->savePath,
                    $image->stream()
                );
            }

            $image = Image::make(Storage::disk('public')->get($this->filePath));
            (new $filter())->applyFilter($image);
            $explodePath = explode('/', trim($this->savePath, '/'));
            $savePath = array_shift($explodePath);
            $fileName = explode('.', array_shift($explodePath));
            $imageName = array_shift($fileName);
            Storage::disk('public')->makeDirectory('cache/' . $typeKey . '/webp/' . $savePath);
            $image->save(
                storage_path('app/public/' . 'cache/' . $typeKey . '/webp/' . $savePath . '/' . $imageName . '.webp'),
                50
            );
        }
    }
}