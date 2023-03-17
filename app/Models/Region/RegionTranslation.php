<?php

    namespace App\Models\Region;

    use App\Traits\UuidTrait;
    use Illuminate\Database\Eloquent\Model;

    class RegionTranslation extends Model
    {
        use UuidTrait;

        public $timestamps = false;

        public $fillable = [
            'name',
        ];
    }
