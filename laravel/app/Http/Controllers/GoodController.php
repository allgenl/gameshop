<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Good;
use Illuminate\Http\Request;

class GoodController extends Controller
{
    public function good(int $id)
    {
        /** @var Good $good */
        $good = Good::query()->with('category')->find($id);
        return view('good', ['good' => $good]);
    }

    public function category(int $id)
    {
        /** @var Category $category */
        $category = Category::with('goods')->find($id);
        return view('home', [
            'goods' => $category->goods,
            'category_id' => $id,
            'currentCategory' => $category->title
        ]);
    }
}
