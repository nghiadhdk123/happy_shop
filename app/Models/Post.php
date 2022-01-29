<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';

    protected $fillable = [
        'title',
        'slug',
        'content',
        'image',
        'name_user',
        'avatar_user',
        'created_at',
    ];

    public function voteUsers()
    {
        return $this->belongsToMany(User::class,'likes')->withPivot(['status','type_like']);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class,'tag_post');
    }
}
