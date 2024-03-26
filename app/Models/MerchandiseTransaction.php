<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MerchandiseTransaction extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $fillable = [
        'user_id',
        'merchandise_id',
        'merchandise_price',
        'address',
        'phone',
        'email',
        'shipping_cost',
        'merchandise_quantity',
        'payment_total',
        'snap_token',
        'payment_status',
        'payment_method',
    ];

    public function buyer()
    {
        return $this->belongsTo(User::class, 'buyer_id', 'id');
    }

    public function merchandise()
    {
        return $this->belongsTo(Merchandise::class, 'merchandise_id', 'id');
    }
}
