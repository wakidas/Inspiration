@extends('layouts.app')
@include('layouts.header')
@include('layouts.footer')

@section('content')
<div class="l-main">
    <div class="l-settings">
        <mypage-settings :user='@json($user)'></mypage-settings>
    </div>
</div>
@endsection