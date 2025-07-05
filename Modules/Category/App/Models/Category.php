<?php

namespace Modules\Category\App\Models;
use Illuminate\Database\Eloquent\Model;
use Modules\Product\App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Category extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'parent_id',
        'submenu_id',
        'slug',
        'image',
        'tag',
        'status',
        'home_page_show',
        'order_by',
    ];
    // public function products()
    // {
    //     return $this->hasMany(Product::class, 'productcategory_id', 'id')->with('reviews')->where('status', '1');
    // }

    // public function categories()
    // {
    //     return $this->belongsToMany(Category::class, 'product_category', 'product_id', 'category_id');
    // }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_category', 'category_id', 'product_id');
    }

    // public function products()
    // {
    //     return $this->belongsToMany(Product::class, 'product_category', 'category_id', 'product_id');
    // }


    public function subcategories (){
        return $this->hasMany(Category::class,'parent_id', 'id')->where('submenu_id','0')->where('status','1');
    }



}
