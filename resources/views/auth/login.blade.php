@extends('layouts.app')
@include('layouts.footer')

@section('content')
<div class="l-login">
    <div class="p-login">
        <div class="p-login__logo">
            <img src="/images/logo.png" alt="Inspiration">
        </div>
        <div class="p-login__inner">
            <div class="p-login__title">ログイン</div>

            <login-form :old="{{ json_encode(Session::getOldInput()) }}" :errors="{{ $errors }}"
                endpoint="{{ route('login') }}">
            </login-form>
        </div>
    </div>
</div>
@endsection