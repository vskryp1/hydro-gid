<?php

    namespace App\Models\Sliders;

    use App\Helpers\ShopHelper;
    use App\Traits\UuidTrait;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Support\Facades\Storage;

    class SliderItemTranslation extends Model
    {
        use UuidTrait;

        public $timestamps = false;

        public $fillable = [
            'alt',
            'title',
            'image',
            'name',
            'description',
            'link',
        ];

        public function slider_item()
        {
            return $this->belongsTo(SliderItem::class);
        }

//        public function getImageAttribute($value)
//        {
//            $url = ShopHelper::setting('no_image', config('app.no_image'));
//
//            if (! is_null($value)) {
//                $path = Slider::GALLERY_PATH . $this->slider_item->slider_id . DIRECTORY_SEPARATOR . $value;
//
//                if (Storage::disk('public')->exists($path)) {
//                    $url = asset('/storage/' . $path);
//                }
//            }
//
//            return $url;
//        }
    }
