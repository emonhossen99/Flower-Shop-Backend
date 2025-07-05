<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'role_id',
        'fname',
        'lname',
        'phone',
        'email',
        'password',
        'verify_code',
        'avater',
        'subscription',
        'verify_code',
    ];

    public function role(){
        return $this->belongsTo(Role::class);
    }
    public function reviews()
    {
        return $this->hasMany(Orderreview::class, 'user_id', 'id');
    }
}
