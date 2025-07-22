<?php

namespace Modules\Coupon\App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Coupon\Database\factories\CouponFactory;

class Coupon extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'user_id',
        'name',
        'code',
        'discount_amount',
        'type',
        'limit',
        'start_date',
        'end_date',
        'status',
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
