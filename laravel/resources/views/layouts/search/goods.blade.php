<div class="content-head__search-block">
    <div class="search-container">
        <form class="search-container__form" action="{{ route('goods.search') }}" method="POST">
            @csrf
            <input type="text" class="search-container__form__input" name="search">
            <button class="search-container__form__btn">search</button>
        </form>
    </div>
</div>
