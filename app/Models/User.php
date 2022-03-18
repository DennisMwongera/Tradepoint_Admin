<?php
//
//namespace App\Models;
//
//use Illuminate\Contracts\Auth\MustVerifyEmail;
//use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Foundation\Auth\User as Authenticatable;
//
//use Illuminate\Contracts\Auth\CanResetPassword;
//use Illuminate\Notifications\Notifiable;
//
//
//class User extends Authenticatable
//{
//    use HasFactory, Notifiable;
//
//    /**
//     * The attributes that are mass assignable.
//     *
//     * @var array
//     */
//
//    protected $guarded = [];
//
//    /**
//     * The attributes that should be hidden for arrays.
//     *
//     * @var array
//     */
//    protected $hidden = [
//        'password',
//        'remember_token',
//    ];
//
//    /**
//     * The attributes that should be cast to native types.
//     *
//     * @var array
//     */
//    protected $casts = [
//        'email_verified_at' => 'datetime',
//    ];
//}


namespace App\Models;

use App\Traits\Uuids;
//use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
//use World\Countries\Model\Country;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes, Uuids;
    //Sluggable
    // stop autoincrement
    public $incrementing = false;

    /**
     * type of auto-increment
     *
     * @string
     */
    protected $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role_id',
        'country_id',
        'name',
        'slug',
        'email',
        'phone_number',
        'password',
        'is_active',
        'phone_number_verified_at'
    ];

    /**
     * set phone number as the default username
     */
    public function username(): string
    {
        return 'phone_number';
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'phone_number_verified_at' => 'datetime'
    ];

    /**
     * get country
     * @return BelongsTo
     */
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * role
     * @return BelongsTo
     */
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * user_detail
     * @return HasMany
     */
    public function user_details(): HasMany
    {
        return $this->hasMany(UserDetail::class)->latest();
    }

    /**
     * history
     * @return HasMany
     */
    public function histories(): HasMany
    {
        return $this->hasMany(History::class)->latest();
    }

    /**
     * order
     * @return HasMany
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class)->latest();
    }

    /**
     * approved orders
     * @return HasMany
     */
    public function approved_orders(): HasMany
    {
        return $this->hasMany(Order::class)->latest()->where('is_approved', true);
    }

    /**
     * rejected orders
     * @return HasMany
     */
    public function rejected_orders(): HasMany
    {
        return $this->hasMany(Order::class)->latest()->where('is_rejected', true);
    }

    /**
     * product
     * @return HasMany
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class)->latest();
    }

    /**
     * wish_lists
     * @return HasMany
     */
    public function wish_lists(): HasMany
    {
        return $this->hasMany(WishList::class)->latest();
    }

    /**
     * wallet
     * @return HasOne
     */
    public function wallet(): HasOne
    {
        return $this->hasOne(Wallet::class);
    }

    /**
     * reviews
     * @return HasMany
     */
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class)->latest();
    }

    /**
     * statements
     * @return HasMany
     */
//    public function statements(): HasMany
//    {
//        return $this->hasMany(Statement::class)->latest();
//    }

    /**
     * suppliers
     * @return HasMany
     */
//    public function suppliers(): HasMany
//    {
//        return $this->hasMany(Supplier::class)->latest();
//    }

    /**
     * mpesas
     * @return HasMany
     */
//    public function mpesas(): HasMany
//    {
//        return $this->hasMany(Mpesa::class)->latest();
//    }

    /**
     * shops
     * @return HasMany
     */
//    public function shops(): HasMany
//    {
//        return $this->hasMany(Shop::class)->latest();
//    }

    /**
     * get user_payment_options
     * @return HasMany
     */
//    public function user_payment_options(): HasMany
//    {
//        return $this->hasMany(UserPaymentOption::class)->latest();
//    }
//
//    public function buyer_disputes()
//    {
//        return $this->hasMany(Dispute::class, 'buyer_id');
//    }
//
//    public function merchant_disputes()
//    {
//        return $this->hasMany(Dispute::class, 'merchant_id');
//    }
}

