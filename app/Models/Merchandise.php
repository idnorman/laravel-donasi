<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Merchandise extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $fillable = [
        'name',
        'price',
        'image',
        'description',
        'stock',
    ];

    public function transaction()
    {
        return $this->hasMany(MerchandiseTransaction::class, 'merchandise_id', 'id');
    }
}
