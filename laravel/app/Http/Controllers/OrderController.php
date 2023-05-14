<?php

namespace App\Http\Controllers;

use App\Models\Good;
use App\Models\Order;
use App\Models\OrderGood;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function process()
    {
        $currentOrder = Order::getCurrentOrder(Auth::id());

        if (!$currentOrder) {
            return redirect()->route('home');
        }
        /** @var Order $currentOrder */
        $currentOrder->saveProcessed();

    }
}
