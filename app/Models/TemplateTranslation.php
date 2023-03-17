<?php

    namespace App\Models;

    use App\Traits\UuidTrait;
    use Illuminate\Database\Eloquent\Model;

    class TemplateTranslation extends Model
    {
        use UuidTrait;

        public $timestamps = false;

        public $fillable = [
            'name',
            'body',
        ];
    }
