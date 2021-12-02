<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'users_id',
        'menus_id',
        'totalPrice',
        'notes'
    ];

    public function User(){
        return $this->hasOne(User::class,"id","users_id");
    }

    public function Menu(){
        return $this->hasMany(Menu::class,"id","menus_id");
    }
}
