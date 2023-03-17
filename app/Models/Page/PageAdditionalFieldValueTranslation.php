<?php

    namespace App\Models\Page;

    use App\Traits\UuidTrait;
    use Illuminate\Database\Eloquent\Model;

    class PageAdditionalFieldValueTranslation extends Model
    {
        use UuidTrait;

        public $timestamps = false;

        public $fillable = [
            'value',
        ];
    }
