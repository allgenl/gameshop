<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Good;
use App\Models\Order;
use App\Models\OrderGood;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function categories()
    {

        return view('layouts.admin.categories');
    }


    public function orders()
    {
        // Get all orders
        $orders = Order::query()
            ->where('state', '=', Order::STATE_PROCESSED)
            ->orderBy('created_at', 'DESC')
            ->get();

        return view('layouts.admin.orders', [
            'orders' => $orders ?? [],
        ]);
    }
}
