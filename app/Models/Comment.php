<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $table = "comments";

    protected $fillabel = [
        'post_id',
        'content',
        'parent_id',
        'image',
        'user_id',
        'status',
    ];

    public function commentPost()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function parent()
    {
        return $this->hasMany(Comment::class,'parent_id');
    }
}
