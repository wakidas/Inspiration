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

            <div class="p-login__form">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="p-login__formGroup">
                        <label for="email" class="">メールアドレス</label>

                        <div class="p-login__formItem">
                            <input id="email" type="email"
                                class="p-login__formInput @error('email') is-invalid @enderror" name="email"
                                value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                            <span class="" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="p-login__formGroup">
                        <label for="password" class="">パスワード</label>

                        <div class="p-login__formItem">
                            <input id="password" type="password"
                                class="p-login__formInput @error('password') is-invalid @enderror" name="password"
                                required autocomplete="current-password">

                            @error('password')
                            <span class="" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="p-login__formGroup p-login__formGroup--remember">
                        <input class="p-login__formInput p-login__formInput--remember" type="checkbox" name="remember"
                            id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="p-login__formLabel" for="remember">ログインしたままにする</label>
                        {{-- <p></p> --}}
                    </div>

                    <div class="p-login__submit">
                        <button type="submit" class="c-button__submit">
                            ログインする
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endsection