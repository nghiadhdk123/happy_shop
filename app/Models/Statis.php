<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statis extends Model
{
    use HasFactory;

    protected $table = 'statistical';

    protected $fillable = [
        'order_date',
        'sales',
        'quantity',
        'profit',
        'total_order',
        'created_at',
        'updated_at',
    ];
}
