<?php

    namespace App\Models\Menu;

    use App\Models\Page\Page;
    use App\Traits\AliasTrait;
    use App\Traits\UuidTrait;
    use Illuminate\Database\Eloquent\Model;

    class Menu extends Model
    {
        use UuidTrait, AliasTrait;

        const GALLERY_PATH = 'menus';

        const MENU_CONSTRUCTOR = 1;
        const MENU_PAGE_PARENT = 2;

        const MENU_TYPES = [
            self::MENU_CONSTRUCTOR => 'constructor',
            self::MENU_PAGE_PARENT => 'page_parent',
        ];

        public $fillable = [
            'page_id',
            'alias',
            'type',
        ];

        public function menu_items()
        {
            return $this->hasMany(MenuItem::class)->orderBy('position');
        }

        public function menu_items_parents()
        {
            return $this->menu_items()->whereNull('menu_item_id');
        }

        public function page()
        {
            return $this->belongsTo(Page::class);
        }
    }
