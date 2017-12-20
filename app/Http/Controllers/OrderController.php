<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Order;


class OrderController extends Controller
{
    /**
     * Get all orders.
     *
     * @var App\Order $orders
     * @return Illuminate\View\View
     */
    public function getAllOrders()
    {
        $orders = Order::all();
        return view('admin', compact('orders'));
    }

}
