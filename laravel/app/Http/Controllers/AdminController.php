<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Good;
use App\Models\Order;
use App\Models\OrderGood;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
    public function email()
    {
        return view('layouts.admin.email');
    }


    public function editEmail(Request $request)
    {
        $email = $request->input('email');
        $affected = DB::table('users')
            ->where('id', '=', Auth::id())
            ->update(['email' => $email]);
        return redirect()->route('home');
    }
}
