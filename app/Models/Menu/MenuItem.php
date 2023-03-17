<?php

    namespace App\Models\Menu;

    use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
    use Astrotomic\Translatable\Translatable;
    use App\Models\Page\Page;
    use App\Models\Product\Product;
    use App\Traits\UuidTrait;
    use Illuminate\Database\Eloquent\Builder;
    use Illuminate\Database\Eloquent\Model;

    class MenuItem extends Model implements TranslatableContract
    {
        use UuidTrait, Translatable;

        const MENU_ITEM_LINK        = 1;
        const MENU_ITEM_PAGE        = 2;
        const MENU_ITEM_PAGE_PARENT = 3;
        const MENU_ITEM_PRODUCT     = 4;

        const MENU_ITEM_TYPES = [
            self::MENU_ITEM_LINK        => null,
            self::MENU_ITEM_PAGE        => Page::class,
            self::MENU_ITEM_PAGE_PARENT => Page::class,
            self::MENU_ITEM_PRODUCT     => Product::class,
        ];

        public $timestamps = false;

        public $fillable = [
            'menu_id',
            'menuable_id',
            'menuable_type',
            'menu_item_id',
            'position',
            'type',
        ];

        public $translatedAttributes = [
            'name',
            'link',
            'image',
            'properties',
        ];

        public $with = [
            'translations',
        ];

        public $useTranslationFallback = true;

        public function menuable()
        {
            return $this->morphTo();
        }

        public function children()
        {
            return $this->hasMany(MenuItem::class, 'menu_item_id', 'id');
        }

        public function parent()
        {
            return $this->hasOne(MenuItem::class, 'id', 'menu_item_id');
        }

        public function scopeByPosition(Builder $builder)
        {
            return $builder->orderBy('position');
        }
    }
