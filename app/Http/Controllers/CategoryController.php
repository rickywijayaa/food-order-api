<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Repository\CategoryRepository\CategoryRepository;
use Exception;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private $categoryRepository;
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->middleware('auth')->except('register','login');
    }

    public function index(){
        return $this->categoryRepository->GetCategory();
    }

    public function create(Request $request){
        return $this->categoryRepository->CreateCategory($request);
    }

    public function getCategoryById($id){
        return $this->categoryRepository->GetCategoryById($id);
    }

    public function update(Request $request,$id){
        return $this->categoryRepository->UpdateCategory($request,$id);
    }

    public function delete($id){
        return $this->categoryRepository->DeleteCategory($id);
    } 
}