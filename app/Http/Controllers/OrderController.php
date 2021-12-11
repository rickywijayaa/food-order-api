<?php

namespace App\Http\Controllers;

use App\Repository\OrderRepository;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    private $orderRepository;
    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
        $this->middleware('auth')->except('register','login');
    }

    public function index(){
        return $this->orderRepository->GetOrder();
    }

    public function getOrderById($id){
        return $this->orderRepository->GetOrderById($id);
    }

    public function create(Request $request){
        return $this->orderRepository->CreateOrder($request);
    }

    public function filterOrderByDate(Request $request){
        return $this->orderRepository->FilterOrderByDate($request);
    }

    public function getRecentOrder(){
        return $this->orderRepository->GetRecentOrder();
    }
}
