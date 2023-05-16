@extends('layouts.app')

@section('content')
    <div class="content-middle">
        <div class="content-head__container">
            <div class="content-head__title-wrap">
                <a class="content-head__title-wrap__title" href="{{ route('news') }}">
                    <div class="content-head__title-wrap__title bcg-title">Новости</div>
                </a>
            </div>
            @include('layouts.search.news')
        </div>
        <div class="content-main__container">
            <? /** @var \App\Models\News $new */ ?>
            @foreach($news as $new)
                <div class="news-block content-text">
                    <a class="content-head__title-wrap__title" href="{{ route('oneNews', $new->id) }}">
                        <h3 class="content-text__title">
                            {{ $new->title }}
                        </h3>
                        <img src="/img/cover/game-{{ $new->getImageId() }}.jpg" alt="Image" class="alignleft img-news">
                    </a>
                        <? $pars = explode('\n', $new->description) ?>
                    @foreach($pars as $par)
                        <p>{{ $par }}</p>
                    @endforeach

                </div>
            @endforeach
        </div>
    </div>
@endsection
