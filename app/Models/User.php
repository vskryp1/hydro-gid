<?php

    namespace App\Models;

    use App\Enums\UserType;
    use App\Helpers\ShopHelper;
    use App\Traits\UuidTrait;
    use Illuminate\Database\Eloquent\Builder;
    use Illuminate\Database\Eloquent\SoftDeletes;
    use Illuminate\Notifications\Notifiable;
    use Illuminate\Foundation\Auth\User as Authenticatable;
    use Illuminate\Support\Facades\Storage;
    use Spatie\Permission\Traits\HasRoles;

    class User extends Authenticatable
    {
        use UuidTrait, Notifiable, HasRoles, SoftDeletes;

        public $guard_name = 'admin';

        public $dates = [
            'deleted_at',
        ];

        public $fillable = [
            'name',
            'email',
            'phone',
            'avatar',
            'active',
            'notification',
        ];

        public $hidden = [
            'password',
            'remember_token',
        ];

        public $appends = [
            'format_name',
            'role',
        ];

        public function getRoleAttribute()
        {
            return $this->getRoleNames()->implode(',');
        }

        public function isSuperAdmin()
        {
            return $this->hasRole(UserType::ROLE_SUPER_ADMIN);
        }

        public function getAvatarAttribute($value)
        {
            $url = implode(DIRECTORY_SEPARATOR, ['public', 'avatars', $this->id, $value]);

            if (is_null($value) || ! Storage::exists($url)) {
                return url(ShopHelper::setting('no_avatar', config('app.no_avatar')));
            }

            return Storage::url($url);
        }

        public function setPhoneAttribute($value)
        {
            if ($value) {
                return $this->attributes['phone'] = preg_replace('![^\d]+!u', '', $value);
            }
        }

        public function setEmailAttribute($value)
        {
            return $this->attributes['email'] = trim($value);
        }

        public function getFormatNameAttribute()
        {
            return $this->name . ' (' . $this->email . ')';
        }

        public function scopeOnlyActive(Builder $builder)
        {
            return $builder->where('active', true);
        }
    }
