<?php

namespace App\Models\Client;

use App\Models\Order\Order;
use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Temp_Client_Orders extends Model
{
    use UuidTrait, SoftDeletes, Notifiable, HasRoles;

    protected $table = 'temp_client_orders';

    public $guard_name = 'web';

    public $dates = [
        'deleted_at',
    ];

    public $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'edrpou',
        'order_id',
        'company_name',
    ];

    public $appends = [
        'name',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function getNameAttribute()
    {
        return collect([$this->first_name, $this->last_name])
            ->filter()
            ->implode(' ');
    }
}
