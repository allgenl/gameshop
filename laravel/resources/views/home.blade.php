@extends('layouts.app')

@section('content')
    <div class="content-middle">
        <div class="content-head__container">
            <div class="content-head__title-wrap">
                <div class="content-head__title-wrap__title bcg-title">
                    <? /** @var \App\Models\Category $currentCategory */ ?>
                    @if(isset($currentCategory))
                        Товары из категории {{ $currentCategory->title }}
                    @else
                        Последние товары
                    @endif
                </div>
            </div>
            @include('layouts.search.goods')
        </div>
        <div class="content-main__container">
            <div class="products-columns">
                <? /** @var App\Models\Good $good */ ?>
                @foreach($goods as $good)
                    <div class="products-columns__item">
                        <div class="products-columns__item__title-product"><a href="{{ route('good', $good->id) }}"
                                                                              class="products-columns__item__title-product__link">{{ $good->title }}</a>
                        </div>
                        <div class="products-columns__item__thumbnail"><a href="{{ route('good', $good->id) }}"
                                                                          class="products-columns__item__thumbnail__link"><img
                                    src="/img/cover/game-{{ $good->getImageId() }}.jpg" alt="Preview-image"
                                    class="products-columns__item__thumbnail__img"></a></div>
                        <div class="products-columns__item__description"><span class="products-price">{{ $good->price }} руб</span><a
                                href="{{ route('buy', $good->id) }}" class="btn btn-blue">Купить</a></div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="content-footer__container">
            {{ $goods->links() }}
        </div>
    </div>
@endsection
