<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Good;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        $boxSize = 0;

        Schema::defaultStringLength(191);

        \Illuminate\Support\Facades\View::composer('layouts.sidebar.categories', function (View $view) {
            $id = Auth::id();
            return $view
                ->with('categories', Category::all());
        });

        \Illuminate\Support\Facades\View::composer('*', function (View $view) use ($boxSize) {
            $id = Auth::id();
            if ($id) {
                $currentOrder = Order::getCurrentOrder($id);
                if ($currentOrder) {
                    $boxSize = sizeof($currentOrder->goods);
                }
            }
            return $view
                ->with('boxSize', $boxSize);
        });

        \Illuminate\Support\Facades\View::composer('layouts.footer', function (View $view) {
            $count = sizeof(Good::query()->get());
            $good = Good::query()
                ->where('id', '=', mt_rand(1, $count))
                ->first();
            return $view
                ->with('good', $good);
        });
    }
}
