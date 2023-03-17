<?php

    namespace App\Models\Currency;

    use App\Traits\UuidTrait;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\SoftDeletes;

    class Course extends Model
    {
        use UuidTrait, SoftDeletes;

        public $fillable = [
            'course',
        ];

        public $dates = [
            'deleted_at',
        ];

        public function currency()
        {
            return $this->belongsTo(Currency::class)->withTrashed();
        }
    }
