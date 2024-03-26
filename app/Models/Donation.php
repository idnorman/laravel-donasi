<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'program_id',
        'donatur_id',
        'amount',
        'is_hide_name',
        'payment_status',
        'payment_method',
        'snap_token',
    ];

    protected $appends = [
        'donatur_name',
    ];

    public function getDonaturNameAttribute()
    {
        if ($this->attributes['is_hide_name'] == 1) {
            return 'Orang Baik';
        }
        return $this->donatur->name;
    }

    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    public function donatur()
    {
        return $this->belongsTo(User::class, 'donatur_id');
    }
}
