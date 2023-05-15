<?php /** @var \App\Models\User $user */
/** @var \App\Models\Order $order */
/** @var \App\Models\Good $good */?>


Пользователь {{ $user->id }} заказал товары: <br>
<br>
@forelse($order->goods as $good)
    id {{ $good->id }} - {{ $good->title }} <br>
@empty
    Нет товаров в заказе
@endforelse
