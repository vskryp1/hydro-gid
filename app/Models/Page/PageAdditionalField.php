<?php

    namespace App\Models\Page;

    use App\Traits\UuidTrait;
    use Illuminate\Database\Eloquent\Model;

    class PageAdditionalField extends Model
    {
        use UuidTrait;

        public $fillable = [
            'name',
            'key',
            'default',
            'active',
            'page_template_id',
            'page_additional_field_type_id',
        ];

        public function page_additional_field_type()
        {
            return $this->belongsTo(PageAdditionalFieldType::class);
        }

        public function page_additional_field_value()
        {
            return $this->hasMany(PageAdditionalFieldValue::class);
        }
    }
