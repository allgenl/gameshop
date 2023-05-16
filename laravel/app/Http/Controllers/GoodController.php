<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Good;
use Illuminate\Http\Request;

class GoodController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function good(int $id)
    {
        /** @var Good $good */
        $good = Good::query()->with('category')->find($id);
        return view('good', ['good' => $good]);
    }

    public function category(int $id)
    {
        /** @var Good $goods */
        $goods = Good::query()
            ->where('category_id', '=', $id)
            ->paginate(6);
        return view('home', [
            'goods' => $goods,
            'category_id' => $id,
            'currentCategory' => Category::find($id)
        ]);
    }
    public function goodsSearch(Request $request)
    {
        $search = $request->input('search');
        /** @var Good $goods */
        $goods = Good::query()
            ->where('title', 'like', '%' . $search . '%')
            ->orWhere('description', 'like', '%' . $search . '%')
            ->get();
        return view('search', ['goods' => $goods]);
    }
}
