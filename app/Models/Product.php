<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = "products";

    protected $fillable = [
        'name',
        'slug',
        'description',
        'category_id',
        'user_id',
        'origin_price',
        'sale_price',
        'status',
        'quantity',
        'sell_number',
        'inventory',
        'content_more',
    ];

    const Dang_Ban = 0;
    const Het_Hang = 1;
    const Dung_Ban = 2;

    public static $status_text = [
        self::Dang_Ban => 'Đang bán',
        self::Het_Hang => 'Hết hàng',
        self::Dung_Ban => 'Dừng bán',
    ];

    public function getStatusTextAttribute()
    {
        return self::$status_text[$this->status];
    }

    public function getContentMoreJsonAttribute(){
        $content_json = json_decode($this->content_more, true);
        return $content_json;
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }

    public function comment()
    {
        return $this->hasMany(Comment::class);
    }
}
