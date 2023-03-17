<?php

    namespace App\Models\Menu;

    use App\Helpers\ShopHelper;
    use App\Traits\UuidTrait;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Support\Facades\Storage;

    class MenuItemTranslation extends Model
    {
        use UuidTrait;

        public $timestamps = false;

        public $fillable = [
            'name',
            'link',
            'image',
            'properties',
        ];

        public function menu_item()
        {
            return $this->belongsTo(MenuItem::class);
        }

        public function getImageAttribute($value)
        {
            if (! is_null($value)) {
                $menu_id = $this->menu_item->menu_id;
                $path    = collect([Menu::GALLERY_PATH, $menu_id, $value])->implode(DIRECTORY_SEPARATOR);

                if (Storage::disk('public')->exists($path)) {
                    return collect([$menu_id, $value])->implode(DIRECTORY_SEPARATOR);
                }
            }

            return ShopHelper::setting('no_image', config('app.no_image'));
        }
    }
