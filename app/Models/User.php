<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable ;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'address',
        'city',
        'state',
        'postal_code',
        'country',
        'role_id',
        'avatar',
        'status'
    ];

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

    public function customers()
    {
        return $this->hasMany(Customer::class);
    }

    public function assign_customer()
    {
        return $this->hasMany(Customer::class,'assign_to','id');
    }

    public function riders()
    {
        return $this->hasMany(Rider::class);
    }
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    public function hasRole($role)
    {
        return $this->role->name === $role;
    }

    public function suppliers()
    {
        return $this->hasMany(Supplier::class);
    }

}
