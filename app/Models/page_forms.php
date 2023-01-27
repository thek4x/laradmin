<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class page_forms extends Model {

    use HasFactory;

    protected $table = 'page_forms';
    protected $fillable = ['form_page', 'form_pageid', 'form_column', 'form_label', 'form_input', 'form_name','form_inputvalue'];
    protected $guard = '*';

}
