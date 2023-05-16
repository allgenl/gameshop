@extends('layouts.app')

@section('content')
    <div class="content-middle">
        <form action="{{ route('email.edit') }}" method="POST">
            @csrf
            <input type="email" name="email">
            <input type="submit">
        </form>
    </div>
@endsection
