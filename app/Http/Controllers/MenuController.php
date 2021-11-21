<?php

namespace App\Http\Controllers;

use App\Repository\MenuRepository;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    private $menuRepository;
    public function __construct(MenuRepository $menuRepository)
    {
        $this->menuRepository = $menuRepository;
        $this->middleware('auth')->except('register','login');
    }

    public function index(){
        return $this->menuRepository->GetMenu();
    }

    public function create(Request $request){
        return $this->menuRepository->CreateMenu($request);
    }

    public function getMenuById($id){
        return $this->menuRepository->GetMenuById($id);
    }

    public function update(Request $request , $id){
        return $this->menuRepository->UpdateMenu($request,$id);
    }

    public function delete($id){
        return $this->menuRepository->DeleteMenu($id);
    } 
}
