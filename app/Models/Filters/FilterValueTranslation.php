<?php

    namespace App\Models\Filters;

    use App\Traits\UuidTrait;
    use Illuminate\Database\Eloquent\Model;

    class FilterValueTranslation extends Model
    {
        use UuidTrait;

        public $timestamps = false;

        public $fillable = [
            'name',
        ];
    }
