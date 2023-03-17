<?php

    namespace App\Models\Seo;

    use App\Traits\UuidTrait;
    use Illuminate\Database\Eloquent\Model;

    class SeoRedirects extends Model
    {
        use UuidTrait;

        public $incrementing = false;

        public $fillable = [
            'status_code',
            'from',
            'to',
        ];
    }
