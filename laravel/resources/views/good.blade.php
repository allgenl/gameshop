@extends('layouts.app')

@section('content')
    <? /** @var App\Models\Good $good */ ?>
    <div class="content-middle">
        @if(\Illuminate\Support\Facades\Auth::user()->isAdmin() || $good->visibility == 1)
            <div class="content-head__container">
                <div class="content-head__title-wrap">
                    <div class="content-head__title-wrap__title bcg-title">{{ $good->title }} из
                        категории {{ $good->category->title }}</div>
                </div>
                @include('layouts.search.goods')
            </div>
            <div class="content-main__container">
                <div class="product-container">
                    <div class="product-container__image-wrap"><img src="/img/cover/game-{{ $good->getImageId() }}.jpg"
                                                                    class="image-wrap__image-product" alt="photo"></div>
                    <div class="product-container__content-text">
                        <div class="product-container__content-text__title">{{ $good->title }}</div>
                        <div class="product-container__content-text__description">
                            {{ $good->description }}
                        </div>
                        <br>
                        <div class="product-container__content-text__price">
                            <div class="product-container__content-text__price__value">
                                Цена: <b>{{ $good->price }}</b>
                                руб
                            </div>
                            <a href="{{ route('buy', $good->id) }}" class="btn btn-blue">Купить</a>
                        </div>
                        @if(\Illuminate\Support\Facades\Auth::user()->isAdmin())
                            @if($good->visibility == 1)
                                <br>
                                <a href="{{ route('goodDelete', $good->id) }}">Скрыть товар<a>
                            @else
                                <br>
                                <a href="#">Вернуть товар<a>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        @else
            Товар не найден
        @endif
    </div>
@endsection
