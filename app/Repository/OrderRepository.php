<?php

namespace App\Repository;

use App\Mail\SendEmailToUser;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
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
        // $data = Order::whereHas('user', function($q) use ($id){
        //     $q->where('id', "=", $id);
        // })->with("user","menu")->get();

        $data = Order::findOrFail($id)->with("menu")->get();

        return response()->json([
            "message" => "Successfully Get Order By Id",
            "data" => $data,
        ],200);
    }

    public function FilterOrderByDate($request){
        $input = $request->all();

        $data = Order::where([
            ["order_in_date",">=",$input["fromDate"]],
            ["order_in_date","<=",$input["toDate"]]]
            )->count();

        return response()->json([
            "message" => "Successfully Get Order By Id",
            "data" => $data,
        ],200);
    }

    public function CreateOrder($request){
        $data = $request->all();

        // $validator =  Validator::make($request->all(),[
        //     'users_id' => 'required',
        //     'orders' => 'required',
        //     'totalPrice' => 'required',
        //     'notes' => 'required',
        // ]);
        
        // if($validator->fails()){
        //     return response()->json([
        //         "message" => $validator->errors(),
        //         "data" => [],
        //     ], 422);
        // }

        // $decoded_json_menu = json_decode($data['menu'], true);

        // for($i = 0; $i < count($decoded_json_menu); $i++){
        //     Order::create([
        //        "status" => $data["status"],
        //        "users_id" =>  $data["users_id"],
        //        "orders" => $decoded_json_menu[$i]["name"],
        //        "totalPrice" => $data["totalPrice"],
        //        "notes" => $data["notes"]
        //     ]);
        // }

        $details = [
            'username' => explode("@", $data["email"])[0],
        ];
        
        Mail::to($data["email"])->send(new SendEmailToUser($details));
    }
}
