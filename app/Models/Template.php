<?php

    namespace App\Models;

    use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
    use Astrotomic\Translatable\Translatable;
    use App\Traits\UuidTrait;
    use Illuminate\Database\Eloquent\Model;

    class Template extends Model implements TranslatableContract
    {
        use UuidTrait, Translatable;

        public $guarded = [
            'id',
            'created_at',
            'updated_at',
        ];

        public $translatedAttributes = [
            'name',
            'body',
        ];

        public $with = [
            'translations',
        ];

        public $useTranslationFallback = true;

        public static function formattedResultForSelect()
        {
            $result    = [];
            $templates = self::all();

            foreach ($templates as $template) {
                $result[$template->id] = $template->translate() ? $template->translate()->name : '';
            }

            return $result;
        }
    }
