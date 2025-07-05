<?php

namespace Modules\Feature\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Feature extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [

        'title',
        'description',
        'status'          
    ];
    
    protected static function newFactory()
    {
        //return FeatureFactory::new();
    }
}
