<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use Illuminate\Database\Eloquent\SoftDeletes;
class Slider extends Model
{
    use HasFactory, SoftDeletes;
    
    public function category(){
        return $this->belongsTo(Category::class);
    }
}
