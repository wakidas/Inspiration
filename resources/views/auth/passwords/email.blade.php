@extends('layouts.app')
@include('layouts.header')
@include('layouts.footer')
@section('title','パスワードリセット')

@section('content')
<div class="l-passReset">
    <password-email :old="{{ json_encode(Session::getOldInput()) }}" :errors="{{ $errors }}"
        endpoint="{{ route('password.email') }}">
    </password-email>
</div>
@endsection