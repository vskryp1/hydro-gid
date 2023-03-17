<?php

    namespace App\Models\Page;

    use App\Traits\UuidTrait;
    use Illuminate\Database\Eloquent\Model;

    class PageAdditionalFieldType extends Model
    {
        use UuidTrait;

        public $fillable = [
            'type',
            'active',
        ];
    }
