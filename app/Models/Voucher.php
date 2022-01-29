<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;

    protected $table = 'vouchers';

    protected $fillable = [
            'name',
            'percent',
            'expiry',
            'code',
    ];

    public function shareUsers()
    {
        return $this->belongsToMany(User::class,'user_voucher')->withPivot(['status']);
    }
}
