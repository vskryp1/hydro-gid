<?php

    namespace App\Models\Filters;

    use App\Traits\UuidTrait;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\SoftDeletes;

    class FilterType extends Model
    {
        use UuidTrait, SoftDeletes;

        public $incrementing = false;

        public $dates = [
            'deleted_at',
        ];
    }
