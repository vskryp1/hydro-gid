<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ResizeDefaultImagesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $file;
    protected $filters;
    protected $savePath;
    protected $directory;

    /**
     * ResizeImageJob constructor.
     * @param string $filePath
     * @param array $filters
     * @param string $directory
     */
    public function __construct(string $file, string $directory, array $filters)
    {
        $this->file      = $file;
        $this->filters   = $filters;
        $this->directory = $directory;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach ($this->filters as $typeKey => $filter) {
            $image = Image::make($this->directory . $this->file);
            (new $filter())->applyFilter($image);
            Storage::disk('public')->put(
                'cache/' . $typeKey . DIRECTORY_SEPARATOR . $this->file,
                $image->stream()
            );
        }
    }
}