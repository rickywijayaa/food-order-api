<?php

namespace App\Repository;

use App\Mail\SendEmailToUser;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class OrderRepository
{
    public function GetOrder()
    {
        $data = Order::with("user")->get();

        return response()->json([
            "message" => "Successfully Get",
            "data" => $data,
        ], 200);
    }

    public function GetOrderById($id)
    {
        $data = Order::where("id", $id)->with(["menu", "user"])->get();

        return response()->json([
            "message" => "Successfully Get Order By Id",
            "data" => $data,
        ], 200);
    }

    public function FilterOrderByMonth()
    {
        $data = Order::select('id', 'created_at')
            ->get()
            ->groupBy(function ($date) {
                return Carbon::parse($date->created_at)->format('m');
            });

        $dataCount = [];
        $dataArr = [];

        foreach ($data as $key => $value) {
            $dataCount[(int)$key] = count($value);
        }

        $month = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

        for ($i = 1; $i <= 12; $i++) {
            if (!empty($dataCount[$i])) {
                $dataArr[$i]['count'] = $dataCount[$i];
            } else {
                $dataArr[$i]['count'] = 0;
            }
            $dataArr[$i]['month'] = $month[$i - 1];
        }

        return response()->json([
            "message" => "Success Filtered By Year",
            "data" => array_values($dataArr)
        ]);
    }

    public function FilterOrderByWeek()
    {
        $data = Order::select('id', 'created_at')
            ->get()
            ->groupBy(function ($date) {
                return Carbon::parse($date->created_at)->format('w');
            });

        $dataCount = [];
        $dataArr = [];

        foreach ($data as $key => $value) {
            $dataCount[(int)$key] = count($value);
        }

        $day = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday','Saturday','Sunday'];

        for ($i = 1; $i <= 7; $i++) {
            if (!empty($dataCount[$i])) {
                $dataArr[$i]['count'] = $dataCount[$i];
            } else {
                $dataArr[$i]['count'] = 0;
            }
            $dataArr[$i]['month'] = $day[$i - 1];
        }

        return response()->json([
            "message" => "Success Filtered By Year",
            "data" => array_values($dataArr)
        ]);
    }

    public function GetRecentOrder()
    {
        $data = Order::with(["menu", "user"])->orderBy("created_at", "desc")->take(10)->get();

        return response()->json([
            "message" => "Successfully Get Order By Id",
            "data" => $data,
        ], 200);
    }

    public function GetMostOrder(){
        $data = DB::table("orders")
                ->selectRaw("COUNT(orders.menus_id) as total_menu, orders.totalPrice as price, menus.name")
                ->join("menus","orders.menus_id","=","menus.id")
                ->groupBy('menus_id')->orderBy('total_menu', 'DESC')->first();

        return response()->json([
            "message" => "Successfully Get Order By Id",
            "data" => $data,
        ], 200);
    }

    public function CreateOrder($request)
    {
        $data = $request->all();
        
        $decoded_json_menu = json_decode($data['menu'], true);

        for ($i = 0; $i < count($decoded_json_menu); $i++) {
            Order::create([
                "status" => "Paid",
                "users_id" =>  $data["users_id"],
                "menus_id" => $decoded_json_menu[$i]["id"],
                "notes" => $data["notes"],
                "totalPrice" => $data["total_payment"]
            ]);
        }

        $details = [
            'username' => explode("@", $data["email"])[0],
            'price' => $data["price"],
            'tax_fee' => $data["tax_fee"],
            'total_payment' => $data["total_payment"],
            'menu_name' => $data["name"],
            "menu_count" => $data["count"],
            "menu_price" => $data["menu_price"]
        ];

        Mail::to($data["email"])->send(new SendEmailToUser($details));
    }
}
