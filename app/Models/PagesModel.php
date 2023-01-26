<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;

class PagesModel extends Model {

    use HasFactory,
        SoftDeletes,
        HasRoles;

    protected $table = 'pages';
    protected $fillable = ['slug', 'content', 'category', 'page_title', 'page_description', 'page_keywords', 'ip'];
    protected $primaryKey= 'id';
}
