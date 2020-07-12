@extends('layouts.app')
@section('title','ユーザー登録')

@section('content')
<div class="l-register">
    <register-form :old="{{ json_encode(Session::getOldInput()) }}" :errors="{{ $errors }}"
        endpoint-register="{{ route('register') }}">
    </register-form>
</div>
@endsection