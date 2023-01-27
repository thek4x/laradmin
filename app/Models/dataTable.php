<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;
use App\Models\Admin;
use Laravel\Scout\Searchable;

class dataTable extends Model {

    use HasFactory,
        HasRoles,
        SoftDeletes,
        Searchable;

    protected $table = 'datatable';
    protected $fillable = ['admins_id', 'type', 'category', 'key', 'title', 'data', 'route'];
    protected $primaryKey = 'id';

    public function admins() {
        return $this->belongsTo(Admin::class);
    }

    public function toSearchableArray() {
        return [
            'category' => $this->category,
            'data' => $this->data,
        ];
    }

}
