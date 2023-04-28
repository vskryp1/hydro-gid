<?php

namespace App\Models\Product;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use App\Helpers\ShopHelper;
use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ProductImage extends Model implements TranslatableContract
{
    use UuidTrait, Translatable;

    public $timestamps = false;

    public $fillable = [
        'product_id',
        'position',
        'image',
        'cover',
    ];

    public $translatedAttributes = [
        'alt',
        'title',
    ];

    public $with = [
        'translations',
    ];

    public $useTranslationFallback = true;


    public function getImagePathAttribute()
    {
        return $this->getOriginal('image')
            ? storage_path(
                collect(['app', 'public', 'products', $this->product_id, $this->getOriginal('image')])->implode(DIRECTORY_SEPARATOR)
            )
            : public_path('assets/frontend/images/') . ShopHelper::setting('no_image', config('app.no_product_image'));
    }

    public function getUrl($filterType, $is_webp = false)
    {
        return $this->getOriginal('image')
            ? $this->imageUrlGenerate($filterType, $is_webp)
            : asset(
                collect([
                    'storage',
                    'cache',
                    $filterType,
                    basename(ShopHelper::setting('no_product_image', config('app.no_product_image')))
                ])
                    ->implode(DIRECTORY_SEPARATOR)
            );
    }

    protected function imageUrlGenerate($filterType, $is_webp)
    {
        return $is_webp
            ? $this->getWebpUrl($filterType)
            : str_replace('app/public','',collect(['app', 'public/storage', 'products', $this->product_id, $this->getOriginal('image')])->implode(DIRECTORY_SEPARATOR));
    }

    protected function getWebpUrl($filterType)
    {
        $fileName = explode('.', $this->getOriginal('image'));
        $imageName = array_shift($fileName);
        $is_image_exist = Storage::disk('public')->exists("cache/$filterType/webp/$this->product_id/" . $imageName . '.webp');

        return $is_image_exist
            ?  str_replace('app/public','',collect(['app', 'public/storage', 'products', $this->product_id, $this->getOriginal('image')])->implode(DIRECTORY_SEPARATOR))
            : str_replace('app/public','',collect(['app', 'public/storage', 'products', $this->product_id, $this->getOriginal('image')])->implode(DIRECTORY_SEPARATOR));
    }

    public function getImageAttribute($value)
    {
        return $this->getOriginal('image')
            ? collect(['storage', 'products', $this->product_id, $value])
                ->implode(DIRECTORY_SEPARATOR)
            : $value;
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getImageAlt()
    {
        return empty($this->alt)
            ? $this->product->name
            : $this->alt;
    }

    public function getImageTitle()
    {
        return empty($this->title)
            ? $this->product->name
            : $this->title;
    }
}
