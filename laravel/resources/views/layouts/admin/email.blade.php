@extends('layouts.app')

@section('content')
    <div class="content-middle">
        <form action="{{ route('email.edit') }}" method="POST">
            @csrf
            <div style="padding-bottom: 10px">
                <label for="email">E-mail</label>
                <input type="email" name="email">
            </div>
            <div style="padding-bottom: 10px">
                <label for="order_notice">Order notice</label>
                <input type="checkbox" name="order_notice">
            </div>
            <input type="submit">
        </form>
    </div>
@endsection
