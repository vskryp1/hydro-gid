<?php

    namespace App\Models\Order;

    use App\Enums\ServiceType;
    use App\Models\Page\Page;
    use App\Observers\ServiceObserver;
    use App\Traits\UuidTrait;
    use BenSampo\Enum\Traits\CastsEnums;
    use Illuminate\Database\Eloquent\Builder;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Support\Facades\Storage;

    class ServiceOrder extends Model
    {
        use UuidTrait, CastsEnums;

        const GALLERY_PATH = 'service_files/';

        public $fillable = [
            'username',
            'email',
            'type',
            'phone',
            'comment',
            'active',
            'page_id',
            'call_me',
            'file',
        ];

        public $enumCasts = [
            'type' => ServiceType::class,
        ];

        public function scopeOnlyActive(Builder $builder)
        {
            return $builder->where('is_active', true);
        }

        public function getFileUrl()
        {
            return Storage::disk('public')->url(self::GALLERY_PATH . $this->id . '/' . $this->file);
        }

        public function page()
        {
            return $this->belongsTo(Page::class);
        }

        public function getAttachment()
        {
            return storage_path('app/public/' . self::GALLERY_PATH . $this->id . '/' . $this->file);
        }

    }
