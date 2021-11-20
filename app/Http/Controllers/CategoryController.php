<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Repository\CategoryRepository\CategoryRepository;
use Exception;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private $categoryRepostiroy;
    public function __construct(CategoryRepository $categoryRepostiroy)
    {
        $this->categoryRepostiroy = $categoryRepostiroy;
        $this->middleware('auth')->except('register','login');
    }

    public function index(){
        return $this->categoryRepostiroy->GetCategory();
    }

    public function create(Request $request){
        return $this->categoryRepostiroy->CreateCategory($request);
    }

    public function update(Request $request,$id){
        return $this->categoryRepostiroy->UpdateCategory($request,$id);
    }

    public function delete($id){
        return $this->categoryRepostiroy->DeleteCategory($id);
    } 
}