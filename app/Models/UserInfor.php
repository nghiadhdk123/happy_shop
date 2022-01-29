<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserInfor extends Model
{
    use HasFactory;

    protected $table = "userinfor";

    protected $fillable = [

        'user_id',
        'email_2',
        'nickname',
        'hobby',
        'link_facebook',
        'link_instagram',
        'lover',
        'date',
    ];

    public function getHobbyJsonAttribute()
    {
        $hobby_json = json_decode($this->hobby, true);
        return $hobby_json;
    }
}
