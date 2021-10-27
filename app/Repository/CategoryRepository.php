<?php

namespace App\Repository\CategoryRepository;

use App\Models\Category;
use Exception;

class CategoryRepository 
{
    public function CreateCategory($request)
    {
        try{
            $data = Category::create($request);

            return response()->json([
                "message" => "Successfully register",
                "data" => $data
            ],201);
        }catch(Exception $ex){
            $this->returnErrorMessage();
        }
        Category::create($request);
    }

    private function returnErrorMessage(){
        return response()->json([
            'message' => 'Something wrong'
        ],404);
    }
}