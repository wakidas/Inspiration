@extends('layouts.app')
@include('layouts.header')
@include('layouts.footer')

@section('content')
<div class="l-changeEmail">
    <change-email :old="{{ json_encode(Session::getOldInput()) }}" :errors="{{ $errors }}" endpoint="/email">
    </change-email>
</div>
@endsection