<?php

namespace App\Http\Controllers;

use App\Mail\OrderCompleted;
use App\Models\Admin;
use App\Models\Good;
use App\Models\Order;
use App\Models\OrderGood;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }



    public function buy(int $id)
    {
        $good = Good::query()->find($id);

        if (!$good) {
            return redirect()->route('home');
        }

        $currentOrder = Order::getCurrentOrder(Auth::id());

        if (!$currentOrder) {
            ($currentOrder = new Order([
                'user_id' => Auth::id(),
                'state' => Order::STATE_CURRENT
            ]))->save();
        }
        (new OrderGood(['order_id' => $currentOrder->id, 'good_id' => $id]))->save();;

        return redirect()->route('order.current');
    }

    public function current()
    {
        $order = Order::getCurrentOrder(Auth::id());

        return view('order.current', [
            'goods' => $order->goods ?? [],
            'sum' => $order ? $order->getSum() : 0
        ]);
    }

    public function goodRemove(int $id)
    {
        /** @var Order $order */
        $order = Order::getCurrentOrder(Auth::id());

        $affected = DB::table('order_goods')
            ->where('order_id', '=', $order->id)
            ->where('good_id', '=', $id)
            ->limit(1)
            ->delete();

        return $this->current();
    }

    public function process()
    {
        $currentOrder = Order::getCurrentOrder(Auth::id());

        if (!$currentOrder) {
            return redirect()->route('home');
        }
        $users = User::query()
            ->where('is_admin', '=', '1')
            ->where('order_notice', '=', '1')
            ->get();

        if ($users) {
            foreach ($users as $user) {
                Mail::to($user)->send(new OrderCompleted($currentOrder, Auth::user()));
            }
        }


        /** @var Order $currentOrder */
        $currentOrder->saveProcessed();

        return view('order.completed');

    }

    public function myOrders()
    {
        // Get all user orders
        $orders = Order::query()
            ->where('user_id', '=', Auth::id())
            ->where('state', '=', Order::STATE_PROCESSED)
            ->orderBy('created_at', 'DESC')
            ->get();

        return view('order.my_orders', [
            'orders' => $orders ?? [],
        ]);
    }
}
