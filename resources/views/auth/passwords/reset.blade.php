@extends('layouts.app')
@include('layouts.header')
@include('layouts.footer')

@section('content')
<div class="l-reset">
    <password-reset :old="{{ json_encode(Session::getOldInput()) }}" :errors="{{ $errors }}"
        endpoint="{{ route('password.update') }}" token="{{ $token }}">
    </password-reset>
</div>
@endsection