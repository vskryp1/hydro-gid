<?php


namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ImageService
{
    const SEPARATOR = '-';

    /**
     * Cache for images
     * @param $path
     * @param $width
     * @param $height
     * @param null $folder
     * @return string
     */
    public static function getCached($name, $type, $ext = null)
    {
        $data   = config('customimagecache.types.' . $type);
        $folder = $data['folder'];
        $path   = '/' . $folder . '/' . $name;
        if (!$ext) {
            $rawPath = explode('.', $path);
            $ext     = end($rawPath);
        }
        if (Storage::disk('public')->exists($path)) {
            if (!self::isExtAllowed($ext)) {
                $url = $path;
            } else {
                $url = self::storeCompressed($path, $data, $ext);
            }
        } else {
            $url = self::storeCompressed('/assets/frontend/images/no_image.png', $data, $ext);
        }
        return Storage::disk('public')->url($url);
    }

    public static function isExtAllowed($ext)
    {
        $allowedTypes = explode(',', config('app.image_mimes'));
        return in_array($ext, $allowedTypes);
    }

    public static function storeCompressed($path, $data, $ext = null)
    {
        $folder      = $data['folder'];
        $width       = $data['width'];
        $height      = $data['height'];
        $watermark   = isset($data['watermark'])
            ? $data['watermark']
            : [];
        $diskToStore = Storage::disk('public');
        $name        = md5($path . $width . $height) . '.' . $ext;
        $cachedPath  = "/cache/$folder/$name";
        if (!$diskToStore->exists($cachedPath)) {
            $fileDisk  = Storage::disk('public')->exists($path)
                ? Storage::disk('public')
                : Storage::disk('public_files');
            $finalPath = $fileDisk->get($path);
            $image     = Image::make($finalPath);
            if ($width && $height) {
                $image->fit($width, $height);
            } elseif ($width) {
                $image->widen($width);
            } elseif ($height) {
                $image->heighten($height);
            }
            if ($watermark) {
                $watermarkBinary = Storage::disk('assets')->get(config('app.watermark_path'));
                $watermark       = Image::make($watermarkBinary)->fit($watermark['width'], $watermark['height']);
                $image->insert($watermark, 'center', 10, 10);
            }
            $image->encode($ext);
            $diskToStore->put($cachedPath, $image);
        }
        return $cachedPath;
    }

}