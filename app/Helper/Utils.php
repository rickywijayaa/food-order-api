<?php

namespace App\Helper;

class Utils
{
    public function returnErrorMessage(){
        return response()->json([
            'message' => 'Something wrong'
        ],404);
    }
}