<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'code'];

    public function getCategoryByID($filter){
        return Category::find($filter);
    }

    public function getCategoriesList($filter = null){
        if(empty($filter)) return Category::all();
        return Category::where(function ($query) use ($filter){
            $query->where('name', 'like', $filter)
                  ->orWhere('description', 'like', $filter)
                  ->orWhere('code', 'like', $filter);
        })->get();
    }

    public function items(){
        return $this->hasMany(Item::class);
    }

}
