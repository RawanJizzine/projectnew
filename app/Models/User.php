<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    protected $guarded = [];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    protected $appends = ['image', 'status', 'actions'];

    public function getImageAttribute()
    {
        return  asset('assets/img/avatars/1.png');
    }

    public function getStatusAttribute()
    {
        return 'Active';
    }
    public function getActionsAttribute()
    {
        return view('content.laravel-example.user-management-actions')->render();
    }
    public function subscriptions()
    {
        return $this->hasMany(SubscriptionPlan::class);
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_user');
    }
    public function order()
    {
        return $this->hasMany(Order::class);
    }
    public function orderItem()
    {
        return $this->hasMany(OrderItem::class);
    }
    public function patients()
    {
        return $this->hasMany(Patient::class);
    }

}
