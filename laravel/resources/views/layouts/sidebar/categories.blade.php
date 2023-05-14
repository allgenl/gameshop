<div class="sidebar-item">
    <div class="sidebar-item__title">Категории</div>
    <div class="sidebar-item__content">
        <ul class="sidebar-category">
            <? /** @var \App\Models\Category $category */ ?>
            @foreach($categories as $category)
                <li class="sidebar-category__item">
                    @if(isset($currentCategory) && $category_id == $category->id)
                        <a href="{{ route('category', $category->id) }}" class="sidebar-category__item__link" style="color: #d28324">{{ $category->title }}</a>
                    @else
                    <a href="{{ route('category', $category->id) }}" class="sidebar-category__item__link">{{ $category->title }}</a>
                    @endif
                </li>
            @endforeach
        </ul>
    </div>
</div>
