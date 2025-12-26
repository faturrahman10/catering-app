<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = ['name', 'category_id', 'price', 'image', 'description', 'is_active'];

    public function category(){
        return $this->belongsTo(Category::class);
    }
}
