<?php

    namespace App\Models\Faq;

    use App\Traits\UuidTrait;
    use Illuminate\Database\Eloquent\Model;

    class FaqTranslation extends Model
    {
        use UuidTrait;

        public $timestamps = false;

        public $fillable = [
            'answer',
            'question',
        ];
    }
