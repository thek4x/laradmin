<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;


class Admin  extends Authenticatable{

    use HasFactory,
        Notifiable,
        HasRoles,
        SoftDeletes;

    protected $table = 'admins';
    protected $guard_name = 'admin';
    protected $fillable = ['name','username','password','email'];
    protected $primaryKey = 'id';


  
}
