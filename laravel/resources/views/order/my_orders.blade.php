@extends('layouts.app')

@section('content')
    <div class="content-middle">
        <div class="content-head__container">
            <div class="content-head__title-wrap">
                <div class="content-head__title-wrap__title bcg-title">
                    Мои заказы
                </div>
            </div>
        </div>
    </div>
    <div class="content-main__container">
        <div class="cart-product-list">
            <? /** @var \App\Models\Order $order */ ?>
            @if(is_array($orders) || is_object($orders))
                @forelse($orders as $order)
                    <div class="content-head__title-wrap__title">
                            Заказ # {{$order->id}}
                    </div>
                    <br>
                    <? /** @var \App\Models\Good $good */ ?>
                    @forelse($order->goods as $good)
                        <div class="cart-product-list__item">
                            <div class="cart-product__item__product-photo"><img src="/img/cover/game-{{ $good->getImageId() }}.jpg" class="cart-product__item__product-photo__image"></div>
                            <div class="cart-product__item__product-name">
                                <div class="cart-product__item__product-name__content"><a href="{{ route('good', $good->id) }}">{{ $good->title }}</a></div>
                            </div>
                            <div class="cart-product__item__cart-date">
                                <div class="cart-product__item__cart-date__content">{{ $good->created_at->format('d.m.Y') }}</div>
                            </div>
                            <div class="cart-product__item__product-price"><span class="product-price__value">{{ $good->price }} рублей</span></div>
                        </div>
                    @empty
                    @endforelse
                @empty
                    Список заказов пуст
                @endforelse
            @endif
        </div>
    </div>
@endsection
