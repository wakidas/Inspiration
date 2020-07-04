@extends('layouts.app')
@include('layouts.header')
@include('layouts.footer')

@section('content')
<div class="l-main">
    <mypage-settings :user='@json($user)'></mypage-settings>
</div>
@endsection