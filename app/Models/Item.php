<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'category', 'picture', 'picType'];
    
    public function categoryInf(){
        return $this->belongsTo(Category::class, 'category');
    }
}
