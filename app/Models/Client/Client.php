<?php

    namespace App\Models\Client;

    use App\Listeners\ResetPasswordNotification;
    use App\Models\Order\Order;
    use App\Models\Order\OrderStatus;
    use App\Models\Product\Product;
    use App\Models\Reviews\Review;
    use App\Notifications\ChangePasswordEmail;
    use App\Notifications\ResetPasswordEmail;
    use App\Traits\UuidTrait;
    use Gloudemans\Shoppingcart\Facades\Cart;
    use Illuminate\Auth\Notifications\VerifyEmail;
    use Illuminate\Auth\Passwords\CanResetPassword;
    use Illuminate\Contracts\Auth\MustVerifyEmail;
    use Illuminate\Database\Eloquent\Builder;
    use Illuminate\Foundation\Auth\User as Authenticatable;
    use Illuminate\Database\Eloquent\SoftDeletes;
    use Illuminate\Notifications\Messages\MailMessage;
    use Illuminate\Notifications\Notifiable;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Lang;
    use Spatie\Permission\Traits\HasRoles;

    class Client extends Authenticatable implements MustVerifyEmail
    {
        use UuidTrait, SoftDeletes, Notifiable, HasRoles, CanResetPassword;

        public $guard_name = 'web';

        public $dates = [
            'deleted_at',
        ];

        public $fillable = [
            'is_legal_entity',
            'company_name',
            'edrpou',
            'first_name',
            'last_name',
            'phone',
            'email',
            'remember_token',
            'is_active',
            'discount',
            'is_percentage',
            'email_verified_at',
        ];

        public $guarded = [
            'password',
        ];

        public $appends = [
            'name',
            'main_address',
            'wishlist',
            'waitinglist',
            'comparelist',
            'reviews',
        ];

        public function addresses()
        {
            return $this->hasMany(Address::class);
        }

        public function orders()
        {
            return $this->hasMany(Order::class);
        }

        public function current_orders()
        {
            $order_status = OrderStatus::onlyActive()->orderBy('default', 'desc')->byPosition()->first();

            return $this->hasMany(Order::class)
                        ->whereIn('order_status_id', [$order_status->id]);
        }

        public function history_orders()
        {
            $order_status = OrderStatus::onlyActive()->orderBy('default', 'desc')->byPosition()->first();

            return $this->hasMany(Order::class)
                        ->whereNotIn('order_status_id', [$order_status->id]);
        }

        public function getMainAddressAttribute()
        {
            return $this->addresses->first();
        }

        public function scopeOnlyActive(Builder $builder)
        {
            return $builder->where('is_active', true);
        }

        public function updateAddress(array $attributes)
        {
            $this->addresses()
                 ->forceDelete();

            $this->addresses()
                 ->createMany($attributes['address']);
        }

        public function getNameAttribute()
        {
            return collect([$this->first_name, $this->last_name])
                ->filter()
                ->implode(' ');
        }

        public function getWishlistAttribute()
        {
            Cart::instance('wishlist');
            Cart::instance('wishlist')->restore('wishlist.' . $this->id, false);

            return Cart::instance('wishlist')->content()->reverse();
        }

        public function getWaitinglistAttribute()
        {
            Cart::instance('waitinglist');
            Cart::instance('waitinglist')->restore('waitinglist.' . $this->id, false);

            return Cart::instance('waitinglist')->content()->reverse();
        }

        public function getComparelistAttribute()
        {
            $cart = Cart::instance('comparelist');
            $cart->restore('comparelist.' . $this->id, false);

            return $cart->content()->reverse();
        }

        public function hasProdInCompareList(Product $product)
        {
            return auth('web')->user()->comparelist->firstWhere('id', $product->id);
        }

        public function hasProductInWishList(Product $product): bool
        {
            return Auth::guard('web')->user()->wishlist->contains('id', $product->id);
        }

        public function hasProductInWaiting(Product $product): bool
        {
            return Auth::guard('web')->user()->waiting_list->contains('id', $product->id);
        }

        public function getReviewsAttribute()
        {
            return Review::where('email', $this->email)->get();
        }

        public function setDiscount(array $data): void
        {
            $this->discount      = $data['discount'] ?? 0;
            $this->is_percentage = $data['is_percentage'] ?? false;
        }

        /**
         * Mark the given user's email as verified.
         *
         * @return bool
         */
        public function markEmailAsVerified()
        {
            return $this->forceFill([
                'email_verified_at' => $this->freshTimestamp(),
                'is_active'         => true,
            ])->save();
        }

        /**
         * Send the password reset notification.
         *
         * @param string $token
         *
         * @return void
         */
        public function sendPasswordResetNotification($token)
        {
            $this->notify(new ResetPasswordEmail($this,$token));
        }
    }
