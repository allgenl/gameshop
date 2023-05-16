<div class="sidebar-item">
    <div class="sidebar-item__title">Последние новости</div>
    <div class="sidebar-item__content">
        <div class="sidebar-news">
            <? /** @var \App\Models\News $new */ ?>
            @foreach($news as $new)
                <div class="sidebar-news__item">
                    <div class="sidebar-news__item__preview-news"><a href="{{ route('oneNews', $new->id) }}"><img src="/img/cover/game-{{ $new->getImageId() }}.jpg" alt="image-new" class="sidebar-new__item__preview-new__image"></a></div>
                    <div class="sidebar-news__item__title-news"><a href="{{ route('oneNews', $new->id) }}" class="sidebar-news__item__title-news__link">{{ $new->short_title }}</a></div>
                </div>
            @endforeach
        </div>
    </div>
</div>
