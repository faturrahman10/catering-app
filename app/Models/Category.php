<?php

namespace App\Models;
use App\Models\Menu;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'is_active'];

public function menus(){
        return $this->hasMany(Menu::class);
}
}
