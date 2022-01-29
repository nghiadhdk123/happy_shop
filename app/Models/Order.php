<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'code',
        'user_id',
        'total_price',
        'status',
        'phone',
        'address',
        'name',
        'note',
        'method_pay',
    ];

    const ORDER_WAIT        = 0;
    const ORDER_CONFIRM     = 1;
    const ORDER_SHIPPING    = 2;
    const ORDER_FINISH      = 3;
    const ORDER_RETURN      = 4;
    const ORDER_CONFIRM_CANCEL = 5;

    public static $status_text = [
        self::ORDER_WAIT        => 'Chưa xử lý',
        self::ORDER_CONFIRM     => 'Đã xác nhận',
        self::ORDER_SHIPPING    => 'Đang giao hàng',
        self::ORDER_FINISH      => 'Đã giao hàng',
        self::ORDER_RETURN      => 'Hủy đơn hàng',
        self::ORDER_CONFIRM_CANCEL      => 'Đã hủy đơn hàng',
    ];

    public function getStatusTextAttribute()
    {
        return self::$status_text[$this->status];
    }

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot(['name','quantity','price']);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }



}
