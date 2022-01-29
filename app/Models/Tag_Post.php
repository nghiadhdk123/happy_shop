<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag_Post extends Model
{
    use HasFactory;

    public $timestamps = false;
    
    protected $table = 'tag_post';

    protected $fillable = [
        'post_id',
        'tag_id',
    ];
}
