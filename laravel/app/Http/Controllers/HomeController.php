<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Good;
use App\Models\News;
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
        $news = News::query()
            ->orderBy('created_at', 'DESC')
            ->limit(3)
            ->get() ?? [];
//        dd($news);
        return view('news', ['news' => $news]);
    }
    public function oneNews(int $id): Renderable
    {
        $news = News::query()
            ->where('id', '=', $id)
            ->get() ?? [];
        return view('news', ['news' => $news]);
    }
    public function newsSearch(Request $request): Renderable
    {
        $search = $request->input('search');
        /** @var News $news */
        $news = News::query()
            ->where('title', 'like', '%' . $search . '%')
            ->orWhere('description', 'like', '%' . $search . '%')
            ->get();
        return view('news', ['news' => $news]);
    }

    public function about(): Renderable
    {
        return view('about');
    }
}
