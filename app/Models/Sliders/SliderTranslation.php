<?php

    namespace App\Models\Sliders;

    use App\Traits\UuidTrait;
    use Illuminate\Database\Eloquent\Model;

    class SliderTranslation extends Model
    {
        use UuidTrait;

        public $timestamps = false;

        public $fillable = [
            'name',
        ];
    }
