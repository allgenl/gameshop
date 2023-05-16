<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Good;
use App\Models\Order;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index(): Renderable
    {
        return view('home', [
            'goods' => Good::query()->orderBy("id", "DESC")->paginate(6)
        ]);
    }

    public function news(): Renderable
    {
        return view('news');
    }

    public function about(): Renderable
    {
        return view('about');
    }
}
