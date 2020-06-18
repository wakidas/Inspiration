@extends('layouts.app')
@include('layouts.header')
@include('layouts.footer')

@section('content')
<div class="l-reset">
    <password-email :old="{{ json_encode(Session::getOldInput()) }}" :errors="{{ $errors }}"
        endpoint="{{ route('password.email') }}">
    </password-email>
</div>
@endsection