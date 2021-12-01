<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'user_id',
        'orders',
        'totalPrice',
        'notes'
    ];

    public function User(){
        return $this->hasOne(User::class,"id","users_id");
    }
}
