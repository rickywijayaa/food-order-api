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
        return $this->orderRepository->getOrderById($id);
    }
}
