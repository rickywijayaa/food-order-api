<?php

namespace App\Repository;

use App\Models\Category;
use App\Models\CategoryMenu;
use App\Models\Menu;
use Illuminate\Support\Facades\Validator;

class MenuRepository{

    public function GetMenu()
    {
        $data = Menu::with("category")->get();

        return response()->json([
            "message" => "Successfully Get",
            "data" => $data,
        ],200);
    }

    public function CreateMenu($request){
        $validator =  Validator::make($request->all(),[
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'categories' => 'required',
            'isAvailable' => 'required'
        ]);
            
        if($validator->fails()){
            return response()->json([
                "message" => $validator->errors(),
                "data" => [],
            ], 422);
        }
        
        $data = $request->all();

        // if($request->hasFile("image")){
        //     $image = $request->file('image');
        //     $name = time().'.'.$image->getClientOriginalExtension();
        //     $destinationPath = public_path('/images');
        //     $image->move($destinationPath, $name);
        // }

        $menuId = Menu::create([
            "name" => $data["name"],
            "description" => $data["description"],
            "price" => $data["price"],
            "isAvailable" => $data["isAvailable"]
        ])->id;

        for($i = 0; $i < count($data["categories"]); $i++){
            CategoryMenu::create([
               "menu_id" => $menuId,
               "category_id" =>  $data["categories"][$i]
            ]);
        }

        return response()->json([
            "message" => "Successfully Create Menu",
            "data" => $data,
        ],201);
    }
}