<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;
class Category extends Model {

    use HasFactory,
        SoftDeletes;
    use HasRecursiveRelationships;

    protected $table = 'category';
    protected $fillable = ['category_id', 'title', 'description', 'slug', 'icon'];

    public function getParentKeyName() {
        return 'category_id';
    }

    public function category() {
        return $this->hasMany(Category::class);
    }

    public function sub_category() {
        return $this->hasMany(Category::class)->with('category');
    }

}
