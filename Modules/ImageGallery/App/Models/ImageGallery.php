<?php

namespace Modules\ImageGallery\App\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Product\App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class ImageGallery extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'product_id',
        'image_path'
    ];

    protected $table = 'imagegalleries';
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
