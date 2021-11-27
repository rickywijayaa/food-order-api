<?php

namespace App\Repository;

use App\Models\Category;
use App\Models\CategoryMenu;
use App\Models\Menu;
use Illuminate\Support\Facades\Validator;

use function PHPUnit\Framework\isEmpty;

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
        // $validator =  Validator::make($request->all(),[
        //     'name' => 'required',
        //     'description' => 'required',
        //     'price' => 'required',
        //     'image' => 'required',
        //     'categories' => 'required',
        //     'isAvailable' => 'required'
        // ]);
            
        // if($validator->fails()){
        //     return response()->json([
        //         "message" => $validator->errors(),
        //         "data" => [],
        //     ], 422);
        // }

        $data = $request->all();

        $decoded_json_categories = json_decode($data['categories'], true);

        $menuId = "";
        if($request->hasFile("image")){
            $image = $request->file('image');

            $result = Menu::create([
                "name" => $data["name"],
                "description" => $data["description"],
                "price" => $data["price"],
                "image" => $image->store("menu","public"),
                "isAvailable" => $data["isAvailable"] == "true" ? 1 : 0
            ])->id;

            $menuId = $result;
        }

        for($i = 0; $i < count($decoded_json_categories); $i++){
            CategoryMenu::create([
               "menu_id" => $menuId,
               "category_id" =>  $decoded_json_categories[$i]["id"]
            ]);
        }

        $dataJson = [
             "name" => $data["name"],
             "description" => $data["description"],
             "category" => $decoded_json_categories,
             "price" => $data["price"],
             "image" => $data["image"],
             "isAvailable" => $data["isAvailable"] == "true" ? 1 : 0
        ];

        return response()->json([
            "message" => "Successfully Create Menu",
            "data" => $dataJson,
        ],201);
    }

    public function GetMenuById($id){
        $data = Menu::findOrFail($id);

        return response()->json([
            "message" => "Successfully Get Menu By Id",
            "data" => $data,
        ],200);
    }

    public function UpdateMenu($request,$id){
        $data = $request->all();
        $menu = Menu::findOrFail($id);
        $menu->update($data);

        $decoded_json_categories = json_decode($data['categories'], true);

        if(count($decoded_json_categories) > 0 ){
            CategoryMenu::where("menu_id",$id)->delete();
        }

        for($i = 0; $i < count($decoded_json_categories); $i++){
            CategoryMenu::create([
                "menu_id" => $id,
                "category_id" =>  $decoded_json_categories[$i]["id"]
            ]);
        }

        return response()->json([
            "message" => "Successfully Update Menu",
            "data" => $data,
        ],201);
    }

    public function DeleteMenu($id)
    {
        $categoryMenu = CategoryMenu::where("menu_id",$id)->get();
        if(count($categoryMenu) > 0){
            CategoryMenu::where("menu_id",$id)->delete();
        }
        $menu = Menu::findOrFail($id);
        $menu->delete();

        return response()->json([
            "message" => "Successfully Delete Menu",
            "data" => $menu
        ],201);
    }
}