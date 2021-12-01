<?php

namespace App\Repository;

use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class OrderRepository {
    public function GetOrder(){
        $data = Order::with("user")->get();

        return response()->json([
            "message" => "Successfully Get",
            "data" => $data,
        ],200);
    }

    public function GetOrderById($id){
        $data = Order::whereHas('user', function($q) use ($id){
            $q->where('id', "=", $id);
        })->with("user")->get();

        return response()->json([
            "message" => "Successfully Get Order By Id",
            "data" => $data,
        ],200);
    }
}
