<?php

namespace App\Repository\CategoryRepository;

use App\Models\Category;
use Exception;
use Illuminate\Support\Facades\Validator;

class CategoryRepository 
{
    public function GetCategory()
    {
        $data = Category::get();
        return response()->json([
            "message" => "Successfully Get",
            "data" => $data,
        ],200);
    }

    public function CreateCategory($request)
    {
        try{
            $validator =  Validator::make($request->all(),[
                'name' => 'required',
                'image' => 'required'
            ]);
            
            if($validator->fails()){
                return response()->json([
                    "message" => $validator->errors(),
                    "data" => [],
                ], 422);
            }

            $data = Category::create([
                "name" => $request->all()["name"],
                "image" => $request->hasFile("image") ? 
                url("/storage")."/".$request->file('image')->store("menu","public") :
                url("/storage")."/"."menu/placeholder.jpg",
            ]);

            return response()->json([
                "message" => "Successfully Create",
                "data" => $data
            ],201);
        }catch(Exception $ex){
            return response()->json([
                "message" => "Failed to Create",
                "data" => []
            ],400);
        }
    }

    public function GetCategoryById($id){
        $data = Category::with("menu")->findOrFail($id);

        return response()->json([
            "message" => "Successfully Get Category By Id",
            "data" => $data
        ],200);
    }

    public function UpdateCategory($request,$id)
    {
        try{
            $validator =  Validator::make($request->all(),[
                'name' => 'required',
            ]);
                
            if($validator->fails()){
                return response()->json([
                    "message" => $validator->errors(),
                    "data" => [],
                ], 422);
            }

            $data = $request->all();
            $query = Category::findOrFail($id);

            $query->update($data);
            return response()->json([
                "message" => "Successfully Update",
                "data" => $query
            ],201);
        }
        catch (Exception $ex){
            return response()->json([
                "message" => "Id Not Found",
                "data" => []
            ],400);
        }
    }

    public function DeleteCategory($id){
        try{
            $data = Category::findOrFail($id);
            $data->delete();

            return response()->json([
                "message" => "Successfully Update",
                "data" => $data
            ],201);
        }
        catch(Exception $ex){
            return response()->json([
                "message" => "Id Not Found",
                "data" => []
            ],400);
        }
    }
}