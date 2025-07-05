<?php

namespace Modules\Menu\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Menu\Database\factories\MenuFactory;

class Menu extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */

    protected $fillable = [
        'name',
        'slug',
        'url',
        'target',
        'order_by',
        'parent_id',
        'child_id',
        'status',
        'position',
    ];

    public function submenus(){
        return $this->hasMany(Menu::class,'parent_id','id')->where('status','1')->where('position' ,'0');
    }
}
