<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Note extends Model
{

    use SoftDeletes;
    protected $fillable = ['user_id', 'title', 'content', 'color_name', 'appearance_type', 'image_path', 'archived'];
}
