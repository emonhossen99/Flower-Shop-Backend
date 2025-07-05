<?php

namespace Modules\Product\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Attribute\App\Models\Attributeoption;

class ProductAttribute extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'product_id',
        'color_id',
        'size_id'
    ];

    public function color (){
        return $this->belongsTo(Attributeoption::class,);
    }
    public function size (){
        return $this->belongsTo(Attributeoption::class,);
    }
}
