@extends('layouts.app')
@include('layouts.footer')
@section('title','ログイン')

@section('content')
<div class="l-login">
    <login-form :old="{{ json_encode(Session::getOldInput()) }}" :errors="{{ $errors }}"
        endpoint-login="{{ route('login') }}" endpoint-request="{{ route('password.request') }}">
    </login-form>
</div>
@endsection