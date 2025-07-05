<?php

namespace Modules\Testimonail\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Testimonail\Database\factories\TestimonailFactory;

class Testimonail extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'designation',
        'ratting',
        'status',
        'review',
        'image',
    ];
}
