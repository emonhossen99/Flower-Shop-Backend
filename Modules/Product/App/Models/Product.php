<?php

namespace Modules\Product\App\Models;

use App\Models\OrderDetail;
use App\Models\Orderreview;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Brand\App\Models\Brand;
use Modules\Category\App\Models\Category;
use Modules\ImageGallery\App\Models\ImageGallery;
use Modules\Purchase\App\Models\PurchaseInvoiceDetails;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'brand_id',
        'name',
        'discount_price',
        'product_stock_qty',
        'product_sku'  ,
        'short_description',
        'special_feature',
        'price',
        'description',
        'product_location',
        'product_image',
        'product_gallery',
        'status',
        'tag',
        'producttype',
    ];


    public function category(){
        return $this->belongsTo(Category::class,'productcategory_id','id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'product_category', 'product_id', 'category_id');
    }

    public function images()
    {
        return $this->hasMany(ImageGallery::class);
    }


}
