<?php

    namespace App\Models;

    use App\Traits\UuidTrait;
    use Illuminate\Database\Eloquent\Model;

    class MailTemplate extends Model
    {
        use UuidTrait;

        public $fillable = [
            'name',
            'current',
            'all',
            'template_id',
        ];

        public function template()
        {
            return $this->belongsTo(Template::class);
        }
    }
